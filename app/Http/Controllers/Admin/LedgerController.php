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
}
