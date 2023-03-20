<?php

namespace App\Http\Controllers\Admin;

use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Ledger;
use App\Property;
use App\PropertyAgreement;
use App\PropertyCustomer;
use App\PropertyExpense;
use App\PropertyRent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseManageController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $premises = DB::table('premises')->get();
        $data['premises'] = $premises;
        if ($request->has('update_id')) {
            $update_id = $request->get('update_id');
            // $update_id = decript($encrypt_update_id);
            if (!$update_id) {
                $flash = array('type' => 'error', 'msg' => 'Invalid Request');
                $request->session()->flash('flash', $flash);
                return redirect()->back();
            } else {
                $update_data = DB::table('property_agreement')->where('id', '=', $update_id)->first();
                $data['update_data'] = $update_data;
                $data['update_id'] = $update_id;
            }
        }

        return view('admin.agreement.create-agreement')->with($data);
    }

    public function saveUpdateExpense(Request $request)
    {
        $request->validate([
            'expenses' => 'required',
            'property_id' => 'required',
        ]);

        if (isset($request['update_id'])) {
            $property = PropertyAgreement::findOrFail($request['update_id']);
            $property_agreement_data = PropertyAgreement::find($request['update_id']);
            $customer_id = $property_agreement_data->customer_id;
        } else {
            // $property_expense = new PropertyExpense();
            if ($request['expenses']) {
                foreach ($request['expenses'] as $expense_data) {
                    $data =   PropertyExpense::create([
                        'property_id' => $request['property_id'],
                        'expense_category_id' => $expense_data['expense_category_id'],
                        'amount' => $expense_data['expense_amount'],
                    ]);
                    Ledger::create([
                        'property_id' => $request['property_id'],
                        'user_id' => Auth::user()->id,
                        'date' => Carbon::now()->toDateString(),
                        'time' => Carbon::now()->format('H:i:s'),
                        'title' => Property::find($request['property_id'])->product_code,
                        'head' => ExpenseCategory::find($expense_data['expense_category_id'])->title,
                        'debit' => $expense_data['expense_amount'],
                        // 'total'
                    ]);
                }
            }
            return $data;
        }

        $flash = array('type' => 'success', 'msg' => 'Agreement created successfully.');
        $request->session()->flash('flash', $flash);
        $agreement = PropertyAgreement::where('id', $property->id)
            ->where('is_draft', true)
            ->where('is_published', false)
            ->first();
        $property = Property::find($request->input('property_id'));
        if (isset($request['update_id'])) {
            $flash = array('type' => 'success', 'msg' => 'agreement Updated successfully.');
        } else {
            $flash = array('type' => 'success', 'msg' => 'agreement created successfully.');
        }
        session()->flash('flash', $flash);
        return view('admin.agreement.preview-agreement', compact('agreement', 'property'));
    }

    public function destroy($id)
    {   //For Deleting PropertyExpense
        $expense_category = PropertyExpense::findOrFail($id);
        if ($expense_category) {
            $expense_category->delete();
            return response()->json([
                'success' => '1'
            ]);
        } else {
            return response()->json([
                'success' => '0'
            ]);
        }
    }
    public function rentPayment($id)
    {   //For Deleting PropertyExpense
        $expense_rent = PropertyRent::findOrFail($id);
        if ($expense_rent) {
            PropertyRent::whereId($id)->update([
                'payment_date' => Carbon::now()->toDateString(),
                'payment_time' => Carbon::now()->format('H:i:s'),
                'payment_status' => 1
            ]);
            Ledger::create([
                'property_id' => $expense_rent->property_id,
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->format('H:i:s'),
                'title' => Property::find($expense_rent->property_id)->product_code,
                'head' => 'Monthly Rent',
                'credit' => $expense_rent->rent_amount,
                // 'total'
            ]);
        } else {
            return response()->json([
                'success' => '0'
            ]);
        }
        return response()->json([
            'success' => '1'
        ]);
    }
}
