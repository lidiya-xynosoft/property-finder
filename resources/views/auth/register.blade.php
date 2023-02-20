@extends('frontend.layouts.auth')

@section('content')

          <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Register</h1>
                <h2><a href="{{route('home')}}">Home </a> &nbsp;/&nbsp; Register</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION LOGIN -->
      <div id="login">
        <div class="login">
            <form method="POST" action="{{route('register')}}">
                  @csrf
                <div class="form-group">
                    <label for="name">{{__('Name')}}</label>
                    <input id="name" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                        name="name" value="{{old('name')}}" required autofocus>

                 @if($errors->has('name'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            <strong>{{$errors->first('name')}}</strong>
                        </span>
                  @endif
                    <i class="ti-user"></i>
                </div>
                <div class="form-group">
                    <label>Your Last Name</label>
                    <input class="form-control" type="text">
                    <i class="ti-user"></i>
                </div>
                <div class="form-group">
                    <label for="email">{{__('E-Mail Address')}}</label>
                    <input id="email" type="email"
                        class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email"
                        value="{{old('email')}}" required>

                 @if($errors->has('email'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            <strong>{{$errors->first('email')}}</strong>
                        </span>
                  @endif
                    <i class="icon_mail_alt"></i>
                </div>
                <div class="form-group">
                    <label for="country">{{__('Select Country')}}</label>
                    <select class="form-control" name=country>
                        <option value="1">IN</option>
                        <option value="2">KW</option>
                    </select>
                    <i class="icon_mail_alt"></i>
                </div>
                <div class="form-group">
                    <label for="contact_no">{{__('Contact Number')}}</label>
                    <input id="contact_no" type="text"
                        class="form-control {{$errors->has('number') ? 'is-invalid' : ''}}" name="contact_no"
                        value="{{old('contact_no')}}" required>

                 @if($errors->has('contact_no'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            <strong>{{$errors->first('contact_no')}}</strong>
                        </span>
                  @endif
                    <i class="icon_mail_alt"></i>
                </div>
                <div class="form-group">
                    <label for="password">{{__('Password')}}</label>
                    <input id="password" type="password"
                        class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" required>

                 @if($errors->has('password'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            <strong>{{$errors->first('password')}}</strong>
                        </span>
                  @endif
                    <i class="icon_lock_alt"></i>
                </div>
                <div class="form-group">
                    <label for="password-confirm">{{__('Confirm Password')}}</label>
                    <input id="password-confirm" type="password"
                        class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                        name="password_confirmation" required>
                    <i class="icon_lock_alt"></i>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="agent" class="filled-in" />
                    <span>{{__('Registration as Agent')}}</span>
                    <i class="icon_lock_alt"></i>
                </div>
                <div id="pass-info" class="clearfix"></div>
                <button type="submit" class="btn_1 rounded full-width add_top_30">
                    {{__('Register')}}

                </button>

                <div class="text-center add_top_10"> {{__('Already have an acccount? ')}}<strong><a
                            href="{{route('login')}}">{{__(' Sign in')}}</a></strong></div>
            </form>
        </div>
    </div>
@endsection
