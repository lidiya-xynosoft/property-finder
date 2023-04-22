<?php

namespace App\Http\Controllers\Admin;

use App\CancellationReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Mail\Contact;
use App\Property;
use App\Comment;
use App\ComplaintCancellationReason;
use App\ComplaintHistory;
use App\ComplaintImage;
use App\Customer;
use App\Handyman;
use App\HandymanComplaintStatus;
use App\Setting;
use App\Message;
use App\PropertyAgreement;
use App\PropertyComplaint;
use App\PropertyRent;
use App\ServiceList;
use App\User;
use Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['property_count'] = Property::count();
        $data['customer_count']     = Customer::count();
        $data['new_complaints']  = PropertyComplaint::where('status', 0)->count();
        $data['total_rent']     = PropertyRent::whereMonth('payment_date', Carbon::now()->month)->where(['payment_status' => true, 'status' => 1])->sum('rent_amount');
        $data['properties']    = Property::latest()->with('user')->take(5)->get();
        $data['complaints']         = PropertyComplaint::latest()->with(['Customer', 'Property', 'ServiceList'])->take(5)->get()->toArray();

        $data['pending_rent']         = PropertyRent::with('Property')->whereMonth('month', Carbon::now()->month)->where(['payment_status' => 0, 'status' => 1])->latest()->get();
        $data['comments']      = Comment::with('users')->take(5)->get();

        return view('admin.dashboard')->with($data);
    }


    public function settings()
    {
        $settings = Setting::first();

        return view('admin.settings.setting', compact('settings'));
    }

    public function settingStore(Request $request)
    {

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'currency'   => 'required',
            'footer'    => 'required',
            'aboutus'   => 'required',
            'facebook'  => 'required',
            'twitter'   => 'required',
            'linkedin'  => 'required',
        ]);

        Setting::updateOrCreate(
            ['id'       => 1],
            [
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'address'  => $request->address,
                'currency'  => $request->currency,
                'footer'   => $request->footer,
                'aboutus'  => $request->aboutus,
                'facebook' => $request->facebook,
                'twitter'  => $request->twitter,
                'linkedin' => $request->linkedin
            ]
        );

        $settings = Setting::first();
        $flash = array('type' => 'success', 'msg' => 'Updated successfully.');
        $request->session()->flash('flash', $flash);
        return back();
    }


    public function changePassword()
    {
        return view('admin.settings.changepassword');
    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
            $flash = array('type' => 'success', 'msg' => 'Your current password does not matches with the password you provided! Please try again.');
            session()->flash('flash', $flash);
            return redirect()->back();
        }
        if (strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0) {
            $flash = array('type' => 'success', 'msg' => 'New Password cannot be same as your current password! Please choose a different password.');
            session()->flash('flash', $flash);
            return redirect()->back();
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword' => 'required|string|min:6|confirmed',
        ]);
        User::whereId(Auth::user()->id)->update([
            'password' => bcrypt($request->get('newpassword'))
        ]);
        // $user = Auth::user();
        // $user->password = bcrypt($request->get('newpassword'));
        // $user->save();
        $flash = array('type' => 'success', 'msg' => 'Password changed successfully.');
        session()->flash('flash', $flash);
        return redirect()->back();
    }


    public function profile()
    {
        $profile = Auth::user();

        return view('admin.settings.profile', compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required|email',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'about'     => 'max:250'
        ]);

        $user = User::find(Auth::id());

        $image = $request->file('image');
        $slug  = str_slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-admin-' . Auth::id() . '-' . $currentDate . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('users')) {
                Storage::disk('public')->makeDirectory('users');
            }
            if (Storage::disk('public')->exists('users/' . $user->image) && $user->image != 'default.png') {
                Storage::disk('public')->delete('users/' . $user->image);
            }
            $userimage = Image::make($image)->stream();
            Storage::disk('public')->put('users/' . $imagename, $userimage);
        } else {
            $imagename = $user->image;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $imagename;
        $user->about = $request->about;

        $user->save();

        return back();
    }
    public function complaint()
    {
        $complaints = [];
        $complaint_lists = [];
        if (count(PropertyComplaint::all()) > 0) {
            $complaints = PropertyComplaint::with('Property', 'ServiceList', 'Customer')->latest()->get()->toArray();
        }

        $properties = Property::all();
        $service_lists = ServiceList::all();
        $complaint_lists = PropertyComplaint::all();
        return view('admin.settings.complaints.index', compact('complaints', 'properties', 'service_lists', 'complaint_lists'));
    }
    public function complaintRead($id)
    {
        $data = PropertyComplaint::with('Property', 'ServiceList', 'Customer', 'ComplaintImage')->findOrFail($id);
        $agreement_data = PropertyAgreement::find($data->property_agreement_id);
        $complaint_image = ComplaintImage::where('property_complaint_id', $data->id)->get();
        $cancellation_reason = CancellationReason::all();
        $handymans = Handyman::where('status', 1)->get();
        $assigned_handyman = HandymanComplaintStatus::with('Handyman')->where('property_complaint_id', $data->id)->first();
        return view('admin.settings.complaints.readcomplaint', compact('data', 'agreement_data', 'complaint_image', 'cancellation_reason', 'handymans', 'assigned_handyman'));
    }
    public function complaintReject(Request $request)
    {
        $complaint = PropertyComplaint::findOrFail($request['complaint_id']);
        $complaint->status = '2';
        ComplaintCancellationReason::create([
            'property_complaint_id' => $request['complaint_id'],
            'cancellation_reason_id' => $request['cancellation_reason_id']
        ]);
        ComplaintHistory::create(
            [
                'property_complaint_id' => $request['complaint_id'], 'customer_id' => $complaint['customer_id'], 'property_agreement_id' => $complaint['property_agreement_id'], 'message' => 'Complaint Rejected successfully', 'title' =>
                'Complaint Rejection', 'date' => Carbon::now()->toDateString()
            ]
        );
        $complaint->rejected_time = Carbon::now();
        $complaint->save();
        $flash = array('type' => 'success', 'msg' => 'rejected successfully.');
        session()->flash('flash', $flash);
    }
    public function complaintAction(Request $request)
    {
        $status = $request->status;
        $complaint_id  = $request->complaint_id;
        $complaint = PropertyComplaint::findOrFail($complaint_id);
        if (isset($request['handyman_id']) && $status == 3) {
            $complaint->status = 3;

            $complaint->is_handyman_assigned = 1;
            $complaint->handyman_id = $request['handyman_id'];

            HandymanComplaintStatus::updateOrCreate(
                [
                    'property_complaint_id' => $complaint_id,
                ],
                [
                    'user_id' => Auth::User()->id,
                    'handyman_id' => $request['handyman_id'],
                    'handyman_status' => 1,
                    'service_list_id' => $complaint->service_list_id,
                    'customer_id' => $complaint->customer_id,
                    'date' => Carbon::now()->toDateString(),
                ]
            );
            ComplaintHistory::create(
                [
                    'property_complaint_id' => $complaint_id, 'customer_id' => $complaint->customer_id, 'property_agreement_id' => $complaint->property_agreement_id, 'message' => 'Complaint Assigned to handyman successfully', 'title' =>
                    $complaint->complaint_number . ' Assign', 'date' => Carbon::now()->toDateString(),
                ]
            );
        }
        if ($status == 1) {
            $complaint->status = 1;
            $complaint->approved_time = Carbon::now();
            ComplaintHistory::create(
                [
                    'property_complaint_id' => $complaint_id, 'customer_id' => $complaint->customer_id, 'property_agreement_id' => $complaint->property_agreement_id, 'message' => 'Complaint Approved successfully', 'title' =>
                    $complaint->complaint_number . ' Approved', 'date' => Carbon::now()->toDateString(),
                ]
            );
        }

        $complaint->save();

        return redirect()->route('admin.complaint');
    }
    public function complaintSearch(Request $request)
    {
        $where_arry = [];
        $complaints = [];
        $complaint_lists = PropertyComplaint::all();

        if (!$request['status'] && !$request['property_id'] && !$request['service_list_id'] && !$request['complaint_id']) {
            $flash = array('type' => 'error', 'msg' => 'Choose any data for search');
            session()->flash('flash', $flash);
            return redirect()->back();
        }
        if (isset($request['status'])) {
            if ($request['status']) {
                $where_arry['status'] = $request['status'];
            }
        }
        if (isset($request['property_id'])) {
            if ($request['property_id'] != 0) {
                $where_arry['property_id'] = $request['property_id'];
            }
        }
        if (isset($request['service_list_id'])) {
            if ($request['service_list_id'] != 0) {
                $where_arry['service_list_id'] = $request['service_list_id'];
            }
        }
        if (isset($request['complaint_id'])) {
            if ($request['complaint_id'] != 0) {
                $where_arry['id'] = $request['complaint_id'];
            }
        }
        if (count(PropertyComplaint::where($where_arry)->get()) > 0) {
            $complaints = PropertyComplaint::with('Property', 'ServiceList', 'ComplaintImage', 'Customer')->where($where_arry)->latest()->get()->toArray();
        }
        $properties = Property::all();
        $service_lists = ServiceList::all();
        return view('admin.settings.complaints.index', compact('complaints', 'properties', 'service_lists', 'complaint_lists'));
    }
    public function complaintHistory(Request $request)
    {
        $data = [];
        $complaint_id = $request['id'];
        $data['property_title'] = Property::find(PropertyComplaint::find($complaint_id)->property_id)->title;
        $data['complaint_number'] = PropertyComplaint::find($complaint_id)->complaint_number;
        $data['histories'] = ComplaintHistory::with('Customer')->where('property_complaint_id', $complaint_id)->latest()->get();
        return view('admin.settings.complaints.history')->with($data);
    }
    // MESSAGE
    public function message()
    {
        $messages = Message::latest()->where('agent_id', Auth::id())->get();

        return view('admin.settings.messages.index', compact('messages'));
    }

    public function messageRead($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.settings.messages.readmessage', compact('message'));
    }

    public function messageReplay($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.settings.messages.replaymessage', compact('message'));
    }

    public function messageSend(Request $request)
    {
        $request->validate([
            'agent_id'  => 'required',
            'user_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        Message::create($request->all());
        $flash = array('type' => 'success', 'msg' => 'Message send successfully.');
        session()->flash('flash', $flash);
        // Toastr::success('message', 'Message send successfully.');
        return back();
    }

    public function messageReadUnread(Request $request)
    {
        $status = $request->status;
        $msgid  = $request->messageid;

        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }

        $message = Message::findOrFail($msgid);
        $message->status = $status;
        $message->save();

        return redirect()->route('admin.message');
    }

    public function messageDelete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        $flash = array('type' => 'success', 'msg' => 'Message deleted successfully.');
        session()->flash('flash', $flash);
        return back();
    }

    public function contactMail(Request $request)
    {
        $message  = $request->message;
        $name     = $request->name;
        $mailfrom = $request->mailfrom;

        Mail::to($request->email)->send(new Contact($message, $name, $mailfrom));
        $flash = array('type' => 'success', 'msg' => 'Mail send successfully.');
        session()->flash('flash', $flash);
        return back();
    }
}