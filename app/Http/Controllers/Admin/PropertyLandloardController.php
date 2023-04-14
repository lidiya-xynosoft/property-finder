<?php

namespace App\Http\Controllers\Admin;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;
use App\Feature;
use App\PropertyImageGallery;
use App\Customer;
use App\DocumentType;
use App\Landloard;
use App\LandloardExpense;
use App\LandloardIncome;
use App\LandloardPropertyContract;
use App\LandloardRent;
use App\Ledger;
use App\NearbyCategory;
use App\NearbyProperty;
use App\PaymentType;
use App\PropertyAgreement;
use App\PropertyAgreementDocument;
use App\PropertyDocument;
use App\PropertyExpense;
use App\PropertyIncome;
use App\PropertyRent;
use App\Purpose;
use App\Setting;
use App\Tag;
use App\Type;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class PropertyLandloardController extends Controller
{
    public function propertyLandloardManage(Request $request)
    {
        $data = array();
        $data['property'] = Property::find($request['property_id']);
        if (isset($request['update_id'])) {
            $agreement_row_id = $request['update_id'];
            $property_id = LandloardPropertyContract::find($agreement_row_id)->property_id;
            $landloard_id = LandloardPropertyContract::find($agreement_row_id)->landloard_id;
        } else {
            $property_id =
                $request['property_id'];
        }
        $data['property'] = Property::find($property_id);


        if (isset($request['update_id'])) {
            $data['update_data'] = LandloardPropertyContract::where(['is_withdraw' => 0, 'id' => $agreement_row_id])->first();
        }
        $data['rows'] = [];
        $data['income'] = [];
        $data['total_expense'] = null;
        $data['fixed_expenses'] = [];
        $data['total_income'] = null;
        $data['property_history'] = [];
        if (LandloardPropertyContract::where(['property_id' => $property_id, 'is_withdraw' => 0])->first()) {
            $data['rows'] = LandloardPropertyContract::with([
                'LandloardProperty' => function ($query) use ($property_id) {
                    $query->where(['property_id' => $property_id, 'is_withdraw' => 0])->get();
                }, 'Landloard'
            ])->where(['property_id' => $property_id, 'is_withdraw' => 0])->first()->toArray();
        }

        $data['ledger_expense'] = Ledger::where('type', 1)->get();
        $data['ledger_income'] = Ledger::where('type', 0)->get();
        $data['payment_types'] = PaymentType::all();
        $data['rent_months'] = [];
        if (isset($data['rows']) && !empty($data['rows'])) {
            $landloard_id = LandloardPropertyContract::where('property_id', $property_id)->first()->landloard_id;

            $rent_months = LandloardRent::where(['property_id' => $property_id, 'landloard_property_contract_id' => $data['rows']['id'], 'status' => 1])->get();
            if (count($rent_months) > 0) {
                $data['rent_months'] = $rent_months;
            } else {
                $result = CarbonPeriod::create($data['rows']['lease_commencement'], '1 month', $data['rows']['lease_expiry']);

                foreach ($result as $dt) {
                    LandloardRent::create([
                        'property_id' => $property_id,
                        'landloard_id' => $landloard_id,
                        'payment_type_id' => '1', // cash payment
                        'landloard_property_contract_id' => $data['rows']['id'],
                        'month' => $dt->format("Y-M"),
                        'rental_date' => $data['rows']['rent_payment_commencement'],
                        'rent_amount' => $data['rows']['monthly_rent'],
                    ]);
                }
                $rent_months = LandloardRent::where(['property_id' => $property_id, 'landloard_property_contract_id' => $data['rows']['id'], 'status' => 1])->get();
                $data['rent_months'] = $rent_months;
            }
            $data['fixed_expenses'] = LandloardExpense::with('Ledger')->where(['property_id' => $property_id, 'status' => 1, 'landloard_property_contract_id' => $data['rows']['id']])->get()->toArray();

            $data['income'] =  LandloardIncome::with('Ledger')->where([
                'property_id' => $property_id, 'status' => 1,
                'landloard_id' => $landloard_id,

                'landloard_property_contract_id' => $data['rows']['id']
            ])->get();

            $data['total_expense'] =  LandloardExpense::where([
                'property_id' => $property_id,
                'landloard_id' => $landloard_id,

                'status' => 1,
                'landloard_property_contract_id' => $data['rows']['id']
            ])->sum('amount');
            $data['total_income'] =  LandloardIncome::where([
                'property_id' => $property_id,
                'landloard_id' => $landloard_id,

                'status' => 1,
                'landloard_property_contract_id' => $data['rows']['id']
            ])->sum('amount');
        }
        $data['property_history'] =  LandloardPropertyContract::where([
            'property_id' => $property_id,
        ])->latest()->get();
        $data['settings'] = Setting::first();
        $data['landloards'] = Landloard::all();
        return view('admin.properties.property-landloard')->with($data);
    }
}