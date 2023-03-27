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

        return view('admin.aminities.index', compact('features'));
    }


    public function create()
    {
        return view('admin.aminities.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:features|max:255',
            'icon' => 'required|mimes:jpeg,jpg,png',
        ]);
        $image = $request->file('icon');
        $slug  = str_slug($request->name);


        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('aminity')) {
                Storage::disk('public')->makeDirectory('aminity');
            }
            $city = Image::make($image)->resize(160, 160)->stream();

            Storage::disk('public')->put('aminity/' . $imagename, $city);
        } else {
            $imagename = 'default.png';
        }
        $aminity = new Feature();
        $aminity->name = $request->name;
        $aminity->icon = $imagename;

        $aminity->slug = str_slug($request->name);
        $aminity->save();

        $flash = array('type' => 'success', 'msg' => 'Aminity created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.aminities.index');
    }


    public function edit($id)
    {
        $feature = Feature::find($id);

        return view('admin.aminities.edit', compact('feature'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'required|mimes:jpeg,jpg,png'
        ]);
        $image = $request->file('icon');
        $slug  = str_slug($request->name);
        $aminity = Feature::find($id);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('aminity')) {
                Storage::disk('public')->makeDirectory('aminity');
            }
            if (Storage::disk('public')->exists('aminity/' . $aminity->icon)) {
                Storage::disk('public')->delete('aminity/' . $aminity->icon);
            }
            $testimonialimg = Image::make($image)->resize(160, 160)->stream();
            Storage::disk('public')->put('aminity/' . $imagename, $testimonialimg);
        } else {
            $imagename = $aminity->icon;
        }

        $aminity = Feature::find($id);
        $aminity->name = $request->name;
        $aminity->icon = $imagename;

        $aminity->slug = str_slug($request->name);
        $aminity->save();

        $flash = array('type' => 'success', 'msg' => 'Aminity updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.aminities.index');
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