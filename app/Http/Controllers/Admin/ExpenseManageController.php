<?php

namespace App\Http\Controllers\Admin;

use App\daybook;
use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Ledger;
use App\Property;
use App\PropertyAgreement;
use App\PropertyCustomer;
use App\PropertyExpense;
use App\PropertyIncome;
use App\PropertyRent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseManageController extends Controller
{
    
    public function saveUpdateExpense(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required'
        ]);
        if ($request['mode_of_bill_payment'] == 'expense_type') {
            $data = PropertyExpense::create(
                [
                    'property_id' => $request['property_id'],
                    'ledger_id' => $request['ledger_id'],
                    'property_agreement_id' => $request['property_agreement_id'],
                    'expense_date' => $request['date'],
                    'date' => Carbon::now()->toDateString(),
                    'name' => $request['name'],
                    'user_id' => Auth::User()->id,
                    'amount' => $request['amount'],
                    'reference' => $request['reference'],
                    'payment_type_id' => $request['payment_type_id'],
                    'description' => $request['description'],
                    'status' => 1,
                ],
            );
            daybook::create([
                'property_id' => $request['property_id'],
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->format('H:i:s'),
                'title' => Property::find($request['property_id'])->product_code,
                'head' =>  Ledger::find($request['ledger_id'])->title,
                'debit' => $request['amount'],
            ]);
        } else if ($request['mode_of_bill_payment'] == 'income_type') {
            $data = PropertyIncome::create(
                [
                    'property_id' => $request['property_id'],
                    'income_date' => $request['date'],
                    'property_agreement_id' => $request['property_agreement_id'],
                    'date' => Carbon::now()->toDateString(),
                    'name' => $request['name'],
                    'user_id' => Auth::User()->id,
                    'amount' => $request['amount'],
                    'reference' => $request['reference'],
                    'payment_type_id' => $request['payment_type_id'],
                    'description' => $request['description'],
                    'status' => 1,
                ],
            );
            daybook::create([
                'property_id' => $request['property_id'],
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->format('H:i:s'),
                'title' => Property::find($request['property_id'])->product_code,
                'head' =>   $request['name'],
                'credit' => $request['amount'],
            ]);
        }
        $flash = array('type' => 'success', 'msg' => 'added successfully.');
        session()->flash('flash', $flash);
        return $data;
    }

    public function destroy($id)
    {   //For Deleting PropertyExpense
        $ledger = PropertyExpense::findOrFail($id);
        if ($ledger) {
            $ledger->delete();
            return response()->json([
                'success' => '1'
            ]);
        } else {
            return response()->json([
                'success' => '0'
            ]);
        }
    }
    public function rentPayment(Request $request)
    {
        $id = $request['rent_id'];
        $expense_rent = PropertyRent::findOrFail($id);
        if ($expense_rent) {
            PropertyRent::whereId($id)->update([
                'payment_date' => Carbon::now()->toDateString(),
                'property_agreement_id' => $request['property_agreement_id'],
                'payment_time' => Carbon::now()->format('H:i:s'),
                'payment_status' => 1
            ]);
            $data = PropertyIncome::create(
                [
                    'property_id' => $request['property_id'],
                    'property_agreement_id' => $request['property_agreement_id'],
                    'income_date' => $request['date'],
                    'date' => Carbon::now()->toDateString(),
                    'name' => $request['name'],
                    'user_id' => Auth::User()->id,
                    'amount' => $request['amount'],
                    'reference' => $request['reference'],
                    'payment_type_id' => $request['payment_type_id'],
                    'description' => $request['description'],
                    'status' => 1,
                ],
            );
            Ledger::create([
                'property_id' => $expense_rent->property_id,
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->format('H:i:s'),
                'title' => Property::find($expense_rent->property_id)->product_code,
                'head' => 'Monthly Rent',
                'credit' => $request['amount'],
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