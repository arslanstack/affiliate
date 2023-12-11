@php
// If referral_token is set, set the value for referral code
if(isset($_GET['referral_token'])){
$referral_code = $_GET['referral_token'];
}else{
$referral_code = '';
}

// If the referral code is not empty, check if it is valid or not
if($referral_code != ''){
$check = \App\Models\User::where('referral_code', $referral_code)->first();
if(!$check){
$referral_code = '';
}
}
@endphp
@extends('layouts.main')
@section('content')
<section class="page-title centred">
    <div class="pattern-layer" style="background-image: url(assets/images/background/page-title.jpg);"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>My Account</h1>
            <ul class="bread-crumb clearfix">
                <li><i class="flaticon-home-1"></i><a href="{{route('welcome')}}">Home</a></li>
                <li>My Account</li>
            </ul>
        </div>
    </div>
</section>
<section class="myaccount-section p-4">
    <div class="auto-container">
        <div class="row mx-auto">
            <div class="col-lg-6 mx-auto col-md-12 col-sm-12 inner-column">
                <div class="inner-box login-inner">
                    <div class="upper-inner">
                        <h3>Create An Account</h3>
                        <p>Register to access all your resources</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="default-form">
                        @csrf
                        <div class="form-group mx-auto">
                            @if(Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Your name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input id="c_password" type="password" class="form-control" name="password_confirmation" required>

                        </div>
                        <div class="form-group">
                            <label>Referral Code</label>
                            <input id="referral_code" type="text" class="form-control" name="referral_code" value="{{ $referral_code }}">

                        </div>
                        <div class="form-group">
                            <button type="submit" class="theme-btn-two">Register<i class="flaticon-right-1"></i></button>
                        </div>
                    </form>
                    <div class="lower-inner centred">
                        <span>or</span>
                        <p>Already have an account? <a href="{{route('login')}}">Log In Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection