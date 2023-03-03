<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

use App\Property;
use App\Post;
use App\Tag;
use App\Category;
use App\City;
use App\Country;
use App\Feature;
use App\Setting;
use App\Message;
use App\Purpose;
use App\Type;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (!$this->app->runningInConsole()) {

            // SHARE TO ALL ROUTES
            $bedroomdistinct  = Property::select('bedroom')->distinct()->get();
            view()->share('bedroomdistinct', $bedroomdistinct);

            $bathroomdistinct  = Property::select('bathroom')->distinct()->get();
            view()->share('bathroomdistinct', $bathroomdistinct);

            $currency = Setting::find(1)->currency;

            view()->share('currency', $currency);

            $cities   = Property::select('city')->distinct()->get();
            $citylist = array();
            foreach ($cities as $city) {
                $citylist[$city['city']] = NULL;
            }
            view()->share('citylist', $citylist);


            // SHARE WITH SPECIFIC VIEW
            view()->composer('pages.search', function ($view) {
                $view->with('bathroomdistinct', Property::select('bathroom')->distinct()->get());
                $view->with('cities_all', City::all());
            });

            view()->composer('frontend.partials.footer', function ($view) {
                $view->with('footerproperties', Property::latest()->take(3)->get());
                $view->with('footersettings', Setting::select('footer', 'aboutus', 'facebook', 'twitter', 'linkedin')->get());
            });

            view()->composer('frontend.partials.navbar', function ($view) {
                $view->with('navbarsettings', Setting::select('name')->get());
            });
            view()->composer('frontend.partials.search', function ($view) {
                $view->with('types', Type::all());
                $view->with('purposes', Purpose::all());
                $view->with('countries', Country::all());
                $view->with('cities_all', City::all());
                $view->with('features', Feature::all());
            });

            view()->composer('backend.partials.navbar', function ($view) {
                $view->with('countmessages', Message::latest()->where('agent_id', Auth::id())->count());
                $view->with('navbarmessages', Message::latest()->where('agent_id', Auth::id())->take(5)->get());
            });

            view()->composer('pages.contact', function ($view) {
                $view->with('contactsettings', Setting::select('phone', 'email', 'address')->get());
            });

            view()->composer(
                'pages.blog.sidebar',
                function ($view) {

                    $archives     = Post::archives();
                    $categories   = Category::has('posts')->withCount('posts')->get();
                    $tags         = Tag::has('posts')->get();
                    $popularposts = Post::orderBy('view_count', 'desc')->take(5)->get();

                    $view->with(compact(
                        'archives',
                        'categories',
                        'tags',
                        'popularposts'
                    ));
                }
            );
            view()->composer(
                'pages.properties.sidebar',
                function ($view) {

                    $features = Feature::all();
                    // $tags = Tag::where('type', 'property')->get();
                    $purposes = Purpose::all();
                    $types = Type::all();
                    $cities = City::all();
                    $categories   = Category::has('posts')->withCount('posts')->get();
                    $tags         = Tag::has('property')->get();
                    $recent_properties = Property::latest()->take(3)->get();
                    $cities = City::all();
                    $processed_cities = [];
                    if ($cities) {
                        foreach ($cities as $key => $city) {
                            $processed_cities[$key] = array(
                                'total_property' => $city->property->pluck('city_id')->count(),
                                'image' => $city->image,
                                'city_name' => $city->name,
                                'city_slug' => $city->slug
                            );
                        }
                    }
                    $view->with(compact(
                        'purposes',
                        'features',
                        'types',
                        'cities',
                        'tags',
                        'categories',
                        'recent_properties',
                        'processed_cities'
                    ));
                }
            );
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}