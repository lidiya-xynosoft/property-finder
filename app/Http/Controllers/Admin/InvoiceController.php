<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceList;
use App\PropertyComplaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function saveUpdateInvoice(Request $request)
    {
        $request->validate([
            'handyman_id' => 'required',
            'property_complaint_id' => 'required',
        ]);
        $invoice_count = Invoice::count() + 1;

        $invoice_code = 'INV-' . $invoice_count;

        if (!empty($request['lists'])) {
            $invoice = Invoice::create(
                [
                    'handyman_id' => $request['handyman_id'],
                    'property_complaint_id' => $request['property_complaint_id'],
                    'invoice_no' => $invoice_code,
                    'customer_id' => PropertyComplaint::find($request['property_complaint_id'])->customer_id,
                    'property_agreement_id' => PropertyComplaint::find($request['property_complaint_id'])->property_agreement_id,
                    'date' => Carbon::now()->toDateString(),
                ],
            );
            foreach ($request['lists'] as $each_items) {

                $invoice_list = InvoiceList::create([
                    'invoice_id' => $invoice->id,
                    'item' => $each_items['item_name'],
                    'item_price' => $each_items['item_price'],
                    'date' => Carbon::now()->toDateString(),
                ]);
            }
        }
        $flash = array('type' => 'success', 'msg' => 'Invoice added successfully.');
        session()->flash('flash', $flash);
        return $invoice_list;
    }
}
