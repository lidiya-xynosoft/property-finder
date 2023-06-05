<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\City;
use App\Country;
use App\Customer;
use App\landlordExpense;
use App\landlordIncome;
use App\Ledger;
use App\Property;
use App\PropertyAgreement;
use App\PropertyComplaint;
use App\PropertyExpense;
use App\PropertyIncome;
use App\ServiceList;
use App\ShareHolder;
use App\ShareHolderAccount;
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
        $data['incomes'] = [];

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
        if (isset($request['start_date']) &&  isset($request['end_date'])) {
            $from = date($request['start_date']);
            $to = date('Y-m-d', strtotime($request['end_date']));
        } else {
            $mytime = Carbon::now();
            $from = date('Y-m-d', strtotime($mytime->subMonth()));
            $to = date('Y-m-d');
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

            ])->where($where_arry)->whereBetween('date', [$from, $to])->latest()->get()->toArray();
        }

        $data['properties'] = Property::all();
        $data['ledger'] = Ledger::all();
        $data['total_income'] =
        PropertyIncome::whereBetween('date', [$from, $to])->sum('amount');
        return view('admin.reports.property-income-report')->with($data);
    }

    public function propertyExpenseReport(Request $request)
    {
        $data = [];
        $incomes = [];
        $complaint_lists = [];
        $where_arry = [];
        $data['expenses'] = [];
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
        if (isset($request['start_date']) &&  isset($request['end_date'])) {
            $from = date($request['start_date']);
            $to = date('Y-m-d', strtotime($request['end_date']));
        } else {
            $mytime = Carbon::now();
            $from = date('Y-m-d', strtotime($mytime->subMonth()));
            $to = date('Y-m-d');
        }

        if (count(PropertyExpense::all()) > 0) {
            $data['expenses'] = PropertyExpense::with([
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

            ])->where($where_arry)->whereBetween('date', [$from, $to])
                ->latest()->get()->toArray();
        }
        $data['properties'] = Property::all();
        $data['total_expense'] =
        PropertyExpense::whereBetween('date', [$from, $to])->sum('amount');
        $data['ledger'] = Ledger::all();
        return view('admin.reports.property-expense-report')->with($data);
    }

    public function agreementIncomeReport(Request $request)
    {
        $data = [];
        $incomes = [];
        $complaint_lists = [];
        $where_arry = [];
        $data['incomes'] = [];
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
        if (isset($request['agreement_id'])) {
            if ($request['agreement_id'] != 0) {
                $where_arry['property_agreement_id'] = $request['agreement_id'];
            }
        }

        if (isset($request['start_date']) &&  isset($request['end_date'])) {
            $from = date($request['start_date']);
            $to = date('Y-m-d', strtotime($request['end_date']));
        } else {
            $mytime = Carbon::now();
            $from = date('Y-m-d', strtotime($mytime->subMonth()));
            $to = date('Y-m-d');
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

            ])->where($where_arry)->whereBetween('date', [$from, $to])->latest()->get()->toArray();
        }

        $data['properties'] = Property::all();
        $data['agreements'] = PropertyAgreement::with('Property')->where('customer_id', '!=', null)->get();
        $data['ledger'] = Ledger::all();
        return view('admin.reports.agreement-income-report')->with($data);
    }

    public function tenantServiceReport(Request $request)
    {
        $data = [];
        $where_arry = [];
        $data['complaints'] = [];
        if (isset($request['customer_id'])) {
            if ($request['customer_id']) {
                $where_arry['customer_id'] = $request['customer_id'];
            }


            if (isset($request['start_date']) &&  isset($request['end_date'])) {
                $from = date($request['start_date']);
                $to = date('Y-m-d', strtotime($request['end_date']));
            }

            if (count(PropertyComplaint::where($where_arry)->get()) > 0) {
                $data['complaints'] = PropertyComplaint::with([
                    'ServiceList', 'Customer',
                    'Property' => function ($query) {
                        $query->select('id', 'title', 'product_code')->get();
                    },
                    'Property.PropertyCustomer' => function ($query) {
                        $query->where(['status' => 1, 'is_withdraw' => 0])->get();
                    },
                    'Property.PropertyCustomer.Customer' => function ($query) {
                        $query->select('first_name', 'last_name', 'id', 'email', 'phone')->get();
                    },

                ])->where($where_arry)->whereBetween('created_at', [$from, $to])
                    ->latest()->get()->toArray();
            }
        }
        $data['tenants'] = Customer::all();
        $data['total_services'] = count(PropertyComplaint::where($where_arry)->get());
        $data['new_request'] = count(PropertyComplaint::where($where_arry)->where('status', 0)->get());
        $data['accepted_request'] = count(PropertyComplaint::where($where_arry)->where('status', 1)->get());
        $data['rejected_request'] = count(PropertyComplaint::where($where_arry)->where('status', 2)->get());
        $data['processed_request'] = count(PropertyComplaint::where($where_arry)->where('status', 3)->get());
        $data['ressolved_request'] = count(PropertyComplaint::where($where_arry)->where('status', 4)->get());
        return view('admin.reports.tenant-service-report')->with($data);
    }

    public function shareHolderAccountsReport(Request $request)
    {
        $data = [];
        $where_arry = ['status' => 1];
        $data['dividends'] = [];
        $data['share_holders'] = [];
        $data['properties'] = Property::where('is_parent_property', '!=', -1)->get();
        $data['ledger'] = Ledger::all();
        $data['share_holder_names'] = ShareHolder::where('status', 1)->get();
        if (isset($request['ledger_id'])) {
            if ($request['ledger_id']) {
                $where_arry['ledger_id'] = $request['ledger_id'];
            }
            if ($request['share_holder_id']) {
                $where_arry['share_holder_id'] = $request['share_holder_id'];
            }
            if ($request['parent_property_id']) {
                $where_arry['parent_property_id'] = $request['parent_property_id'];
            }

            if (isset($request['start_date']) &&  isset($request['end_date'])) {
                $from = date($request['start_date']);
                $to = date('Y-m-d', strtotime($request['end_date']));
            }

            if (count(ShareHolderAccount::where($where_arry)->get()) > 0) {
                $data['dividends'] = ShareHolderAccount::with([
                    'ShareHolder', 'Ledger',
                    'Property' => function ($query) {
                        $query->select('id', 'title', 'product_code')->get();
                    },

                ])->where($where_arry)->whereBetween('created_at', [$from, $to])
                    ->latest()->get()->toArray();
                if ($data['dividends']) {

                    $result =  ShareHolderAccount::where($where_arry)->whereBetween('created_at', [$from, $to])
                        ->get()->groupBy('share_holder_id')->toArray();

                    foreach ($result as $key => $share_holders) {
                        $data['share_holders'][$key] = array_sum(array_column($share_holders, 'applied_amount'));
                    }
                }
            }
        }

        return view('admin.reports.share-holder-accounts-report')->with($data);
    }
}