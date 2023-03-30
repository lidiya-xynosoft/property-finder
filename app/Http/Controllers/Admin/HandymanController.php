<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\DocumentType;
use App\Handyman;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HandymanController extends Controller
{

    public function index()
    {
        $handyman = Handyman::latest()->get();

        return view('admin.handyman.index', compact('handyman'));
    }
    public function list()
    {
        $data = array();
        $data['handyman'] = Handyman::latest()->get()->toArray();
        return view('admin.handyman.list')->with($data);
    }

    public function create()
    {
        $data = [];
        $data['document_types'] = DocumentType::all();

        return view('admin.handyman.create')->with($data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'document_type_id' => 'required',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
            'verification' => 'required',
            'phone' => 'required|min:6',
        ]);
        $user = User::create([
            'name'      => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make('123456'),
            'username'  => $request->input('email'),
            'role_id'   => '4', // handymans
            'contact_no' => $request->input('phone'),
            'country_id' => Country::where('is_active', 1)->first()->id,
        ]);
        $handyman = new Handyman();
        $handyman->user_id = $user->id;
        $handyman->first_name = $request->first_name;
        $handyman->last_name = $request->last_name;
        $handyman->email = $request->email;
        $handyman->phone = $request->phone;
        $handyman->address = $request->address;
        $handyman->verification = $request->verification;
        $handyman->status = $request->status;
        $handyman->document_type_id = $request->document_type_id;
        $handyman->save();
        $flash = array('type' => 'success', 'msg' => 'Handyman created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'Handyman created successfully.');
        return redirect()->route('admin.handyman.index');
    }

    public function edit(Handyman $handyman)
    {
        $data = [];
        $data['document_types'] = DocumentType::all();
        $data['handyman'] =
            Handyman::findOrFail($handyman->id);
        return view('admin.handyman.edit')->with($data);
    }

    public function update(Request $request, Handyman $handyman)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $handyman->user_id,
            'first_name' => 'required',
            'document_type_id' => 'required',
            'verification' => 'required',
            'phone' => 'required|min:6',
        ]);

        $handyman =  Handyman::findOrFail($handyman->id);
        User::whereId($handyman->user_id)->update([
            'name'      => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email'     => $request->input('email'),
            'username'  => $request->input('email'),
            'contact_no' => $request->input('phone'),
        ]);
        $handyman->first_name = $request->first_name;
        $handyman->last_name = $request->last_name;
        $handyman->email = $request->email;
        $handyman->phone = $request->phone;
        $handyman->address = $request->address;
        $handyman->verification = $request->verification;
        $handyman->status = $request->status;
        $handyman->document_type_id = $request->document_type_id;
        $handyman->save();

        $flash = array('type' => 'success', 'msg' => 'Handyman updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.handyman.index');
    }

    public function destroy(Handyman $handyman)
    {
        $handyman = Handyman::findOrFail($handyman->id);
        $handyman->delete();

        // Toastr::success('message', 'Handyman deleted successfully.');
        return back();
    }
}
