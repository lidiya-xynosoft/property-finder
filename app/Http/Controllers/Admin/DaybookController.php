<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\daybook;


class DaybookController extends Controller
{

    public function index()
    {
        $daybook = daybook::latest()->get();

        return view('admin.daybook.index', compact('daybook'));
    }
}
