<?php

namespace App\Http\Controllers\Admin;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;
use App\Feature;
use App\PropertyImageGallery;
use App\Comment;
use App\Customer;
use App\DocumentType;
use App\Ledger;
use App\NearbyCategory;
use App\NearbyProperty;
use App\PaymentType;
use App\PropertyAgreement;
use App\PropertyAgreementDocument;
use App\PropertyCustomer;
use App\PropertyDocument;
use App\PropertyExpense;
use App\PropertyIncome;
use App\PropertyRent;
use App\Purpose;
use App\Setting;
use App\Tag;
use App\Type;
use App\User;
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
        // if ($type ==  -1) {
        $properties = Property::latest()->withCount('comments')->get();
        // } else {
            // $properties = Property::where('is_parent_property', '!=', -1)->latest()->withCount('comments')->get();
        // }

        return view('admin.properties.index', compact('properties'));
    }


    public function create()
    {
        $data = [];
        $data['features'] = Feature::all();
        $data['tags'] = Tag::where('type', 'property')->get();
        $data['purposes'] = Purpose::all();
        $data['types'] = Type::all();
        $data['nearby_categories'] = NearbyCategory::all();
        $data['parent_property'] = Property::where('is_parent_property', -1)->get();
        $data['cities'] = City::all();
        $data['document_types'] = DocumentType::where('type', 1)->get();

        $user_data = User::with('country')->where('id', Auth::id())->first();
        $data['currency'] = $user_data->country->currency;
        return view('admin.properties.create')->with($data);
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
            // 'floor_plan' => 'image|mimes:jpeg,jpg,png',
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
        $property->is_parent_property  = $request->parent_property_id;
        $property->bathroom = $request->bathroom;
        $property->city     = City::find($city_id)->name;
        $property->city_slug = City::find($city_id)->slug;
        $property->address  = $request->address . $request->input('address1', null);
        $property->area     = $request->area;
        $property->electricity_no     = $request->electricity_no;
        $property->water_no     = $request->water_no;
        $property->street_no     = $request->street_no;
        $property->zone_no     = $request->zone_no;
        $property->building_no     = $request->building_no;

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

        if (isset($request['documents']) && !empty($request['documents'])) {

            foreach ($request['documents'] as $each_items) {

                if (isset($each_items['document_file'])) {
                    // $rules['document_file'] = 'required|mimes:jpg,jpeg,pdf,doc,docx|max:5009';
                    // $request->validate($rules);
                    $file = $each_items['document_file'];
                    $destinationPath = 'property/files';
                    $extension = $file->getClientOriginalExtension();;
                    $fileName = time() . '.' . $extension;
                    $uploadSuccess = $file->storeAs($destinationPath, $fileName, 'public');
                    $file_name = $destinationPath . '/' . $fileName;
                    $data =   PropertyDocument::create([
                        'property_id' => $property->id,
                        'document_type_id' => $each_items['document_type_id'],
                        'file' => $file_name,
                    ]);
                    // } else {
                    //     $data = null;
                    // }
                }
            }
        }
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

        // return redirect()->route('admin.properties.index');
        return redirect()->route('admin.properties.index');

    }


    public function show(Property $property)
    {
        $property = Property::withCount('comments')->find($property->id);
        $documents = PropertyDocument::where('property_id', $property->id)->get();
        $videoembed = $this->convertYoutube($property->video, 560, 315);

        return view('admin.properties.show', compact('property', 'videoembed', 'documents'));
    }


    public function edit(Property $property)
    {
        $features = Feature::all();
        $property = Property::where('slug', $property->slug)->first();
        $purposes = Purpose::all();
        $types = Type::all();
        $nearby_categories = NearbyCategory::all();
        $property_nearby = NearbyProperty::where('property_id', $property->id)->get();
        $documents = PropertyDocument::where('property_id', $property->id)->get();
        $document_types = DocumentType::where('type', 1)->get();
        $parent_property = Property::where('is_parent_property', -1)->get();

        $cities = City::all();
        $tags = Tag::where('type', 'property')->get();
        $user_data = User::with('country')->where('id', Auth::id())->first();
        $currency = $user_data->country->currency;
        $videoembed = $this->convertYoutube($property->video);

        return view('admin.properties.edit', compact('property', 'parent_property', 'features', 'documents', 'document_types', 'types', 'cities', 'tags', 'purposes', 'nearby_categories', 'currency', 'videoembed'));
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
            // 'description'        => 'required',
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
        $property->electricity_no     = $request->electricity_no;
        $property->water_no     = $request->water_no;
        $property->street_no     = $request->street_no;
        $property->zone_no     = $request->zone_no;
        $property->building_no     = $request->building_no;
        if (isset($request->featured)) {
            $property->featured = true;
        } else {
            $property->featured = false;
        }

        $property->is_parent_property  = $request->parent_property_id;

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

        if (isset($request['documents']) && !empty($request['documents'])) {

            foreach ($request['documents'] as $each_items) {

                if (isset($each_items['document_file'])) {
                    // $rules['document_file'] = 'required|mimes:jpg,jpeg,pdf,doc,docx|max:5009';
                    // $request->validate($rules);
                    $file = $each_items['document_file'];
                    $destinationPath = 'property/files';
                    $extension = $file->getClientOriginalExtension();;
                    $fileName = time() . '.' . $extension;
                    $uploadSuccess = $file->storeAs($destinationPath, $fileName, 'public');
                    $file_name = $destinationPath . '/' . $fileName;
                    $data =   PropertyDocument::create([
                        'property_id' => $property->id,
                        'document_type_id' => $each_items['document_type_id'],
                        'file' => $file_name,
                    ]);
                    // } else {
                    //     $data = null;
                    // }
                }
            }
        }

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
        return redirect()->route('admin.properties.index');

        // return redirect()->url('admin/properties/index/0');
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
        $data['document_types'] = DocumentType::where('type', 0)->get();
        $data['payment_types'] = PaymentType::all();
        $data['documents'] = PropertyAgreementDocument::with('DocumentType')->where(['property_id' => $property_id])->get()->toArray();
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
                        'month' => $dt->format("Y-m-d"),
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
        ])->latest()->get();
        $data['settings'] = Setting::first();
        $data['customers'] = Customer::all();
        return view('admin.properties.manage')->with($data);
    }
}