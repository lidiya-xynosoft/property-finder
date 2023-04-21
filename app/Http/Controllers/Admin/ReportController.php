<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\City;
use App\Country;
use App\LandloardExpense;
use App\LandloardIncome;
use App\Ledger;
use App\Property;
use App\PropertyAgreement;
use App\PropertyComplaint;
use App\PropertyExpense;
use App\PropertyIncome;
use App\ServiceList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ReportController extends Controller
{

    public function index()
    {
        $cities = City::latest()->get();

        return view('admin.reports.index', compact('cities'));
    }
    public function propertyIncomeReport(Request $request)
    {
        $data = [];
        $incomes = [];
        $complaint_lists = [];
        $where_arry = [];

        // if (!$request['ledger_id'] && !$request['property_id']) {
        //     $flash = array('type' => 'error', 'msg' => 'Choose any data for search');
        //     session()->flash('flash', $flash);
        //     return redirect()->back();
        // }
        if (isset($request['ledger_id'])) {
            if ($request['ledger_id']) {
                $where_arry['ledger_id'] = $request['ledger_id'];
            }
        }
        if (isset($request['property_id'])) {
            if ($request['property_id'] != 0) {
                $where_arry['property_id'] = $request['property_id'];
            }
        }

        if (count(LandloardIncome::all()) > 0) {
            $data['incomes'] = LandloardIncome::with([
                'Ledger',
                'Property' => function ($query) {
                    $query->select('id', 'title', 'product_code')->get();
                },
                'Property.PropertyCustomer' => function ($query) {
                    $query->where(['status' => 1, 'is_withdraw' => 0])->get();
                },
                'Property.PropertyCustomer.Customer' => function ($query) {
                    $query->select('first_name', 'last_name', 'id', 'email', 'phone')->get();
                },

            ])->where($where_arry)->latest()->get()->toArray();
        }

        $data['properties'] = Property::all();
        $data['ledger'] = Ledger::all();
        $data['total_income'] =
        LandloardIncome::sum('amount');
        return view('admin.reports.property-income-report')->with($data);
    }

    public function propertyExpenseReport(Request $request)
    {
        $data = [];
        $incomes = [];
        $complaint_lists = [];
        $where_arry = [];

        if (isset($request['ledger_id'])) {
            if ($request['ledger_id']) {
                $where_arry['ledger_id'] = $request['ledger_id'];
            }
        }
        if (isset($request['property_id'])) {
            if ($request['property_id'] != 0) {
                $where_arry['property_id'] = $request['property_id'];
            }
        }

        if (count(LandloardExpense::all()) > 0) {
            $data['expenses'] = LandloardExpense::with([
                'Ledger',
                'Property' => function ($query) {
                    $query->select('id', 'title', 'product_code')->get();
                },
                'Property.PropertyCustomer' => function ($query) {
                    $query->where(['status' => 1, 'is_withdraw' => 0])->get();
                },
                'Property.PropertyCustomer.Customer' => function ($query) {
                    $query->select('first_name', 'last_name', 'id', 'email', 'phone')->get();
                },

            ])->where($where_arry)->latest()->get()->toArray();
        }
        $data['properties'] = Property::all();
        $data['total_expense'] =
        LandloardExpense::sum('amount');
        $data['ledger'] = Ledger::all();
        return view('admin.reports.property-expense-report')->with($data);
    }

    public function agreementIncomeReport(Request $request)
    {
        $data = [];
        $incomes = [];
        $complaint_lists = [];
        $where_arry = [];
        // if (!$request['ledger_id'] && !$request['property_id']) {
        //     $flash = array('type' => 'error', 'msg' => 'Choose any data for search');
        //     session()->flash('flash', $flash);
        //     return redirect()->back();
        // }
        if (isset($request['ledger_id'])) {
            if ($request['ledger_id']) {
                $where_arry['ledger_id'] = $request['ledger_id'];
            }
        }
        if (isset($request['property_id'])) {
            if ($request['property_id'] != 0) {
                $where_arry['property_id'] = $request['property_id'];
            }
        }

        if (count(PropertyIncome::all()) > 0) {
            $data['incomes'] = PropertyIncome::with([
                'Ledger',
                'Property' => function ($query) {
                    $query->select('id', 'title', 'product_code')->get();
                },
                'Property.PropertyCustomer' => function ($query) {
                    $query->where(['status' => 1, 'is_withdraw' => 0])->get();
                },
                'Property.PropertyCustomer.Customer' => function ($query) {
                    $query->select('first_name', 'last_name', 'id', 'email', 'phone')->get();
                },

            ])->where($where_arry)->latest()->get()->toArray();
        }

        $data['properties'] = Property::all();
        $data['agreements'] = PropertyAgreement::where('customer_id', '!=', null)->get();
        $data['ledger'] = Ledger::all();
        return view('admin.reports.agreement-income-report')->with($data);
    }
}