<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purpose;
use Toastr;

class PurposeController extends Controller
{

    public function index()
    {
        $purposes = Purpose::latest()->get();

        return view('admin.purposes.index', compact('purposes'));
    }


    public function create()
    {
        return view('admin.purposes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:purposes|max:255'
        ]);

        $tag = new Purpose();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();

        // Toastr::success('message', 'Purpose created successfully.');
        return redirect()->route('admin.purposes.index');
    }


    public function edit($id)
    {
        $Purpose = Purpose::find($id);

        return view('admin.purposes.edit', compact('Purpose'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $Purpose = Purpose::find($id);
        $Purpose->name = $request->name;
        $Purpose->slug = str_slug($request->name);
        $Purpose->save();

        // Toastr::success('message', 'Purpose updated successfully.');
        return redirect()->route('admin.purposes.index');
    }


    public function destroy($id)
    {
        $purpose = Purpose::find($id);
        $purpose->delete();
        // Toastr::success('message', 'Purpose deleted successfully.');
        return back();
    }
}
