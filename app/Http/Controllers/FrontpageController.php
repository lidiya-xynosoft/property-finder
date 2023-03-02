<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use Illuminate\Http\Request;
use App\Testimonial;
use App\Property;
use App\Service;
use App\Slider;
use App\Post;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;

class FrontpageController extends Controller
{

    public function index()
    {
        $sliders        = Slider::latest()->get();
        $properties     = Property::latest()->with('rating')->withCount('comments')->take(6)->get();
        $services       = Service::orderBy('service_order')->take(4)->get();
        $testimonials   = Testimonial::latest()->get();
        $agents          = User::latest()->where('role_id', 2)->take(6)->get();
        $posts          = Post::latest()->where('status', 1)->take(6)->get();
        $cities = City::all();

        foreach ($cities as $key => $city) {
            $processed_cities[$key] = array(
                'total_property' => $city->property->pluck('city_id')->count(),
                'image' => $city->image,
                'city_name' => $city->name,
                'city_slug' => $city->slug
            );
        }
        if (Auth::user()) {
            $user_data = User::with('country')->where('id', Auth::id())->first();
            $currency = $user_data->country->currency;
        } else {
            $currency = Setting::find(1)->currency;
        }
        $categories   = Category::has('posts')->withCount('posts')->get();

        return view('frontend.index', compact('sliders', 'properties', 'services', 'testimonials', 'posts', 'agents', 'processed_cities', 'categories', 'currency'));
    }


    public function search(Request $request)
    {
        $city     = strtolower($request->city);
        $type     = $request->type;
        $purpose  = $request->purpose;
        $bedroom  = $request->bedroom;
        $bathroom = $request->bathroom;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $minarea  = $request->minarea;
        $maxarea  = $request->maxarea;
        $featured = $request->featured;

        $properties = Property::latest()->withCount('comments')
            ->when($city, function ($query, $city) {
                return $query->where('city', '=', $city);
            })
            ->when($type, function ($query, $type) {
                return $query->where('type', '=', $type);
            })
            ->when($purpose, function ($query, $purpose) {
                return $query->where('purpose', '=', $purpose);
            })
            ->when($bedroom, function ($query, $bedroom) {
                return $query->where('bedroom', '=', $bedroom);
            })
            ->when($bathroom, function ($query, $bathroom) {
                return $query->where('bathroom', '=', $bathroom);
            })
            ->when($minprice, function ($query, $minprice) {
                return $query->where('price', '>=', $minprice);
            })
            ->when($maxprice, function ($query, $maxprice) {
                return $query->where('price', '<=', $maxprice);
            })
            ->when($minarea, function ($query, $minarea) {
                return $query->where('area', '>=', $minarea);
            })
            ->when($maxarea, function ($query, $maxarea) {
                return $query->where('area', '<=', $maxarea);
            })
            ->when($featured, function ($query, $featured) {
                return $query->where('featured', '=', 1);
            })
            ->paginate(10);
        $recent_properties     = Property::latest()->where('featured', 0)->with('rating')->withCount('comments')->take(3)->get();

        return view('pages.search', compact('properties', 'recent_properties'));
    }
}