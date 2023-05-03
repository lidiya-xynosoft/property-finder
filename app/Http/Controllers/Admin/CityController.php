<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\City;
use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::latest()->get();

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::where('is_active', 1)->get();

        return view('admin.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'country_id' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('city')) {
                Storage::disk('public')->makeDirectory('city');
            }
            $city = Image::make($image)->resize(160, 160)->stream();

            Storage::disk('public')->put('city/' . $imagename, $city);
        } else {
            $imagename = 'default.png';
        }

        $city = new City();
        $city->name = $request->title;
        $city->slug = $slug;
        $city->country_id = $request->country_id;
        $city->image = $imagename;
        $city->city_order = $request->city_order ? $request->city_order : 0;
        $city->latitude = $request->latitude;
        $city->longitude = $request->longitude;
        $city->save();
        $flash = array('type' => 'success', 'msg' => 'City created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'City created successfully.');
        return redirect()->route('admin.cities.index');
    }

    public function edit(City $city)
    {
        $city = City::findOrFail($city->id);
        $countries = Country::where('is_active', 1)->get();

        return view('admin.cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'country_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        $city = City::find($city->id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('city')) {
                Storage::disk('public')->makeDirectory('city');
            }
            if (Storage::disk('public')->exists('city/' . $city->icon)) {
                Storage::disk('public')->delete('city/' . $city->icon);
            }
            $testimonialimg = Image::make($image)->resize(160, 160)->stream();
            Storage::disk('public')->put('city/' . $imagename, $testimonialimg);
        } else {
            $imagename = $city->icon;
        }
        $slug = str_slug($request->title);

        $city = City::findOrFail($city->id);
        $city->name = $request->title;
        $city->country_id = $request->country_id;
        $city->slug = $slug;
        $city->latitude = $request->latitude;
        $city->longitude = $request->longitude;
        $city->image = $imagename;
        $city->city_order = $request->city_order ? $request->city_order : 0;
        $city->save();

        $flash = array('type' => 'success', 'msg' => 'City updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.cities.index');
    }

    public function destroy(City $city)
    {
        $city = City::findOrFail($city->id);
        $city->delete();
        $flash = array('type' => 'success', 'msg' => 'City deleted successfully.');
        session()->flash('flash', $flash);
        return back();
    }
}