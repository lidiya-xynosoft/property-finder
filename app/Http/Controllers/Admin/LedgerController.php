<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ledger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LedgerController extends Controller
{

    public function index()
    {
        $ledger = Ledger::latest()->get();

        return view('admin.ledger.index', compact('ledger'));
    }

    public function create()
    {
        return view('admin.ledger.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $ledger = new Ledger();
        $ledger->title = $request->title;
        $ledger->description = $request->description;
        $ledger->type = $request->type;
        $ledger->save();
        $flash = array('type' => 'success', 'msg' => 'Ledger created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'Ledger created successfully.');
        return redirect()->route('admin.ledger.index');
    }

    public function edit(Ledger $ledger)
    {
        $ledger = Ledger::findOrFail($ledger->id);

        return view('admin.ledger.edit', compact('ledger'));
    }

    public function update(Request $request, Ledger $ledger)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $ledger = Ledger::find($ledger->id);


        $ledger = Ledger::findOrFail($ledger->id);
        $ledger->title = $request->title;
        $ledger->description = $request->description;
        $ledger->type = $request->type;
        $ledger->save();

        $flash = array('type' => 'success', 'msg' => 'Ledger updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.ledger.index');
    }

    public function destroy(Ledger $ledger)
    {
        $ledger = Ledger::findOrFail($ledger->id);
        $ledger->delete();

        // Toastr::success('message', 'Ledger deleted successfully.');
        return back();
    }
}