<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\ComplaintImage;
use App\ComplaintImages;
use App\Customer;
use Illuminate\Http\Request;
use App\Testimonial;
use App\Property;
use App\Service;
use App\Slider;
use App\Post;
use App\PropertyAgreement;
use App\PropertyComplaint;
use App\ServiceList;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\image;

class FrontpageController extends Controller
{

    public function index()
    {
        $homeImage        = Slider::latest()->first();
        $properties     = Property::latest()->with('rating')->withCount('comments')->take(6)->get();
        $services       = Service::orderBy('service_order')->take(4)->get();
        $testimonials   = Testimonial::latest()->get();
        $agents          = User::latest()->where('role_id', 2)->take(6)->get();
        $posts          = Post::latest()->where('status', 1)->take(6)->get();
        $cities = City::latest()->get();
        $processed_cities = [];
        if ($cities) {
            foreach ($cities as $key => $city) {
                if ($city->property->pluck('city_id')->count() > 0) {
                    $processed_cities[$key] = array(
                        'total_property' => $city->property->pluck('city_id')->count(),
                        'image' => $city->image,
                        'city_name' => $city->name,
                        'city_slug' => $city->slug,
                        'city_id' => $city->id
                    );
                }
            }
        }
        if (Auth::user()) {
            $user_data = User::with('country')->where('id', Auth::id())->first();
            $currency = $user_data->country->currency;
        } else {
            $currency = Setting::find(1)->currency;
        }
        $categories   = Category::has('posts')->withCount('posts')->get();

        return view('frontend.index', compact('homeImage', 'properties', 'services', 'testimonials', 'posts', 'agents', 'processed_cities', 'categories', 'currency'));
    }


    public function search(Request $request)
    {
        $keyword     = strtolower($request->keyword);
        $type     = $request->type;
        $city     = $request->city;
        $purpose  = $request->purpose;
        $bedroom  = $request->bedroom;
        $bathroom = $request->bathroom;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $minarea  = $request->minarea;
        $maxarea  = $request->maxarea;
        $featured = $request->featured;
        $properties = Property::withCount('comments')
            ->where('city_id', '=', $city)
            ->orWhere('purpose_id', '=', $purpose)
            ->orWhere('type_id', '=', $type)
            ->orWhere('bathroom', '=', $bathroom)
            ->orWhere('bedroom', '=', $bedroom)
            ->paginate(10);
        $recent_properties     = Property::latest()->where('featured', 0)->with('rating')->withCount('comments')->take(3)->get();

        return view('pages.search', compact('properties', 'recent_properties'));
    }

    // CONATCT PAGE
    public function complaintForm()
    {
        return view('pages.complaint');
    }

    public function tenantComplaints(Request $request)
    {
        $request->validate([
            'email'     => 'required',
        ]);
        $details = [];
        $data = [];
        if (isset($request['agreement_id'])) {
            $customer_id = $request['customer_id'];
            $complaint_number =
                $customer_id . '-' . $request['agreement_id'] . Carbon::now()->timestamp;


            $registration =  PropertyComplaint::create([
                'property_id' => PropertyAgreement::find($request['agreement_id'])->property_id,
                'complaint_number' => $complaint_number,
                'property_agreement_id' => $request['agreement_id'],
                'service_list_id' => $request['service_list_id'],
                'customer_id' => $customer_id,
                'complaint' => $request['complaint'],
            ]);

            $gallary = $request->file('complaintimage');
            if ($gallary) {
                foreach ($gallary as $images) {
                    if (isset($images)) {
                        $currentDate = Carbon::now()->toDateString();
                        $galimage['name'] = 'gallary-' . $currentDate . '-' . uniqid() . '.' . $images->getClientOriginalExtension();
                        // $galimage['size'] = $images->getClientSize();
                        $galimage['property_complaint_id'] = $registration->id;

                        if (!Storage::disk('public')->exists('complaint/gallery')) {
                            Storage::disk('public')->makeDirectory('complaint/gallery');
                        }
                        $propertyimage = Image::make($images)->stream();
                        Storage::disk('public')->put('complaint/gallery/' . $galimage['name'], $propertyimage);

                        ComplaintImage::create($galimage);
                    }
                }
            }
            $data['tenant_properties'] = [];
            $data['customer_data'] = [];
            $data['service_list'] = [];
            if ($request->ajax()) {
                $url = URL::to('/tenant/complaint'); // Base URL;

                return response()->json(['message' => 'Thank you, We have recieved your complaint.', 'url' =>  $url]);
            }
        } else {
            if (Customer::where('email', $request['email'])->first() && PropertyAgreement::where(['customer_id' => Customer::where('email', $request['email'])->first()->id, 'is_withdraw' => 0, 'is_published' => 1])->first()) {
                $customer_id = Customer::where('email', $request['email'])->first()->id;
                $agreement_data = PropertyAgreement::where('customer_id', $customer_id)->get();
                if ($agreement_data) {
                    foreach ($agreement_data as $key => $row) {
                        $details[] = array(
                            'agreement_number' => $row->agreement_id,
                            'agreement_id' => $row->id,
                            'property_code' => Property::find($row->property_id)->product_code,
                            'customer_name' => Customer::find($customer_id)->first_name . ' ' . Customer::find($customer_id)->last_name,
                            'contract_period' => $row->lease_commencement . ' to ' . $row->lease_expiry,
                            'property_address' => Property::find($row->property_id)->address
                        );
                    }
                    $data['tenant_properties'] = $details;
                    $data['customer_data'] = Customer::where('email', $request['email'])->first();
                    $data['service_list'] = ServiceList::all();
                }
            } else {
                $flash = array('type' => 'error', 'msg' => 'No details found');
                session()->flash('flash', $flash);
            }
            return view('pages.complaint')->with($data);
        }

        return view('pages.complaint')->with($data);
    }
}
