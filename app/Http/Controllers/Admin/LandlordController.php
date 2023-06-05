<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Landlord;
use App\Http\Controllers\Controller;
use App\landlordExpense;
use App\landlordIncome;
use App\landlordProperty;
use App\landlordRent;
use App\Post;
use App\User;
use Illuminate\Http\Request;


class landlordController extends Controller
{

    public function index()
    {
        $landlords = Landlord::latest()->get();

        return view('admin.landlords.index', compact('landlords'));
    }
    public function list()
    {
        $data = array();
        $data['landlords'] = Landlord::with('Propertylandlord', 'PropertyAgreement')->get()->toArray();
        // return $data;
        return view('admin.landlords.list')->with($data);
    }

    public function create()
    {
        return view('admin.landlords.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'last_name' => 'required',
            'phone' => 'required',
        ]);

        $landlord = new Landlord();
        $landlord->address = $request->address;
        $landlord->first_name = $request->first_name;
        $landlord->last_name = $request->last_name;
        $landlord->email = $request->email;
        $landlord->phone = $request->phone;
        $landlord->save();
        $flash = array('type' => 'success', 'msg' => 'Landlord created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.landlords.index');
    }

    public function edit(Landlord $landlord)
    {
        $landlord = Landlord::findOrFail($landlord->id);

        return view('admin.landlords.edit', compact('landlord'));
    }

    public function update(Request $request, Landlord $landlord)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $landlord->user_id,
            'last_name' => 'required',
            'phone' => 'required',
        ]);

        $landlord =  Landlord::findOrFail($landlord->id);

        $landlord->first_name = $request->first_name;
        $landlord->address = $request->address;
        $landlord->last_name = $request->last_name;
        $landlord->email = $request->email;
        $landlord->phone = $request->phone;
        $landlord->save();

        $flash = array('type' => 'success', 'msg' => 'Landlord updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.landlords.index');
    }

    public function destroy(Landlord $landlord)
    {
        $landlord = Landlord::findOrFail($landlord->id);
        $landlord->delete();

        // Toastr::success('message', 'Landlord deleted successfully.');
        return back();
    }
    public function show($landlord)
    {
        $landlord = Landlord::whereId($landlord)->first()->toArray();

        // Toastr::success('message', 'Landlord deleted successfully.');
        return $landlord;
    }
    public function landlordDashboard()
    {
        $data = [];
        $data['propertycount'] = landlordProperty::count();
        $data['paid_rent']     = landlordRent::where('payment_status', 1)->sum('rent_amount');
        $data['income']  = landlordIncome::sum('amount');
        $data['expense']     = landlordExpense::sum('amount');

        $data['properties']    = landlordProperty::latest()->with('Property')->take(5)->get();
        $data['posts']         = Post::latest()->withCount('comments')->take(5)->get();
        $data['users']         = User::with('role')->latest()->take(5)->get();
        $data['comments']      = Comment::with('users')->take(5)->get();

        return view('admin.reports.landlord-dashboard')->with($data);
    }
}