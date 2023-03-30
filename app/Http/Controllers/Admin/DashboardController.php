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
use App\Post;
use App\Comment;
use App\ComplaintCancellationReason;
use App\ComplaintImage;
use App\Setting;
use App\Message;
use App\PropertyAgreement;
use App\PropertyComplaint;
use App\ServiceList;
use App\User;
use Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\While_;

class DashboardController extends Controller
{
    public function index()
    {
        $propertycount = Property::count();
        $postcount     = Post::count();
        $commentcount  = Comment::count();
        $usercount     = User::count();

        $properties    = Property::latest()->with('user')->take(5)->get();
        $posts         = Post::latest()->withCount('comments')->take(5)->get();
        $users         = User::with('role')->latest()->take(5)->get();
        $comments      = Comment::with('users')->take(5)->get();

        return view('admin.dashboard', compact(
            'propertycount',
            'postcount',
            'commentcount',
            'usercount',
            'properties',
            'posts',
            'users',
            'comments'
        ));
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
        if (count(PropertyComplaint::all()) > 0) {
            $complaints = PropertyComplaint::with('Property', 'ServiceList', 'Customer')->latest()->get()->toArray();
        }

        $properties = Property::all();
        $service_lists = ServiceList::all();
        return view('admin.settings.complaints.index', compact('complaints', 'properties', 'service_lists'));
    }
    public function complaintRead($id)
    {
        $data = PropertyComplaint::with('Property', 'ServiceList', 'Customer', 'ComplaintImage')->findOrFail($id);
        $agreement_data = PropertyAgreement::find($data->property_agreement_id);
        $complaint_image = ComplaintImage::where('property_complaint_id', $data->id)->get();
        $cancellation_reason = CancellationReason::all();

        return view('admin.settings.complaints.readcomplaint', compact('data', 'agreement_data', 'complaint_image', 'cancellation_reason'));
    }
    public function complaintReject(Request $request)
    {
        $message = PropertyComplaint::findOrFail($request['complaint_id']);
        $message->status = '2';
        ComplaintCancellationReason::create([
            'property_complaint_id' => $request['complaint_id'],
            'cancellation_reason_id' => $request['cancellation_reason_id']
        ]);
        $message->rejected_time = Carbon::now();
        $message->save();
        $flash = array('type' => 'success', 'msg' => 'rejected successfully.');
        session()->flash('flash', $flash);
    }
    public function complaintAction(Request $request)
    {
        $status = $request->status;
        $msgid  = $request->complaint_id;

        $message = PropertyComplaint::findOrFail($msgid);
        $message->status = $status;
        $message->approved_time = Carbon::now();
        $message->save();

        return redirect()->route('admin.complaint');
    }
    public function complaintSearch(Request $request)
    {
        $where_arry = [];
        $complaints = [];
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
            $complaints = PropertyComplaint::with('Property', 'ServiceList', 'ComplaintImage')->where($where_arry)->latest()->get()->toArray();
        }
        $properties = Property::all();
        $service_lists = ServiceList::all();
        return view('admin.settings.complaints.index', compact('complaints', 'properties', 'service_lists'));
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
