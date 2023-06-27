<?php

namespace App\Http\Controllers\Admin;

use App\daybook;
use App\DividendRule;
use App\Http\Controllers\Controller;
use App\landlordExpense;
use App\landlordIncome;
use App\landlordPropertyContract;
use App\landlordRent;
use App\Ledger;
use App\Property;
use App\PropertyAgreement;
use App\PropertyCustomer;
use App\PropertyExpense;
use App\PropertyIncome;
use App\PropertyRent;
use App\ShareHolderAccount;
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
            'amount' => 'required',
            'property_agreement_id' => 'required',
            'ledger_id' => 'required',
            'payment_type_id' => 'required',
        ]);
        $parent_property_id = Property::find($request['property_id'])->is_parent_property;
        $landlord_contract_id = landlordPropertyContract::where(['property_id' => $parent_property_id, 'is_withdraw' => 0, 'is_published' => 1])->first()->id;
        $share_holders_count = DividendRule::where([
            'property_id' =>  $parent_property_id,
            'status' => 1,
            'landlord_property_contract_id' => $landlord_contract_id
        ])->count();

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
            $data = landlordExpense::create(
                [
                    'property_id' => $parent_property_id,
                    'ledger_id' => $request['ledger_id'],
                    'landlord_id' => landlordPropertyContract::where(['property_id' => $parent_property_id, 'is_withdraw' => 0, 'is_published' => 1])->first()->landlord_id,
                    'landlord_property_contract_id' => landlordPropertyContract::where(['property_id' => $parent_property_id, 'is_withdraw' => 0, 'is_published' => 1])->first()->id,
                    'expense_date' => $request['date'],
                    'date' => Carbon::now()->toDateString(),
                    'name' => $request['name'],
                    'amount' => $request['amount'],
                    'reference' => $request['reference'],
                    'payment_type_id' => $request['payment_type_id'],
                    'description' => $request['description'],
                    'status' => 1,
                ],
            );

            if ($share_holders_count > 0) {
                $share_hoders_details = DividendRule::where([
                    'property_id' => $parent_property_id,
                    'status' => 1,
                    'landlord_property_contract_id' => $landlord_contract_id
                ])->get();

                foreach ($share_hoders_details as $details) {
                    ShareHolderAccount::create(
                        [
                            'parent_property_id' => $parent_property_id,
                            'property_id' => $request['property_id'],
                            'ledger_id' => $request['ledger_id'],
                            'share_holder_id' => $details->share_holder_id,
                            'landlord_property_contract_id' =>  $landlord_contract_id,
                            'reference' => 1,
                            'applied_percentage' => $details->percentage,
                            'applied_amount' => ($request['amount'] * $details->percentage) / 100,
                            'debit' => ($request['amount'] * $details->percentage) / 100,
                            'date' => Carbon::now()->toDateString(),
                            'reference_amount' => ($request['amount'] * $details->percentage) / 100,
                            'ledger_amount' => $request['amount'],
                            'status' => 1,
                            'property_agreement_id' => $request['property_agreement_id'],
                        ],
                    );
                }
            }
            daybook::create([
                'property_id' => $request['property_id'],
                'property_agreement_id' => $request['property_agreement_id'],
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
                    'ledger_id' => $request['ledger_id'],
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

            if ($share_holders_count > 0) {
                $share_hoders_details = DividendRule::where([
                    'property_id' => $parent_property_id,
                    'status' => 1,
                    'landlord_property_contract_id' =>  $landlord_contract_id
                ])->get();

                foreach ($share_hoders_details as $details) {
                    ShareHolderAccount::create(
                        [
                            'parent_property_id' => $parent_property_id,
                            'property_id' => $request['property_id'],
                            'ledger_id' => $request['ledger_id'],
                            'share_holder_id' => $details->share_holder_id,
                            'landlord_property_contract_id' =>  $landlord_contract_id,
                            'reference' => 0,
                            'applied_percentage' => $details->percentage,
                            'applied_amount' => ($request['amount'] * $details->percentage) / 100,
                            'credit' => ($request['amount'] * $details->percentage) / 100,
                            'date' => Carbon::now()->toDateString(),
                            'reference_amount' => ($request['amount'] * $details->percentage) / 100,
                            'ledger_amount' => $request['amount'],
                            'status' => 1,
                            'property_agreement_id' => $request['property_agreement_id'],
                        ],
                    );
                }
            }
            daybook::create([
                'property_id' => $request['property_id'],
                'property_agreement_id' => $request['property_agreement_id'],
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
    public function saveUpdatelandlordExpense(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric',
            'landlord_contract_id' => 'required',
            'ledger_id' => 'required',
            'payment_type_id' => 'required',
        ]);
        $share_holders_count = DividendRule::where([
            'property_id' => $request['property_id'],
            'status' => 1,
            'landlord_property_contract_id' => $request['landlord_contract_id']
        ])->count();
        if ($request['mode_of_bill_payment'] == 'expense_type') {
            $data = landlordExpense::create(
                [
                    'property_id' => $request['property_id'],
                    'ledger_id' => $request['ledger_id'],
                    'landlord_id' => landlordPropertyContract::find($request['landlord_contract_id'])->landlord_id,
                    'landlord_property_contract_id' => $request['landlord_contract_id'],
                    'expense_date' => $request['date'],
                    'date' => Carbon::now()->toDateString(),
                    'name' => $request['name'],
                    'amount' => $request['amount'],
                    'reference' => $request['reference'],
                    'payment_type_id' => $request['payment_type_id'],
                    'description' => $request['description'],
                    'status' => 1,
                ],
            );
            $no_of_units =  Property::where('is_parent_property', $request['property_id'])->count();
            $no_of_rent_share = $request['amount'] /   $no_of_units;

            $unit_IDs = Property::where('is_parent_property', $request['property_id'])->pluck('id');

            if ($share_holders_count > 0) {
                $share_hoders_details = DividendRule::where([
                    'property_id' => $request['property_id'],
                    'status' => 1,
                    'landlord_property_contract_id' => $request['landlord_contract_id']
                ])->get();

                foreach ($share_hoders_details as $details) {
                    ShareHolderAccount::create(
                        [
                            'property_id' => $request['property_id'], 'ledger_id' => $request['ledger_id'],
                            'share_holder_id' => $details->share_holder_id,
                            'landlord_property_contract_id' => $request['landlord_contract_id'],
                            'reference' => 1,
                            'applied_percentage' => $details->percentage,
                            'applied_amount' => ($request['amount'] * $details->percentage) / 100,
                            'debit' => ($request['amount'] * $details->percentage) / 100,
                            'date' => Carbon::now()->toDateString(),
                            'reference_amount' => ($request['amount'] * $details->percentage) / 100,
                            'ledger_amount' => $request['amount'],
                            'status' => 1,
                        ],
                    );
                }
            }

            if (count($unit_IDs) > 0) {
                foreach ($unit_IDs as $id) {
                    if (PropertyAgreement::where('property_id', $id)->first()) {
                        PropertyExpense::create(
                            [
                                'property_id' => $id,
                                'ledger_id' => $request['ledger_id'],
                                'property_agreement_id' => PropertyAgreement::where('property_id', $id)->first()->id,
                                'expense_date' => $request['date'],
                                'date' => Carbon::now()->toDateString(),
                                'name' => 'Property Rent share',
                                'user_id' => Auth::User()->id,
                                'amount' => $no_of_rent_share,
                                'reference' => 'Split rent amount',
                                'payment_type_id' => $request['payment_type_id'],
                                'description' => $request['description'],
                                'status' => 0,
                            ],
                        );
                    }
                }
            }
            // daybook::create([
            //     'property_id' => $request['property_id'],
            //     'landlord_property_contract_id' => $request['landlord_property_contract_id'],
            //     'user_id' => Auth::user()->id,
            //     'date' => Carbon::now()->toDateString(),
            //     'time' => Carbon::now()->format('H:i:s'),
            //     'title' => Property::find($request['property_id'])->product_code,
            //     'head' =>  Ledger::find($request['ledger_id'])->title,
            //     'debit' => $request['amount'],
            // ]);
        } else if ($request['mode_of_bill_payment'] == 'income_type') {
            $data = landlordIncome::create(
                [
                    'property_id' => $request['property_id'],
                    'landlord_property_contract_id' => $request['landlord_contract_id'],
                    'landlord_id' => landlordPropertyContract::find($request['landlord_contract_id'])->landlord_id,
                    'ledger_id' => $request['ledger_id'],
                    'income_date' => $request['date'],
                    'date' => Carbon::now()->toDateString(),
                    'name' => $request['name'],
                    'amount' => $request['amount'],
                    'reference' => $request['reference'],
                    'payment_type_id' => $request['payment_type_id'],
                    'description' => $request['description'],
                    'status' => 1,
                ],
            );
            if ($share_holders_count > 0) {
                $share_hoders_details = DividendRule::where([
                    'property_id' => $request['property_id'],
                    'status' => 1,
                    'landlord_property_contract_id' => $request['landlord_contract_id']
                ])->get();

                foreach ($share_hoders_details as $details) {
                    ShareHolderAccount::create(
                        [
                            'property_id' => $request['property_id'], 'ledger_id' => $request['ledger_id'],
                            'share_holder_id' => $details->share_holder_id,
                            'landlord_property_contract_id' => $request['landlord_contract_id'],
                            'reference' => 0,
                            'applied_percentage' => $details->percentage,
                            'applied_amount' => ($request['amount'] * $details->percentage) / 100,
                            'credit' => ($request['amount'] * $details->percentage) / 100,
                            'date' => Carbon::now()->toDateString(),
                            'reference_amount' => ($request['amount'] * $details->percentage) / 100,
                            'ledger_amount' => $request['amount'],
                            'status' => 1,
                        ],
                    );
                }
            }
            // daybook::create([
            //     'property_id' => $request['property_id'],
            //     'landlord_property_contract_id' => $request['landlord_contract_id'],
            //     'user_id' => Auth::user()->id,
            //     'date' => Carbon::now()->toDateString(),
            //     'time' => Carbon::now()->format('H:i:s'),
            //     'title' => Property::find($request['property_id'])->product_code,
            //     'head' =>   $request['name'],
            //     'credit' => $request['amount'],
            // ]);
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
                    'ledger_id' => $request['ledger_id'],
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
            daybook::create([
                'property_id' => $expense_rent->property_id,
                'property_agreement_id' => $request['property_agreement_id'],
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->format('H:i:s'),
                'title' => Property::find($expense_rent->property_id)->product_code,
                'head' => 'Monthly Rent',
                'credit' => $request['amount'],
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
    public function landlordRentPayment(Request $request)
    {
        $request->validate([
            'landlord_contract_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'ledger_id' => 'required',
            'name' => 'required',
            'payment_type_id' => 'required',
        ]);
        $id = $request['rent_id'];
        $expense_rent = landlordRent::findOrFail($id);
        if ($expense_rent) {
            landlordRent::whereId($id)->update([
                'payment_date' => Carbon::now()->toDateString(),
                'landlord_property_contract_id' => $request['landlord_contract_id'],
                'payment_time' => Carbon::now()->format('H:i:s'),
                'payment_status' => 1
            ]);
            $data = landlordIncome::create(
                [
                    'property_id' => $request['property_id'],
                    'landlord_property_contract_id' => $request['landlord_contract_id'],
                    'landlord_id' => landlordPropertyContract::find($request['landlord_contract_id'])->landlord_id,
                    'ledger_id' => $request['ledger_id'],
                    'income_date' => $request['date'],
                    'date' => Carbon::now()->toDateString(),
                    'name' => $request['name'],
                    'amount' => $request['amount'],
                    'reference' => $request['reference'],
                    'payment_type_id' => $request['payment_type_id'],
                    'description' => $request['description'],
                    'status' => 1,
                ],
            );
            daybook::create([
                'property_id' => $expense_rent->property_id,
                'landlord_property_contract_id' => $request['landlord_contract_id'],
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->format('H:i:s'),
                'title' => Property::find($expense_rent->property_id)->product_code,
                'head' => 'Landlord Rent Payment',
                'debit' => $request['amount'],
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

    public function updateExpense($id)
    {
        $expense_data = PropertyExpense::whereId($id)->first();
        $data = PropertyExpense::whereId($id)->update([
            'status' => 1,
        ]);
        daybook::create([
            'property_id' => $expense_data->property_id,
            'property_agreement_id' => $expense_data->property_agreement_id,
            'user_id' => Auth::user()->id,
            'date' => Carbon::now()->toDateString(),
            'time' => Carbon::now()->format('H:i:s'),
            'title' => Property::find($expense_data->property_id)->product_code,
            'head' =>  Ledger::find($expense_data->ledger_id)->title,
            'debit' =>  $expense_data->amount,
        ]);
        $parent_property_id = Property::find($expense_data->property_id)->is_parent_property;
        landlordIncome::create(
            [
                'property_id' => $parent_property_id,
                'landlord_id' => landlordPropertyContract::where(['property_id' => $parent_property_id, 'is_withdraw' => 0, 'is_published' => 1])->first()->landlord_id,
                'landlord_property_contract_id' => landlordPropertyContract::where(['property_id' => $parent_property_id, 'is_withdraw' => 0, 'is_published' => 1])->first()->id,
                'ledger_id' =>  $expense_data->ledger_id,
                'income_date' =>  $expense_data->expense_date,
                'date' => Carbon::now()->toDateString(),
                'name' =>  $expense_data->name,
                'amount' =>  $expense_data->amount,
                'reference' =>  $expense_data->reference,
                'payment_type_id' =>  $expense_data->payment_type_id,
                'description' =>  $expense_data->description,
                'status' => 1,
            ],
        );
        $flash = array('type' => 'success', 'msg' => 'added successfully.');
        session()->flash('flash', $flash);
        return back();
    }
}