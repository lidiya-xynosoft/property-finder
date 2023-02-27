<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\image;
use App\Property;
use App\Feature;
use App\PropertyImageGallery;
use App\Purpose;
use App\Type;
use Illuminate\Support\Carbon;
use Toastr;
use Illuminate\Support\Facades\Auth;
use File;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()
            ->withCount('comments')
            ->where('agent_id', Auth::id())
            ->paginate(5);
        return view('agent.properties.index', compact('properties'));
    }

    public function create()
    {
        $features = Feature::all();
        $purposes = Purpose::all();
        $types = Type::all();

        return view('agent.properties.create', compact('features', 'types', 'purposes'));
    }


    public function store(Request $request)
    {
        return $request;
        $request->validate([
            'title'     => 'required|unique:properties|max:255',
            'price'     => 'required',
            'purpose'   => 'required',
            'type'      => 'required',
            'bedroom'   => 'required',
            'bathroom'  => 'required',
            'city'      => 'required',
            'address'   => 'required',
            'area'      => 'required',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'floor_plan' => 'image|mimes:jpeg,jpg,png',
            'description'        => 'required',
            // 'location_latitude'  => 'required',
            // 'location_longitude' => 'required',
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            // $propertyimage = Image::make($image)->stream();
            Storage::disk('public')->put('property/' . $imagename, $imagename);
        }

        $floor_plan = $request->file('floor_plan');
        if (isset($floor_plan)) {
            $currentDate = Carbon::now()->toDateString();
            $imagefloorplan = 'floor-plan-' . $currentDate . '-' . uniqid() . '.' . $floor_plan->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            // $propertyfloorplan = Image::make($floor_plan)->stream();
            Storage::disk('public')->put('property/' . $imagefloorplan, $imagefloorplan);
        } else {
            $imagefloorplan = 'default.png';
        }

        $property = new Property();
        $property->title    = $request->title;
        $property->slug     = $slug;
        $property->price    = $request->price;
        $property->purpose  = $request->purpose;
        $property->type     = $request->type;
        $property->garage     = $request->garage;
        $property->built_year     = $request->built_year;
        $property->image    = $imagename;
        $property->bedroom  = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->city     = $request->city;
        $property->city_slug = str_slug($request->city);
        $property->address  = $request->address;
        $property->area     = $request->area;
        $property->json     = json_encode($request->all());

        if (isset($request->featured)) {
            $property->featured = true;
        }
        $property->agent_id           = Auth::id();
        $property->video              = $request->video;
        $property->floor_plan         = $imagefloorplan;
        $property->description        = $request->description;
        $property->location_latitude  = $request->location_latitude;
        $property->location_longitude = $request->location_longitude;
        // $property->nearby             = $request->nearby;
        $property->save();

        $property->features()->attach($request->features);
        if (isset($request->featured)) {
            $property->nearbyItems()->attach($request->group_a);
        }
        if (isset($request->featured)) {
            $property->nearbyItems()->attach($request->group_b);
        }



        $gallary = $request->file('gallaryimage');

        if ($gallary) {
            foreach ($gallary as $images) {
                $currentDate = Carbon::now()->toDateString();
                $galimage['name'] = 'gallary-' . $currentDate . '-' . uniqid() . '.' . $images->getClientOriginalExtension();
                // $galimage['size'] = $images->getClientSize();
                $galimage['property_id'] = $property->id;

                if (!Storage::disk('public')->exists('property/gallery')) {
                    Storage::disk('public')->makeDirectory('property/gallery');
                }
                $propertyimage = Image::make($images)->stream();
                Storage::disk('public')->put('property/gallery/' . $galimage['name'], $propertyimage);

                $property->gallery()->create($galimage);
            }
        }
        $flash = array('type' => 'success', 'msg' => 'Property created successfully.');
        $request->session()->flash('flash', $flash);
        // Toastr::success('message', 'Property created successfully.');
        return redirect()->route('agent.properties.index');
    }


    public function edit(Property $property)
    {
        $features = Feature::all();
        $property = Property::where('slug', $property->slug)->first();
        $purposes = Purpose::all();
        $types = Type::all();
        return view('agent.properties.edit', compact('property', 'features', 'types', 'purposes'));
    }


    public function update(Request $request, $property)
    {
        $request->validate([
            'title'     => 'required|max:255',
            'price'     => 'required',
            'purpose'   => 'required',
            'type'      => 'required',
            'bedroom'   => 'required',
            'bathroom'  => 'required',
            'city'      => 'required',
            'address'   => 'required',
            'area'      => 'required',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'floor_plan' => 'image|mimes:jpeg,jpg,png',
            'description'        => 'required',
            'location_latitude'  => 'required',
            'location_longitude' => 'required'
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->title);

        $property = Property::find($property->id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            if (Storage::disk('public')->exists('property/' . $property->image)) {
                Storage::disk('public')->delete('property/' . $property->image);
            }
            $propertyimage = Image::make($image)->stream();
            Storage::disk('public')->put('property/' . $imagename, $propertyimage);
        } else {
            $imagename = $property->image;
        }


        $floor_plan = $request->file('floor_plan');
        if (isset($floor_plan)) {
            $currentDate = Carbon::now()->toDateString();
            $imagefloorplan = 'floor-plan-' . $currentDate . '-' . uniqid() . '.' . $floor_plan->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            if (Storage::disk('public')->exists('property/' . $property->floor_plan)) {
                Storage::disk('public')->delete('property/' . $property->floor_plan);
            }

            $propertyfloorplan = Image::make($floor_plan)->stream();
            Storage::disk('public')->put('property/' . $imagefloorplan, $propertyfloorplan);
        } else {
            $imagefloorplan = $property->floor_plan;
        }

        $property->title    = $request->title;
        $property->slug     = $slug;
        $property->price    = $request->price;
        $property->purpose  = $request->purpose;
        $property->type     = $request->type;
        $property->image    = $imagename;
        $property->bedroom  = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->city     = $request->city;
        $property->city_slug = str_slug($request->city);
        $property->address  = $request->address;
        $property->area     = $request->area;

        if (isset($request->featured)) {
            $property->featured = true;
        } else {
            $property->featured = false;
        }

        $property->description          = $request->description;
        $property->video                = $request->video;
        $property->floor_plan           = $imagefloorplan;
        $property->location_latitude    = $request->location_latitude;
        $property->location_longitude   = $request->location_longitude;
        $property->nearby               = $request->nearby;
        $property->save();

        $property->features()->sync($request->features);

        $gallary = $request->file('gallaryimage');
        if ($gallary) {
            foreach ($gallary as $images) {
                if (isset($images)) {
                    $currentDate = Carbon::now()->toDateString();
                    $galimage['name'] = 'gallary-' . $currentDate . '-' . uniqid() . '.' . $images->getClientOriginalExtension();
                    $galimage['size'] = $images->getClientSize();
                    $galimage['property_id'] = $property->id;

                    if (!Storage::disk('public')->exists('property/gallery')) {
                        Storage::disk('public')->makeDirectory('property/gallery');
                    }
                    $propertyimage = Image::make($images)->stream();
                    Storage::disk('public')->put('property/gallery/' . $galimage['name'], $propertyimage);

                    $property->gallery()->create($galimage);
                }
            }
        }
        $flash = array('type' => 'success', 'msg' => 'Property updated successfully.');
        $request->session()->flash('flash', $flash);
        // Toastr::success('message', 'Property updated successfully.');
        return redirect()->route('agent.properties.index');
    }

    public function destroy(Property $property)
    {
        $property = Property::find($property->id);

        if (Storage::disk('public')->exists('property/' . $property->image)) {
            Storage::disk('public')->delete('property/' . $property->image);
        }
        if (Storage::disk('public')->exists('property/' . $property->floor_plan)) {
            Storage::disk('public')->delete('property/' . $property->floor_plan);
        }

        $property->delete();

        $galleries = $property->gallery;
        if ($galleries) {
            foreach ($galleries as $key => $gallery) {
                if (Storage::disk('public')->exists('property/gallery/' . $gallery->name)) {
                    Storage::disk('public')->delete('property/gallery/' . $gallery->name);
                }
                PropertyImageGallery::destroy($gallery->id);
            }
        }

        $property->features()->detach();

        // Toastr::success('message', 'Property deleted successfully.');

        return back();
    }


    // DELETE GALERY IMAGE ON EDIT
    public function galleryImageDelete(Request $request)
    {

        $gallaryimg = PropertyImageGallery::find($request->id)->delete();

        if (Storage::disk('public')->exists('property/gallery/' . $request->image)) {
            Storage::disk('public')->delete('property/gallery/' . $request->image);
        }

        if ($request->ajax()) {

            return response()->json(['msg' => true]);
        }
    }
}