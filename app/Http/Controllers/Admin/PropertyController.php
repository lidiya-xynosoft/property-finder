<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;
use App\Feature;
use App\PropertyImageGallery;
use App\Comment;
use App\DocumentType;
use App\Ledger;
use App\PaymentType;
use App\PropertyAgreement;
use App\PropertyCustomer;
use App\PropertyDocument;
use App\PropertyExpense;
use App\PropertyIncome;
use App\PropertyRent;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Toastr;
use Illuminate\Support\Facades\Auth;
use File;

class PropertyController extends Controller
{

    public function index()
    {
        $properties = Property::latest()->withCount('comments')->get();

        return view('admin.properties.index', compact('properties'));
    }


    public function create()
    {
        $features = Feature::all();

        return view('admin.properties.create', compact('features'));
    }


    public function store(Request $request)
    {
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
            'location_latitude'  => 'required',
            'location_longitude' => 'required',
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

        $property = new Property();
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
        }
        $property->agent_id = Auth::id();
        $property->description          = $request->description;
        $property->video                = $request->video;
        $property->floor_plan           = $imagefloorplan;
        $property->location_latitude    = $request->location_latitude;
        $property->location_longitude   = $request->location_longitude;
        $property->nearby               = $request->nearby;
        $property->save();

        $property->features()->attach($request->features);


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

        return redirect()->route('admin.properties.index');
    }


    public function show(Property $property)
    {
        $property = Property::withCount('comments')->find($property->id);

        $videoembed = $this->convertYoutube($property->video, 560, 315);

        return view('admin.properties.show', compact('property', 'videoembed'));
    }


    public function edit(Property $property)
    {
        $features = Feature::all();
        $property = Property::find($property->id);

        $videoembed = $this->convertYoutube($property->video);

        return view('admin.properties.edit', compact('property', 'features', 'videoembed'));
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

        $property->title        = $request->title;
        $property->slug         = $slug;
        $property->price        = $request->price;
        $property->purpose      = $request->purpose;
        $property->type         = $request->type;
        $property->image        = $imagename;
        $property->bedroom      = $request->bedroom;
        $property->bathroom     = $request->bathroom;
        $property->city         = $request->city;
        $property->city_slug    = str_slug($request->city);
        $property->address      = $request->address;
        $property->area         = $request->area;

        if (isset($request->featured)) {
            $property->featured = true;
        } else {
            $property->featured = false;
        }

        $property->description  = $request->description;
        $property->video        = $request->video;
        $property->floor_plan   = $imagefloorplan;
        $property->location_latitude  = $request->location_latitude;
        $property->location_longitude = $request->location_longitude;
        $property->nearby             = $request->nearby;
        $property->save();

        $property->features()->sync($request->features);

        $gallary = $request->file('gallaryimage');
        if ($gallary) {
            foreach ($gallary as $images) {
                if (isset($images)) {
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
        }
        $flash = array('type' => 'success', 'msg' => 'Property updated successfully');
        $request->session()->flash('flash', $flash);
        // Toastr::success('message', 'Property updated successfully.');
        return redirect()->route('admin.properties.index');
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
        $property->comments()->delete();

        // Toastr::success('message', 'Property deleted successfully.');
        return back();
    }


    public function galleryImageDelete(Request $request)
    {

        $gallaryimg = PropertyImageGallery::find($request->id)->delete();

        if (Storage::disk('public')->exists('property/gallery/' . $request->image)) {
            Storage::disk('public')->delete('property/gallery/' . $request->image);
        }

        if ($request->ajax()) {

            return response()->json(['msg' => $gallaryimg]);
        }
    }

    // YOUTUBE LINK TO EMBED CODE
    private function convertYoutube($youtubelink, $w = 250, $h = 140)
    {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"$w\" height=\"$h\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>",
            $youtubelink
        );
    }

    public function propertyManage(Request $request)
    {
        $data = array();
        $data['property'] = Property::find($request['property_id']);
        if (isset($request['update_id'])) {
            $agreement_row_id = $request['update_id'];
            $property_id = PropertyAgreement::find($agreement_row_id)->property_id;
        } else {
            $property_id =
                $request['property_id'];
        }
        $data['property'] = Property::find($property_id);

        if (isset($request['update_id'])) {
            $data['update_data'] = PropertyAgreement::where(['is_withdraw' => 0, 'id' => $agreement_row_id])->first();
        }
        $data['rows'] = [];
        $data['income'] = [];
        $data['total_expense'] = null;
        $data['fixed_expenses'] = [];
        $data['total_income'] = null;
        $data['property_history'] = [];
        if (PropertyAgreement::where(['property_id' => $property_id, 'is_withdraw' => 0])->first()) {
            $data['rows'] = PropertyAgreement::with([
                'PropertyCustomer' => function ($query) use ($property_id) {
                    $query->where(['property_id' => $property_id, 'is_withdraw' => 0])->get();
                },
            ])->where(['property_id' => $property_id, 'is_withdraw' => 0])->first()->toArray();
        }


        $data['ledger_expense'] = Ledger::where('type', 1)->get();
        $data['ledger_income'] = Ledger::where('type', 0)->get();
        $data['document_types'] = DocumentType::all();
        $data['payment_types'] = PaymentType::all();
        $data['documents'] = PropertyDocument::with('DocumentType')->where('property_id', $property_id)->get()->toArray();
        $data['rent_months'] = [];
        if (isset($data['rows']) && !empty($data['rows'])) {
            $rent_months = PropertyRent::where(['property_id' => $property_id, 'property_agreement_id' => $data['rows']['id'], 'status' => 1])->get();
            if (count($rent_months) > 0) {
                $data['rent_months'] = $rent_months;
            } else {
                $result = CarbonPeriod::create($data['rows']['lease_commencement'], '1 month', $data['rows']['lease_expiry']);

                foreach ($result as $dt) {
                    PropertyRent::create([
                        'property_id' => $property_id,
                        'payment_type_id' => '1', // cash payment
                        'property_agreement_id' => $data['rows']['id'],
                        'month' => $dt->format("Y-M"),
                        'rental_date' => $data['rows']['rent_payment_commencement'],
                        'rent_amount' => $data['rows']['monthly_rent'],
                    ]);
                }
                $rent_months = PropertyRent::where(['property_id' => $property_id, 'property_agreement_id' => $data['rows']['id'], 'status' => 1])->get();
                $data['rent_months'] = $rent_months;
            }
            $data['fixed_expenses'] = PropertyExpense::with('Ledger')->where(['property_id' => $property_id, 'status' => 1, 'property_agreement_id' => $data['rows']['id']])->get()->toArray();

            $data['income'] =  PropertyIncome::with('Ledger')->where([
                'property_id' => $property_id, 'status' => 1,
                'property_agreement_id' => $data['rows']['id']
            ])->get();

            $data['total_expense'] =  PropertyExpense::where([
                'property_id' => $property_id,
                'status' => 1,
                'property_agreement_id' => $data['rows']['id']
            ])->sum('amount');
            $data['total_income'] =  PropertyIncome::where([
                'property_id' => $property_id,
                'status' => 1,
                'property_agreement_id' => $data['rows']['id']
            ])->sum('amount');
        }
        $data['property_history'] =  PropertyAgreement::where([
            'property_id' => $property_id,
        ])->get();
        return view('admin.properties.manage')->with($data);
    }
}