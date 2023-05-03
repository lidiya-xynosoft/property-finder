<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Feature;
use Intervention\Image\Facades\image as Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AminityController extends Controller
{

    public function index()
    {
        $features = Feature::latest()->get();

        return view('admin.amenities.index', compact('features'));
    }


    public function create()
    {
        return view('admin.amenities.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:features|max:255',
            // 'icon' => 'required|mimes:jpeg,jpg,png',
        ]);
        $image = $request->file('icon');
        $slug  = str_slug($request->name);


        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('amenity')) {
                Storage::disk('public')->makeDirectory('amenity');
            }
            $city = Image::make($image)->resize(160, 160)->stream();

            Storage::disk('public')->put('amenity/' . $imagename, $city);
        } else {
            $imagename = 'default.png';
        }
        $amenity = new Feature();
        $amenity->name = $request->name;
        $amenity->icon = $imagename;

        $amenity->slug = str_slug($request->name);
        $amenity->save();

        $flash = array('type' => 'success', 'msg' => 'Amenity created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.amenities.index');
    }


    public function edit($id)
    {
        $feature = Feature::find($id);

        return view('admin.amenities.edit', compact('feature'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            // 'icon' => 'required|mimes:jpeg,jpg,png'
        ]);
        $image = $request->file('icon');
        $slug  = str_slug($request->name);
        $amenity = Feature::find($id);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('amenity')) {
                Storage::disk('public')->makeDirectory('amenity');
            }
            if (Storage::disk('public')->exists('amenity/' . $amenity->icon)) {
                Storage::disk('public')->delete('amenity/' . $amenity->icon);
            }
            $testimonialimg = Image::make($image)->resize(160, 160)->stream();
            Storage::disk('public')->put('amenity/' . $imagename, $testimonialimg);
        } else {
            $imagename = $amenity->icon;
        }

        $amenity = Feature::find($id);
        $amenity->name = $request->name;
        $amenity->icon = $imagename;

        $amenity->slug = str_slug($request->name);
        $amenity->save();

        $flash = array('type' => 'success', 'msg' => 'Amenity updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.amenities.index');
    }


    public function destroy($id)
    {
        $feature = Feature::find($id);
        $feature->delete();
        // $feature->features()->detach();

        // Toastr::success('message', 'Feature deleted successfully.');
        return back();
    }
}