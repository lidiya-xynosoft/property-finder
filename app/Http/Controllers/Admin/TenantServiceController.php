<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ServiceList;

class TenantServiceController extends Controller
{

    public function index()
    {
        $tenant_service  = ServiceList::latest()->get();

        return view('admin.tenant-service.index', compact('tenant_service'));
    }


    public function create()
    {
        return view('admin.tenant-service.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:service_lists|max:255',
        ]);

        $service_list = new ServiceList();
        $service_list->name = $request->name;

        $service_list->save();

        $flash = array('type' => 'success', 'msg' => 'Tenant service created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.tenant-service.index');
    }


    public function edit($id)
    {
        $tenant_service  = ServiceList::find($id);

        return view('admin.tenant-service.edit', compact('tenant_service'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $service_list = ServiceList::find($id);


        $service_list = ServiceList::find($id);
        $service_list->name = $request->name;
        $service_list->save();

        $flash = array('type' => 'success', 'msg' => 'tenant service updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.tenant-service.index');
    }


    public function destroy($id)
    {
        $feature = ServiceList::find($id);
        $feature->delete();
        $feature->features()->detach();

        // Toastr::success('message', 'ServiceList deleted successfully.');
        return back();
    }
}
