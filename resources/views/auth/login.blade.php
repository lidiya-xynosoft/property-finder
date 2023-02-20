@extends('frontend.layouts.auth')

@section('content')

          <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Login</h1>
                <h2><a href="index.html">Home </a> &nbsp;/&nbsp; login</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION LOGIN -->
    <div id="login">
        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                        @csrf

                <div class="form-group">
                    <label>{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
                        value="{{old('email')}}" required autofocus>

                   @if ($errors->has('email'))
                                    <span class="helper-text" data-error="wrong" data-success="right">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    <i class="icon_mail_alt"></i>
                </div>
                <div class="form-group">
                    <label>{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>

                  @if($errors->has('password'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            <strong>{{$errors->first('password')}}</strong>
                        </span>
                 @endif
                    <i class="icon_lock_alt"></i>
                </div>
                <div class="fl-wrap filter-tags clearfix add_bottom_30">
                    <div class="checkboxes float-left">
                        <div class="filter-tags-wrap">
                            <input type="checkbox" id="check-b" name="remember" class="filled-in"
                               {{ old('remember') ? 'checked' : '' }} />
                            <label for="check-b">{{__('Remember Me')}}</label>
                        </div>
                    </div>
                    <div class="float-right mt-1">
                        
                        <a id="forgot" class="indigo-text p-l-15" href="{{route('password.request')}}">
                            {{__('Forgot Your Password?')}}

                        </a>
                    </div>

                </div>
                <button type="submit" class="btn_1 rounded full-width">
                    {{__('Login')}}

                </button>
                <div class="text-center add_top_10"> {{__('New to ') . config('app.name')}}<strong><a
                            href="{{route('register')}}">{{__(' Sign up!')}}</a></strong></div>
            </form>
        </div>
    </div>
@endsection
