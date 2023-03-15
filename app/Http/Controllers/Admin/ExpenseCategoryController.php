<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ExpenseCategoryController extends Controller
{

    public function index()
    {
        $expense_categorys = ExpenseCategory::latest()->get();

        return view('admin.expense_category.index', compact('expense_categorys'));
    }

    public function create()
    {
        return view('admin.expense_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:200',
            'type' => 'required',
        ]);

        $expense_category = new ExpenseCategory();
        $expense_category->title = $request->title;
        $expense_category->description = $request->description;
        $expense_category->type = $request->type;
        $expense_category->save();
        $flash = array('type' => 'success', 'msg' => 'ExpenseCategory created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'ExpenseCategory created successfully.');
        return redirect()->route('admin.expense_category.index');
    }

    public function edit(ExpenseCategory $expense_category)
    {
        $expense_category = ExpenseCategory::findOrFail($expense_category->id);

        return view('admin.expense_category.edit', compact('expense_category'));
    }

    public function update(Request $request, ExpenseCategory $expense_category)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:200',
            'type' => 'required',
        ]);

        $expense_category = ExpenseCategory::find($expense_category->id);


        $expense_category = ExpenseCategory::findOrFail($expense_category->id);
        $expense_category->title = $request->title;
        $expense_category->description = $request->description;
        $expense_category->type = $request->type;
        $expense_category->save();

        $flash = array('type' => 'success', 'msg' => 'ExpenseCategory updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.expense_category.index');
    }

    public function destroy(ExpenseCategory $expense_category)
    {
        $expense_category = ExpenseCategory::findOrFail($expense_category->id);
        $expense_category->delete();

        // Toastr::success('message', 'ExpenseCategory deleted successfully.');
        return back();
    }
}