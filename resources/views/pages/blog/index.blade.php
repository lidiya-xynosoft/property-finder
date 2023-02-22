@extends('frontend.layouts.app')
@section('title', 'Blog')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/font/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/fontawesome-5-all.min.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">

        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet-gesture-handling.min.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.default.css') }}">
    @endpush


    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Blog</h1>
                <h2><a href="index.html">Home </a> &nbsp;/&nbsp; Blog</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION BLOG -->
    <section class="blog blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-xs-12">
                    @foreach ($posts as $key => $post)
                        <div class="row">
                            <div class="col-md-6 col-xs-12 no-mb wpt-2">
                                <div class="news-item nomb">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="news-img-link">
                                        @if (Storage::disk('public')->exists('posts/' . $post->image) && $post->image)
                                            <div class="news-item-img">
                                                <img class="img-responsive"
                                                    src="{{ Storage::url('posts/' . $post->image) }}"
                                                    alt="{{ $post->title }}">
                                            </div>
                                        @endif

                                    </a>
                                    <div class="news-item-text">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            <h3>{{ $post->title }}</h3>
                                        </a>
                                        <div class="dates">
                                            <span class="date">{{ $post->created_at->diffForHumans() }}/</span>
                                            <ul class="action-list pl-0">
                                                <li class="action-item pl-2"><i class="fa fa-heart"></i> <span>306</span>
                                                </li>
                                               
                                                <li class="action-item"><i class="fa fa-comment"></i>
                                                    <span>{{ $post->comments_count }}</span>
                                                </li>
                                                <li class="action-item"><i class="fa fa-eye"></i>
                                                    <span>{{ $post->view_count }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="news-item-descr big-news">
                                            <p> {{ str_limit($post->body, 120) }}
                                            </p>
                                        </div>
                                        <div class="news-item-bottom">
                                            <a href="{{ route('blog.show', $post->slug) }}" class="news-link">Read
                                                more...</a>
                                            <div class="admin">
                                                <p>By, {{ $post->user->name }}</p>
                                                <img src="images/testimonials/ts-1.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    {{-- <div class="row space2 port">
                            
                        </div>
                         --}}
                </div>
              @include('pages.blog.sidebar')
            </div>
            <nav aria-label="..." class="pt-5">
                <ul class="pagination">
                    {{ $posts->appends(['month' => Request::get('month'), 'year' => Request::get('year')])->links() }}
                </ul>
            </nav>
        </div>
    </section>
    <!-- END SECTION BLOG -->
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('frontend/findhouse/js/jquery-ui.js') }}"></script>
    @endpush
@endsection
