@extends('frontend.layouts.app')
@section('title', 'Blog Details')
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
                <h1>Blog Details</h1>
                <h2><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; Blog Details</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION BLOG -->
    <section class="blog blog-section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="news-item details no-mb2">
                                @if (Storage::disk('public')->exists('posts/' . $post->image))
                                    <a href="blog-details.html" class="news-img-link">
                                        <div class="news-item-img">
                                            <img class="img-responsive" src="{{ Storage::url('posts/' . $post->image) }}"
                                                alt="{{ $post->title }}">
                                        </div>
                                    </a>
                                @endif
                                <div class="news-item-text details pb-0">
                                    <a href="blog-details.html">
                                        <h3> {{ $post->title }}</h3>
                                    </a>
                                    <div class="dates">
                                        <span class="date">{{ $post->created_at->diffForHumans() }} &nbsp;/</span>
                                        <ul class="action-list pl-0">
                                            <li class="action-item pl-2"><i class="fa fa-heart"></i> <span>306</span></li>
                                            <li class="action-item"><i class="fa fa-comment"></i>
                                                <span>{{ $post->comments_count }}</span></li>
                                            <li class="action-item"><i class="fa fa-eye"></i>
                                                <span>{{ $post->view_count }}</span></li>
                                        </ul>
                                    </div>
                                    <div class="news-item-descr big-news details visib mb-0">
                                        <p class="mb-3"> {!! $post->body !!}</p>

                                        <p class="d-none d-sm-none d-lg-block d-md-block">{!! $post->body !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments">
                       

                        @foreach ($post->comments as $comment)
                         <h3 class="mb-5">{{ count($post->comments) }} Comments</h3>
                            <div class="row my-4">
                                <ul class="col-12 commented">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="{{ Storage::url('users/'.$comment->users->image) }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-md-10 comments-info no-mb">
                                            <h5 class="mb-1">{{ $comment->users->name }}</h5>
                                            <p class="mb-4">{{ $comment->created_at->diffForHumans() }}</p>
                                            <p>{{ $comment->body }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </section>
                    @auth
                        <section class="leve-comments wpb">
                            <h3 class="mb-5">Leave a Comment</h3>
                            <div class="row">
                                <div class="col-md-12 data">
                                    <form action="#">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <textarea class="form-control" id="exampleTextarea" rows="8" placeholder="Message" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg mt-2">Submit Comment</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                    @endauth
                    @guest
                        <div class="comment-login">
                            <h6>Please Login to comment</h6>
                            <a href="{{ route('login') }}" class="btn indigo">Login</a>
                        </div>
                    @endguest
                </div>
                @include('pages.blog.sidebar')
            </div>
        </div>
    </section>
    <!-- END SECTION BLOG -->


    <!-- push external js -->
    @push('script')
        <script src="{{ asset('frontend/findhouse/js/jquery-ui.js') }}"></script>
    @endpush
@endsection
