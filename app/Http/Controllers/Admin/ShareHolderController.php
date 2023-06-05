<?php

namespace App\Http\Controllers\Admin;

use App\ShareHolder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShareHolderController extends Controller
{

    public function index()
    {
        $share_holder = ShareHolder::latest()->get();

        return view('admin.share-holder.index', compact('share_holder'));
    }
    public function list()
    {
        $data = array();
        $data['share_holder'] = ShareHolder::all()->toArray();
        // return $data;
        return view('admin.share-holder.list')->with($data);
    }

    public function create()
    {
        return view('admin.share-holder.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
        ]);

        $share_holder = new ShareHolder();
        $share_holder->address = $request->address;
        $share_holder->first_name = $request->first_name;
        $share_holder->last_name = $request->last_name;
        $share_holder->email = $request->email;
        $share_holder->phone = $request->phone;
        $share_holder->save();
        $flash = array('type' => 'success', 'msg' => 'Share Holder created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.share-holder.index');
    }

    public function edit(ShareHolder $share_holder)
    {
        $share_holder = ShareHolder::findOrFail($share_holder->id);

        return view('admin.share-holder.edit', compact('share_holder'));
    }

    public function update(Request $request, ShareHolder $share_holder)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $share_holder->user_id,
            'phone' => 'required',
        ]);

        $share_holder =  ShareHolder::findOrFail($share_holder->id);

        $share_holder->first_name = $request->first_name;
        $share_holder->address = $request->address;
        $share_holder->last_name = $request->last_name;
        $share_holder->email = $request->email;
        $share_holder->phone = $request->phone;
        $share_holder->status = isset($request->status) ? 1 : 0;
        $share_holder->save();

        $flash = array('type' => 'success', 'msg' => 'Share Holder updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.share-holder.index');
    }

    public function destroy(ShareHolder $share_holder)
    {
        $share_holder = ShareHolder::findOrFail($share_holder->id);
        $share_holder->delete();
        return back();
    }
}
