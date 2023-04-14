<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Landloard;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LandloardController extends Controller
{

    public function index()
    {
        $landloards = Landloard::latest()->get();

        return view('admin.landloards.index', compact('landloards'));
    }
    public function list()
    {
        $data = array();
        $data['landloards'] = Landloard::with('PropertyLandloard', 'PropertyAgreement')->get()->toArray();
        // return $data;
        return view('admin.landloards.list')->with($data);
    }

    public function create()
    {
        return view('admin.landloards.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'last_name' => 'required',
            'phone' => 'required',
        ]);

        $landloard = new Landloard();
        $landloard->address = $request->address;
        $landloard->first_name = $request->first_name;
        $landloard->last_name = $request->last_name;
        $landloard->email = $request->email;
        $landloard->phone = $request->phone;
        $landloard->save();
        $flash = array('type' => 'success', 'msg' => 'Landloard created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.landloards.index');
    }

    public function edit(Landloard $landloard)
    {
        $landloard = Landloard::findOrFail($landloard->id);

        return view('admin.landloards.edit', compact('landloard'));
    }

    public function update(Request $request, Landloard $landloard)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $landloard->user_id,
            'last_name' => 'required',
            'phone' => 'required',
        ]);

        $landloard =  Landloard::findOrFail($landloard->id);

        $landloard->first_name = $request->first_name;
        $landloard->address = $request->address;
        $landloard->last_name = $request->last_name;
        $landloard->email = $request->email;
        $landloard->phone = $request->phone;
        $landloard->save();

        $flash = array('type' => 'success', 'msg' => 'Landloard updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.landloards.index');
    }

    public function destroy(Landloard $landloard)
    {
        $landloard = Landloard::findOrFail($landloard->id);
        $landloard->delete();

        // Toastr::success('message', 'Landloard deleted successfully.');
        return back();
    }
    public function show($landloard)
    {
        $landloard = Landloard::whereId($landloard)->first()->toArray();

        // Toastr::success('message', 'Landloard deleted successfully.');
        return $landloard;
    }
}