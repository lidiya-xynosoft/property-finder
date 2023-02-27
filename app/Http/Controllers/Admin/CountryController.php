<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CountryController extends Controller
{

    public function index()
    {
        $countries = Country::latest()->get();

        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:200',
            'image' => 'required|mimes:jpeg,jpg,png',
            'service_order' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('service')) {
                Storage::disk('public')->makeDirectory('service');
            }
            $service = Image::make($image)->resize(160, 160)->stream();

            Storage::disk('public')->put('service/' . $imagename, $service);
        } else {
            $imagename = 'default.png';
        }
        return $imagename;
        $service = new Country();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->icon = $imagename;
        $service->service_order = $request->service_order;
        $service->save();
        $flash = array('type' => 'success', 'msg' => 'Country created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'Country created successfully.');
        return redirect()->route('admin.countries.index');
    }

    public function edit(Country $country)
    {
        $country = Country::findOrFail($country->id);

        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'currency' => 'required',
            'status' => 'required',
        ]);

        $country = Country::find($country->id);


        $country = Country::findOrFail($country->id);
        $country->name = $request->name;
        $country->code = $request->code;
        $country->currency = $request->currency;
        $country->is_active = $request->status;
        $country->save();

        $flash = array('type' => 'success', 'msg' => 'Country updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.countries.index');
    }

    public function destroy(Country $country)
    {
        $country = Country::findOrFail($country->id);
        $country->delete();

        // Toastr::success('message', 'Country deleted successfully.');
        return back();
    }
}
