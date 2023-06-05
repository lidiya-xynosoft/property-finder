<?php

namespace App\Http\Controllers\Admin;

use App\DividendRule;
use App\Landlord;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DividendController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
            // 'landlord_contract_id' => 'required',
            'dividend_persons' => 'required',
        ]);

        if (!empty($request['dividend_persons'])) {
            foreach ($request['dividend_persons'] as $persons) {

                if (isset($request['landlord_contract_id'])) {
                    $matchThese = [
                        'property_id' => $request['property_id'],
                        'landlord_property_contract_id' => $request['landlord_contract_id'],
                        'share_holder_id' => $persons['share_holder_id'],
                    ];
                } else if (isset($request['property_agreement_id'])) {
                    $matchThese = [
                        'property_id' => $request['property_id'],
                        'property_agreement_id' => $request['property_agreement_id'],
                        'share_holder_id' => $persons['share_holder_id'],
                    ];
                }

                DividendRule::updateOrCreate($matchThese, [
                    'no_of_share_holders' => $request['share_holders'],
                    'share_holder_id' => $persons['share_holder_id'],
                    'percentage' => $persons['percentage'],
                    'mode_of_calculation' => isset($persons['mode_of_calculation']) ? $persons['mode_of_calculation'] : 1,
                    'status' => 1,
                ]);
            }
        }
        $flash = array('type' => 'success', 'msg' => 'Dividend rule created successfully.');
        session()->flash('flash', $flash);
        return back();
    }

    public function edit(Landlord $landlord)
    {
        $landlord = Landlord::findOrFail($landlord->id);

        return view('admin.landlords.edit', compact('landlord'));
    }

    public function update(Request $request, Landlord $landlord)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $landlord->user_id,
            'last_name' => 'required',
            'phone' => 'required',
        ]);

        $landlord =  Landlord::findOrFail($landlord->id);

        $landlord->first_name = $request->first_name;
        $landlord->address = $request->address;
        $landlord->last_name = $request->last_name;
        $landlord->email = $request->email;
        $landlord->phone = $request->phone;
        $landlord->save();

        $flash = array('type' => 'success', 'msg' => 'Landlord updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.landlords.index');
    }

    public function dividendRuleDelete(Request $request)
    {
        $dividend_data = DividendRule::find($request->id)->delete();

        if ($request->ajax()) {

            return response()->json(['msg' => $dividend_data]);
        }
    }
}
