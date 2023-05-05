<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Customer;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{

    public function index()
    {
        $tenants = Customer::latest()->get();

        return view('admin.tenants.index', compact('tenants'));
    }
    public function list()
    {
        $data = array();
        $data['tenants'] = Customer::with('PropertyCustomer', 'PropertyAgreement')->get()->toArray();
        // return $data;
        return view('admin.tenants.list')->with($data);
    }
   
    public function create()
    {
        return view('admin.tenants.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
        ]);
        $user = User::create([
            'name'      => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make('123456'),
            'username'  => $request->input('email'),
            'role_id'   => '3',
            'country_id' => Country::where('is_active', 1)->first()->id,
            'contact_no' => $request->input('phone'),
        ]);
        $tenant = new Customer();
        $tenant->user_id = $user->id;
        $tenant->first_name = $request->first_name;
        $tenant->last_name = $request->last_name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->save();
        $flash = array('type' => 'success', 'msg' => 'Customer created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'Customer created successfully.');
        return redirect()->route('admin.tenants.index');
    }

    public function edit(Customer $tenant)
    {
        $tenant = Customer::findOrFail($tenant->id);

        return view('admin.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Customer $tenant)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $tenant->user_id,
            'phone' => 'required',
        ]);

        $tenant =  Customer::findOrFail($tenant->id);
        User::whereId($tenant->user_id)->update([
            'name'      => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email'     => $request->input('email'),
            'username'  => $request->input('email'),
            'contact_no' => $request->input('phone'),
        ]);
        $tenant->first_name = $request->first_name;
        $tenant->last_name = $request->last_name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->save();

        $flash = array('type' => 'success', 'msg' => 'Customer updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.tenants.index');
    }

    public function destroy(Customer $tenant)
    {
        $tenant = Customer::findOrFail($tenant->id);
        $tenant->delete();

        // Toastr::success('message', 'Customer deleted successfully.');
        return back();
    }
    public function show($tenant)
    {
        $tenant = Customer::whereId($tenant)->first()->toArray();

        // Toastr::success('message', 'Customer deleted successfully.');
        return $tenant;
    }
}