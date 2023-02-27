<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Type;
use Toastr;

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::latest()->get();

        return view('admin.types.index', compact('types'));
    }


    public function create()
    {
        return view('admin.types.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:types|max:255'
        ]);

        $tag = new Type();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();

        // Toastr::success('message', 'Type created successfully.');
        return redirect()->route('admin.types.index');
    }


    public function edit($id)
    {
        $types = Type::find($id);

        return view('admin.types.edit', compact('types'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $type = Type::find($id);
        $type->name = $request->name;
        $type->slug = str_slug($request->name);
        $type->save();

        // Toastr::success('message', 'Type updated successfully.');
        return redirect()->route('admin.types.index');
    }


    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();
        // Toastr::success('message', 'Type deleted successfully.');
        return back();
    }
}
