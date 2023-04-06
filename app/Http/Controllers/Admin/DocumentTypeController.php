<?php

namespace App\Http\Controllers\Admin;

use App\DocumentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentTypeController extends Controller
{

    public function index()
    {
        $document_types = DocumentType::latest()->get();

        return view('admin.document-type.index', compact('document_types'));
    }


    public function create()
    {
        return view('admin.document-type.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:document_types|max:255',
            'type' => 'required'
        ]);

        $document_type = new DocumentType();
        $document_type->title = $request->title;
        $document_type->type = $request->type;
        $document_type->description = 'o';
        $document_type->save();
        $flash = array('type' => 'success', 'msg' => 'DocumentType created successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.document-type.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $document_type = DocumentType::find($id);

        return view('admin.document-type.edit', compact('document_type'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required',
        ]);

        $document_type = DocumentType::find($id);
        $document_type->title = $request->title;
        $document_type->type = $request->type;
        $document_type->description = 'p';
        $document_type->save();

        $flash = array('type' => 'success', 'msg' => 'DocumentType updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.document-type.index');
    }


    public function destroy($id)
    {
        $document_type = DocumentType::find($id);
        if ($document_type->type == '0') {
            $flash = array('type' => 'error', 'msg' => 'This action not allowed.');
            session()->flash('flash', $flash);
            return redirect()->route('admin.document-type.index');
        }
        $document_type->delete();

        return back();
    }
}
