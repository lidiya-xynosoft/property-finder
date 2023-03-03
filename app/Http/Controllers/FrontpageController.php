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
        $processed_cities = [];
        if ($cities) {
            foreach ($cities as $key => $city) {
                $processed_cities[$key] = array(
                    'total_property' => $city->property->pluck('city_id')->count(),
                    'image' => $city->image,
                    'city_name' => $city->name,
                    'city_slug' => $city->slug
                );
            }
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
}