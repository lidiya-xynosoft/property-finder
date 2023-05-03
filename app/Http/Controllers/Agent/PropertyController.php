<?php

namespace App\Http\Controllers\Agent;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\image;
use App\Property;
use App\Feature;
use App\NearbyCategory;
use App\NearbyProperty;
use App\PropertyImageGallery;
use App\Purpose;
use App\Setting;
use App\Tag;
use App\Type;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
        if (Auth::user()) {
            $user_data = User::with('country')->where('id', Auth::id())->first();
            $currency = $user_data->country->currency;
        } else {
            $currency = Setting::find(1)->currency;
        }
        return view('agent.properties.index', compact('properties', 'currency'));
    }

    public function create()
    {
        $features = Feature::all();
        $tags = Tag::where('type', 'property')->get();
        $purposes = Purpose::all();
        $types = Type::all();
        $nearby_categories = NearbyCategory::all();
        $cities = City::all();
        $parent_property = Property::where('is_parent_property', -1)->get();

        $user_data = User::with('country')->where('id', Auth::id())->first();
        $currency = $user_data->country->currency;
        return view('agent.properties.create', compact('features', 'types', 'parent_property', 'cities', 'tags', 'purposes', 'nearby_categories', 'currency'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|unique:properties|max:255',
            'price'     => 'required',
            'purpose_id'   => 'required',
            'type_id'      => 'required',
            'bedroom'   => 'required',
            'bathroom'  => 'required',
            'city_id'      => 'required',
            'address'   => 'required',
            'area'      => 'required',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'floor_plan' => 'image|mimes:jpeg,jpg,png',
            'description'        => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            $propertyimage = Image::make($image)->stream();
            Storage::disk('public')->put('property/' . $imagename, $propertyimage);
        }

        $floor_plan = $request->file('floor_plan');
        if (isset($floor_plan)) {
            $currentDate = Carbon::now()->toDateString();
            $imagefloorplan = 'floor-plan-' . $currentDate . '-' . uniqid() . '.' . $floor_plan->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            $propertyfloorplan = Image::make($floor_plan)->stream();
            Storage::disk('public')->put('property/' . $imagefloorplan, $propertyfloorplan);
        } else {
            $imagefloorplan = 'default.png';
        }

        $city_id = $request->city_id;

        $product_count = Property::withTrashed()->count() + 1;
        $product_code = Auth::id() . '-' . $product_count . Carbon::now()->timestamp;

        $property = new Property();
        $property->title    = $request->title;
        $property->product_code    = $product_code;
        $property->slug     = $slug;
        $property->price    = $request->price;
        $property->purpose  = Purpose::find($request->purpose_id)->name;
        $property->type     = Type::find($request->type_id)->name;
        $property->garage     = $request->garage;
        $property->built_year     = $request->built_year;
        $property->image    = $imagename;
        $property->bedroom  = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->city     = City::find($city_id)->name;
        $property->city_slug = City::find($city_id)->slug;
        $property->address  = $request->address . $request->input('address1', null);
        $property->area     = $request->area;

        if (isset($request->featured)) {
            $property->featured = true;
        }
        $property->agent_id           = Auth::id();
        $property->type_id           =  $request->type_id;
        $property->purpose_id           = $request->purpose_id;
        $property->city_id           =  $city_id;
        // $property->country_id           =  User::find(Auth::id())->country_id;
        $property->video              = $request->video;
        $property->floor_plan         = $imagefloorplan;
        $property->description        = $request->description;
        $property->location_latitude  = $request->latitude;
        $property->location_longitude = $request->longitude;
        $property->save();

        $nearbyCategories = NearbyCategory::all();
        if ($nearbyCategories) {
            foreach ($nearbyCategories as $key => $near_category) {

                if (isset($request[$near_category->slug]) && !empty($request[$near_category->slug])) {
                    if (isset($request[$near_category->slug][0][$near_category->slug . '_name']) && !empty($request[$near_category->slug][0][$near_category->slug . '_name'])) {

                        foreach ($request[$near_category->slug] as $each_items) {

                            $ins_data = array(
                                'nearby_category_id' => $near_category->id,
                                'property_id' => $property->id,
                                'title' => $each_items[$near_category->slug . '_name'],
                                'distance' =>  $each_items[$near_category->slug . '_distance'],
                            );

                            NearbyProperty::create($ins_data);
                        }
                    }
                }
            }
        }

        $property->features()->attach($request->features);

        $property->tags()->attach($request->tags);

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
        $nearby_categories = NearbyCategory::all();
        $property_nearby = NearbyProperty::where('property_id', $property->id)->get();
        $parent_property = Property::where('is_parent_property', -1)->get();

        $cities = City::all();
        $tags = Tag::where('type', 'property')->get();
        $user_data = User::with('country')->where('id', Auth::id())->first();
        $currency = $user_data->country->currency;
        return view('agent.properties.edit', compact('property', 'features', 'parent_property', 'types', 'cities', 'tags', 'purposes', 'nearby_categories', 'currency'));
    }


    public function update(Request $request, $property)
    {

        $request->validate([
            'title'     => 'required|max:255',
            'price'     => 'required',
            'purpose_id'   => 'required',
            'type_id'      => 'required',
            'bedroom'   => 'required',
            'bathroom'  => 'required',
            'city_id'      => 'required',
            'address'   => 'required',
            'area'      => 'required',
            // 'image'     => 'required|image|mimes:jpeg,jpg,png',
            'floor_plan' => 'image|mimes:jpeg,jpg,png',
            'description'        => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
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

        $city_id = $request->city_id;

        $product_count = Property::withTrashed()->count() + 1;
        $product_code = Auth::id() . '-' . $product_count . Carbon::now()->timestamp;

        $property->title    = $request->title;
        // $property->product_code    = $product_code;
        $property->slug     = $slug;
        $property->price    = $request->price;
        $property->purpose  = Purpose::find($request->purpose_id)->name;
        $property->type     = Type::find($request->type_id)->name;
        $property->garage     = $request->garage;
        $property->built_year     = $request->built_year;
        $property->image    = $imagename;
        $property->bedroom  = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->city     = City::find($city_id)->name;
        $property->city_slug = City::find($city_id)->slug;
        $property->address  = $request->address . $request->input('address1', null);
        $property->area     = $request->area;

        if (isset($request->featured)) {
            $property->featured = true;
        } else {
            $property->featured = false;
        }
        $property->type_id           =  $request->type_id;
        $property->purpose_id           = $request->purpose_id;
        $property->city_id           =  $city_id;
        $property->country_id           =  User::find(Auth::id())->country_id;
        $property->description          = $request->description;
        $property->video                = $request->video;
        $property->floor_plan           = $imagefloorplan;
        $property->location_latitude    = $request->latitude;
        $property->location_longitude   = $request->longitude;
        $property->save();

        $property->features()->sync($request->features);
        $property->tags()->sync($request->tags);

        $nearbyCategories = NearbyCategory::all();
        if ($nearbyCategories) {
            foreach ($nearbyCategories as $key => $near_category) {

                if (isset($request[$near_category->slug]) && !empty($request[$near_category->slug])) {
                    if (isset($request[$near_category->slug][0][$near_category->slug . '_name']) && !empty($request[$near_category->slug][0][$near_category->slug . '_name'])) {

                        NearbyProperty::where('property_id', $property->id)->delete();

                        foreach ($request[$near_category->slug] as $each_items) {


                            $ins_data = array(
                                'nearby_category_id' => $near_category->id,
                                'property_id' => $property->id,
                                'title' => $each_items[$near_category->slug . '_name'],
                                'distance' =>  $each_items[$near_category->slug . '_distance'],
                            );
                            NearbyProperty::create($ins_data);
                        }
                    }
                }
            }
        }
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