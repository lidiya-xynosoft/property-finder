<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use Illuminate\Support\Facades\Validator;

use App\Property;
use App\Message;
use App\Gallery;
use App\Comment;
use App\NearbyCategory;
use App\NearbyProperty;
use App\Rating;
use App\Post;
use App\Setting;
use App\Tag;
use App\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class PagesController extends Controller
{
    public function properties()
    {
        $cities     = Property::select('city', 'city_slug')->distinct('city_slug')->get();
        $types     = Property::select('type')->distinct('type')->get();
        $properties = Property::latest()->with('rating')->withCount('comments')->paginate(8);
        $recent_properties     = Property::latest()->where('featured', 0)->with('rating')->withCount('comments')->take(3)->get();
        if (Auth::user()) {
            $user_data = User::with('country')->where('id', Auth::id())->first();
            $currency = $user_data->country->currency;
        } else {
            $currency = Setting::find(1)->currency;
        }
        return view('pages.properties.property', compact('properties', 'cities', 'recent_properties', 'types', 'currency'));
    }

    public function getCityLatLong(Request $request)
    {
        $city_id = $request->city_id;
        if ($city_id && !empty($city_id)) {
            $data = City::whereId($city_id)->first();
            return response([
                'lat' =>  $data->latitude,
                'long' => $data->longitude,
                'success' => 1,
            ]);
        } else {
            return response([
                'success' => 0,
            ]);
        }
    }
    public function propertieshow($code, $slug)
    {
        $property = Property::with('features', 'gallery', 'user', 'comments')
        ->withCount('comments')
        ->where('product_code', $code)
        ->first();
        $rating = Rating::where('property_id', $property->id)->where('type', 'property')->avg('rating');
        $nearby = NearbyProperty::with('NearbyCategory')->where('property_id', $property->id)->get()->groupBy('nearby_category_id');
        $processed_nearby = [];
        if ($nearby) {
            foreach ($nearby as $key => $items) {
                $processed_nearby[NearbyCategory::find($key)->name] = array(
                    'category' => NearbyCategory::find($key)->name,
                    'class' => NearbyCategory::find($key)->class,
                    'slug' => NearbyCategory::find($key)->slug,
                    'icon' => NearbyCategory::find($key)->icon,
                );
                if ($items && !empty($items)) {
                    foreach ($items as $key1 => $row) {
                        $processed_nearby[NearbyCategory::find($key)->name]['items'][$key1]['title'] = $row['title'];
                        $processed_nearby[NearbyCategory::find($key)->name]['items'][$key1]['distance'] = $row['distance'];
                    }
                }
            }
        }
        $agent      = User::findOrFail($property->agent_id);
        $tags         = Tag::has('property')->get();
        $relatedproperty = Property::latest()
            ->where('purpose', $property->purpose)
            ->where('type', $property->type)
            ->where('bedroom', $property->bedroom)
            ->where('bathroom', $property->bathroom)
            ->where('id', '!=', $property->id)
            ->take(3)->get();

        $videoembed = $this->convertYoutube($property->video, 560, 315);

        $cities = Property::select('city', 'city_slug')->distinct('city_slug')->get();

        return view('pages.properties.single', compact('property', 'tags', 'agent', 'processed_nearby', 'rating', 'relatedproperty', 'videoembed', 'cities'));
    }


    // AGENT PAGE
    public function agents()
    {
        $agents = User::with('Property')->latest()->where('role_id', 2)->paginate(12);
        $recent_properties = Property::latest()->paginate(3);
        return view('pages.agents.index', compact('agents', 'recent_properties'));
    }

    public function agentshow($id)
    {
        $agent      = User::findOrFail($id);
        $properties = Property::latest()->where('agent_id', $id)->paginate(10);
        $recent_properties = Property::latest()->where('agent_id', $id)->paginate(3);
        $properties_count = Property::where('agent_id', $id)->count();
        return view('pages.agents.single', compact('agent', 'properties', 'recent_properties', 'properties_count'));
    }


    // BLOG PAGE
    public function blog()
    {
        $month = request('month');
        $year  = request('year');

        $posts = Post::latest()->withCount('comments')
            ->when($month, function ($query, $month) {
                return $query->whereMonth('created_at', Carbon::parse($month)->month);
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('created_at', $year);
            })
            ->where('status', 1)
            ->paginate(2);

        return view('pages.blog.index', compact('posts'));
    }

    public function blogshow($slug)
    {
        $post = Post::with('comments')->withCount('comments')->where('slug', $slug)->first();

        $blogkey = 'blog-' . $post->id;
        if (!Session::has($blogkey)) {
            $post->increment('view_count');
            Session::put($blogkey, 1);
        }

        return view('pages.blog.single', compact('post'));
    }


    // BLOG COMMENT
    public function blogComments(Request $request, $id)
    {
        $request->validate([
            'body'  => 'required'
        ]);

        $post = Post::find($id);

        $post->comments()->create(
            [
                'user_id'   => Auth::id(),
                'body'      => $request->body,
                'parent'    => $request->parent,
                'parent_id' => $request->parent_id
            ]
        );

        return back();
    }


    // BLOG CATEGORIES
    public function blogCategories()
    {
        $posts = Post::latest()->withCount(['comments', 'categories'])
            ->whereHas('categories', function ($query) {
                $query->where('categories.slug', '=', request('slug'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG TAGS
    public function blogTags()
    {
        $posts = Post::latest()->withCount('comments')
            ->whereHas('tags', function ($query) {
                $query->where('tags.slug', '=', request('slug'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG AUTHOR
    public function blogAuthor()
    {
        $posts = Post::latest()->withCount('comments')
            ->whereHas('user', function ($query) {
                $query->where('username', '=', request('username'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }



    // MESSAGE TO AGENT (SINGLE AGENT PAGE)
    public function messageAgent(Request $request)
    {
        $rules = [
            'agent_id'  => 'required',
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'message'   => 'required'
        ];
        $request->validate($rules);

        Message::create($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Thank you, We have recieved your enquiry.']);
        }
    }


    // CONATCT PAGE
    public function contact()
    {
        return view('pages.contact');
    }

    public function messageContact(Request $request)
    {

        $rules = [
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ];

        $request->validate($rules);

        // if ($validator->fails()) {
        //     return response()->json($request->validate($rules));
        // } else {
        //     return response()->json(['message' => 'Thank you, We have recieved your enquiry.']);
        // }
        $message  = $request->message;
        $mailfrom = $request->email;

        Message::create([
            'agent_id'  => 1,
            'name'      => $request->name,
            'email'     => $mailfrom,
            'phone'     => $request->phone,
            'message'   => $message
        ]);

        $adminname  = User::find(1)->name;
        $mailto     = $request->mailto;

        // Mail::to($mailto)->send(new Contact($message,$adminname,$mailfrom));

        // $flash = array('type' => 'success', 'msg' => 'Thank you, We have recieved your enquiry.');
        // $request->session()->flash('flash', $flash);
        // return back();

        if ($request->ajax()) {
            return response()->json(['message' => 'Thank you, We have recieved your enquiry.']);
        }
    }

    public function contactMail(Request $request)
    {
        return $request->all();
    }


    // GALLERY PAGE
    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('pages.gallery', compact('galleries'));
    }


    // PROPERTY COMMENT
    public function propertyComments(Request $request, $id)
    {
        $request->validate([
            'body'  => 'required'
        ]);

        $property = Property::find($id);

        $property->comments()->create(
            [
                'user_id'   => Auth::id(),
                'body'      => $request->body,
                'parent'    => $request->parent,
                'parent_id' => $request->parent_id
            ]
        );

        return back();
    }


    // PROPERTY RATING
    public function propertyRating(Request $request)
    {
        $rating      = $request->input('rating');
        $property_id = $request->input('property_id');
        $user_id     = $request->input('user_id');
        $type        = 'property';

        $rating = Rating::updateOrCreate(
            ['user_id' => $user_id, 'property_id' => $property_id, 'type' => $type],
            ['rating' => $rating]
        );

        if ($request->ajax()) {
            return response()->json(['rating' => $rating]);
        }
    }


    // PROPERTY CITIES
    public function propertyCities(Request $request)
    {
        $cities     = Property::select('city', 'city_slug')->distinct('city_slug')->get();
        $properties = Property::latest()->with('rating')->withCount('comments')
        ->where('city_slug', request('cityslug'))
        ->paginate(12);

        return view('pages.properties.property', compact('properties', 'cities'));
    }

    public function propertyCitieswithslug(Request $request)
    {
        $cities     = Property::select('city', 'city_slug')->distinct('city_slug')->get();
        $properties = Property::latest()->with('rating')->withCount('comments')
            ->where('city_slug', request('cityslug'))
            ->paginate(12);

        return view('pages.properties.property', compact('properties', 'cities'));
    }


    // YOUTUBE LINK TO EMBED CODE
    private function convertYoutube($youtubelink, $w = 250, $h = 140)
    {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"$w\" height=\"$h\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>",
            $youtubelink
        );
    }
}