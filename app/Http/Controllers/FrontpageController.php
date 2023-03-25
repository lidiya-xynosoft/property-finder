<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Customer;
use Illuminate\Http\Request;
use App\Testimonial;
use App\Property;
use App\Service;
use App\Slider;
use App\Post;
use App\PropertyAgreement;
use App\ServiceList;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;

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

        $rules = [
            'first_name'      => 'required',
            'last_name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
        ];
        $request->validate($rules);
        $details = [];
        $data = [];
        if (isset($request['agreement_id'])) {


            if ($request->ajax()) {
                return response()->json(['message' => 'Thank you, We have recieved your enquiry.']);
            }
        } else {
            if (Customer::where('email', $request['email'])->first()) {
                $customer_id = Customer::where('email', $request['email'])->first()->id;
                $agreement_data = PropertyAgreement::where('customer_id', $customer_id)->get();
                if ($agreement_data) {
                    foreach ($agreement_data as $key => $row) {
                        $details[] = array(
                            'agreement_number' => $row->agreement_id,
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
                return response()->json(['message' => 'No details found']);
            }
            return view('pages.complaint')->with($data);
        }

        $message  = $request->message;
        $mailfrom = $request->email;

        // Message::create([
        //     'agent_id'  => 1,
        //     'name'      => $request->name,
        //     'email'     => $mailfrom,
        //     'phone'     => $request->phone,
        //     'message'   => $message
        // ]);

        $adminname  = User::find(1)->name;
        $mailto     = $request->mailto;

        // Mail::to($mailto)->send(new Contact($message,$adminname,$mailfrom));

        // $flash = array('type' => 'success', 'msg' => 'Thank you, We have recieved your enquiry.');
        // $request->session()->flash('flash', $flash);
        // return back();


    }
}