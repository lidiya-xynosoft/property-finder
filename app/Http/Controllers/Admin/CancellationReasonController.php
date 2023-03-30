<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CancellationReason;

class CancellationReasonController extends Controller
{

    public function index()
    {
        $cancellation_reason  = CancellationReason::latest()->get();

        return view('admin.cancellation-reason.index', compact('cancellation_reason'));
    }


    public function create()
    {
        return view('admin.cancellation-reason.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|unique:cancellation_reasons|max:255',
        ]);
        $service_list = new CancellationReason();
        $service_list->reason = $request['reason'];

        $service_list->save();

        $flash = array('type' => 'success', 'msg' => 'Cancellation Reason created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.cancellation-reason.index');
    }


    public function edit($id)
    {
        $cancellation_reason  = CancellationReason::find($id);

        return view('admin.cancellation-reason.edit', compact('cancellation_reason'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $service_list = CancellationReason::find($id);


        $service_list = CancellationReason::find($id);
        $service_list->reason = $request->name;
        $service_list->save();

        $flash = array('type' => 'success', 'msg' => 'Cancellation reason updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.cancellation-reason.index');
    }


    public function destroy($id)
    {
        $feature = CancellationReason::find($id);
        $feature->delete();

        return back();
    }
}
