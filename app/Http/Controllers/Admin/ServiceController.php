<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::latest()->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required',
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
        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->icon = $imagename;
        $service->service_order = $request->service_order;
        $service->save();
        $flash = array('type' => 'success', 'msg' => 'Service created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'Service created successfully.');
        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        $service = Service::findOrFail($service->id);

        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate(['title' => 'required',
            'description' => 'required|max:200',
            'image' => 'required|mimes:jpeg,jpg,png',
            'service_order' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        $service = Service::find($service->id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('service')) {
                Storage::disk('public')->makeDirectory('service');
            }
            if (Storage::disk('public')->exists('service/' . $service->icon)) {
                Storage::disk('public')->delete('service/' . $service->icon);
            }
            $testimonialimg = Image::make($image)->resize(160, 160)->stream();
            Storage::disk('public')->put('service/' . $imagename, $testimonialimg);
        } else {
            $imagename = $service->icon;
        }
        $service = Service::findOrFail($service->id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->icon = $imagename;
        $service->service_order = $request->service_order;
        $service->save();

        $flash = array('type' => 'success', 'msg' => 'Service updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.services.index');
    }

    public function destroy(Service $service)
    {
        $service = Service::findOrFail($service->id);
        $service->delete();

        // Toastr::success('message', 'Service deleted successfully.');
        return back();
    }
}