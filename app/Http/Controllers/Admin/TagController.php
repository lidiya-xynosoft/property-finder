<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Toastr;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->get();

        return view('admin.tags.index', compact('tags'));
    }


    public function create()
    {
        return view('admin.tags.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255'
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->type = $request->type;
        $tag->slug = str_slug($request->name);
        $tag->save();
        $flash = array('type' => 'success', 'msg' => 'Tag created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.tags.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|max:255',
            'type' => 'required'
        ]);

        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->type = $request->type;
        $tag->slug = str_slug($request->name);
        $tag->save();

        $flash = array('type' => 'success', 'msg' => 'Tag updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.tags.index');
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag->type == 'property') {
            $flash = array('type' => 'error', 'msg' => 'This action not allowed.');
            session()->flash('flash', $flash);
            return redirect()->route('admin.tags.index');
        }
        $tag->delete();
        $tag->posts()->detach();

        return back();
    }
}