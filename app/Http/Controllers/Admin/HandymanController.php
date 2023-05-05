<?php

namespace App\Http\Controllers\Admin;

use App\ComplaintHistory;
use App\Country;
use App\DocumentType;
use App\Handyman;
use App\HandymanComplaintStatus;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceList;
use App\PropertyComplaint;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HandymanController extends Controller
{

    public function index()
    {
        $handyman = Handyman::latest()->get();

        return view('admin.handyman.index', compact('handyman'));
    }
    public function list()
    {
        $data = array();
        $data['handyman'] = Handyman::latest()->get()->toArray();
        return view('admin.handyman.list')->with($data);
    }

    public function create()
    {
        $data = [];
        $data['document_types'] = DocumentType::all();

        return view('admin.handyman.create')->with($data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'document_type_id' => 'required',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
            'verification' => 'required',
            'phone' => 'required|min:6',
        ]);
        $user = User::create([
            'name'      => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make('123456'),
            'username'  => $request->input('email'),
            'role_id'   => '4', // handymans
            'contact_no' => $request->input('phone'),
            'country_id' => Country::where('is_active', 1)->first()->id,
        ]);
        $handyman = new Handyman();
        $handyman->user_id = $user->id;
        $handyman->first_name = $request->first_name;
        $handyman->last_name = $request->last_name;
        $handyman->email = $request->email;
        $handyman->phone = $request->phone;
        $handyman->address = $request->address;
        $handyman->verification = $request->verification;
        $handyman->status = $request->status;
        $handyman->document_type_id = $request->document_type_id;
        $handyman->save();
        $flash = array('type' => 'success', 'msg' => 'Handyman created successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'Handyman created successfully.');
        return redirect()->route('admin.handyman.index');
    }
    public function show(Handyman $handyman)
    {
        $handyman = Handyman::find($handyman->id);

        return view('admin.handyman.show', compact('handyman'));
    }
    public function edit(Handyman $handyman)
    {
        $data = [];
        $data['document_types'] = DocumentType::all();
        $data['handyman'] =
            Handyman::findOrFail($handyman->id);
        return view('admin.handyman.edit')->with($data);
    }

    public function update(Request $request, Handyman $handyman)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $handyman->user_id,
            'first_name' => 'required',
            'document_type_id' => 'required',
            'verification' => 'required',
            'phone' => 'required|min:6',
        ]);

        $handyman =  Handyman::findOrFail($handyman->id);
        User::whereId($handyman->user_id)->update([
            'name'      => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email'     => $request->input('email'),
            'username'  => $request->input('email'),
            'contact_no' => $request->input('phone'),
        ]);
        $handyman->first_name = $request->first_name;
        $handyman->last_name = $request->last_name;
        $handyman->email = $request->email;
        $handyman->phone = $request->phone;
        $handyman->address = $request->address;
        $handyman->verification = $request->verification;
        $handyman->status = $request->status;
        $handyman->document_type_id = $request->document_type_id;
        $handyman->save();

        $flash = array('type' => 'success', 'msg' => 'Handyman updated successfully.');
        session()->flash('flash', $flash);
        return redirect()->route('admin.handyman.index');
    }

    public function destroy(Handyman $handyman)
    {
        $handyman = Handyman::findOrFail($handyman->id);
        $handyman->delete();

        // Toastr::success('message', 'Handyman deleted successfully.');
        return back();
    }

    public function handymanManage(Request $request)
    {
        $data = array();
        $data['handyman'] = Handyman::find($request['id']);
        $data['new_complaints'] = HandymanComplaintStatus::with('PropertyComplaint.Property', 'PropertyComplaint.ServiceList', 'PropertyComplaint.Customer')->where(['handyman_id' => $request['id'], 'handyman_status' => 1])->latest()->get()->toArray();
        $data['accepted_complaints'] = HandymanComplaintStatus::with('PropertyComplaint.Property', 'PropertyComplaint.ServiceList', 'PropertyComplaint.Customer')->where(['handyman_id' => $request['id'], 'handyman_status' => 2])->latest()->get()->toArray();
        $data['process_complaints'] = HandymanComplaintStatus::with('PropertyComplaint.Property', 'PropertyComplaint.ServiceList', 'PropertyComplaint.Customer')->where(['handyman_id' => $request['id'], 'handyman_status' => 3])->latest()->get()->toArray();
        $data['completed_complaints'] = HandymanComplaintStatus::with('PropertyComplaint.Property', 'PropertyComplaint.Invoice.InvoiceList', 'PropertyComplaint.ServiceList', 'PropertyComplaint.Customer')->where(['handyman_id' => $request['id'], 'handyman_status' => 4])->latest()->get()->toArray();
        // return  $data['completed_complaints'];
        return view('admin.handyman.manage')->with($data);
    }

    public function changeHandymanStatus(Request $request)
    {
        $property_customer_id = HandymanComplaintStatus::whereId($request['id'])->first()->customer_id;

        $handyman_data = HandymanComplaintStatus::whereId($request['id'])->first();

        $property_complaint_id = HandymanComplaintStatus::whereId($request['id'])->first()->property_complaint_id;
        $order_number = isset($property_complaint_id) ? PropertyComplaint::find($property_complaint_id)->complaint_number : null;
        $check_handyman_complaint_status = HandymanComplaintStatus::checkDriverOrderStatus($property_complaint_id, $request['status']);

        if ($check_handyman_complaint_status == true) {
            $flash = array('type' => 'success', 'msg' => 'Unable to perform , Action has been assigned before.');
            session()->flash('flash', $flash);
            $handyman = Handyman::latest()->get();

            return view('admin.handyman.index', compact('handyman'));
        }
        if ($request['status'] == 2 && $handyman_data->handyman_status == 1) {

            HandymanComplaintStatus::whereId($request['id'])->update([
                'handyman_status' => 2,
                'is_handyman_assigned' => true
            ]);
            PropertyComplaint::whereId($property_complaint_id)->update([
                'assigned_time' => Carbon::now(),
            ]);
            ComplaintHistory::create(
                [
                    'property_complaint_id' => $property_complaint_id,
                    'customer_id' => $property_customer_id,
                    'property_agreement_id' => PropertyComplaint::find($property_complaint_id)->property_agreement_id,
                    'message' => 'Your complaint (#' . $order_number . ') has been Accepted!',
                    'title' =>  'Handyman Accepted',
                    'date' => Carbon::now()->toDateString(),
                ]
            );
        }
        if ($request['status'] == 3) {

            HandymanComplaintStatus::whereId($request['id'])->update([
                'work_start_time' => Carbon::now(),
            ]);
            ComplaintHistory::create(
                [
                    'property_complaint_id' => $property_complaint_id,
                    'customer_id' => $property_customer_id,
                    'property_agreement_id' => PropertyComplaint::find($property_complaint_id)->property_agreement_id,
                    'message' => 'Your complaint (#' . $order_number . ') under maintenance',
                    'title' =>  'Complaint progress',
                    'date' => Carbon::now()->toDateString(),
                ]
            );
        }
        if ($request['status'] == 4) {

            $work_start_time = HandymanComplaintStatus::whereId($request['id'])->first()->work_start_time;
            $work_end_time = Carbon::now();

            // $startTime = Carbon::parse($work_start_time);
            // $endTime = Carbon::parse($work_end_time);
            $totalDuration = $work_end_time->diff($work_start_time)->format('%H:%I:%S');
            HandymanComplaintStatus::whereId($request['id'])->update([
                'work_end_time' => $work_end_time,
                'elapsed_time' => $totalDuration,
                'handyman_status' => 4
            ]);
            PropertyComplaint::whereId($property_complaint_id)->update([
                'status' => 4,
                'resolved_time' =>  Carbon::now(),
            ]);

            ComplaintHistory::create(
                [
                    'property_complaint_id' => $property_complaint_id,
                    'customer_id' => $property_customer_id,
                    'property_agreement_id' => PropertyComplaint::find($property_complaint_id)->property_agreement_id,
                    'message' => 'Your complaint (#' . $order_number . ') ressolved',
                    'title' =>  'Completed',
                    'date' => Carbon::now()->toDateString(),
                ]
            );
        }
        HandymanComplaintStatus::whereId($request['id'])->update([
            'handyman_status' => $request['status'],
        ]);

        // return redirect()->route('admin.complaint');
    }
    public function complaintInvoice($id)
    {
        $property_complaint_id = $id;
        $data = [];
        $data['assigned_handyman'] = HandymanComplaintStatus::with('Handyman')->where('property_complaint_id', $property_complaint_id)->first();
        $invoice_id = Invoice::where(['property_complaint_id' => $property_complaint_id])->first()->id;
        $data['invoice_no'] = Invoice::where(['property_complaint_id' => $property_complaint_id])->first()->invoice_no;
        $data['total'] = InvoiceList::where('invoice_id', $invoice_id)->sum('item_price');

        $data['invoice_list'] = InvoiceList::where(['invoice_id' => $invoice_id])->get()->toArray();

        $data['data'] = PropertyComplaint::with('Property', 'Customer')->findOrFail($property_complaint_id);
        return view('admin.handyman.invoice')->with($data);
    }
}