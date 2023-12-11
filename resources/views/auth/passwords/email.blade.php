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
                        <h3>{{ __('Reset Password') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}" class="default-form">
                        @csrf
                        <div class="form-group mx-auto">
                            @if(Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
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
                            <button type="submit" class="theme-btn-two">{{ __('Send Password Reset Link') }}<i class="flaticon-right-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection