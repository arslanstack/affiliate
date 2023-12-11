@extends('layouts.main')
@section('content')
<section class="page-title centred">
    <div class="pattern-layer" style="background-image: url(assets/images/background/page-title.jpg);"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Verify Details</h1>
            <ul class="bread-crumb clearfix">
                <li><i class="flaticon-home-1"></i><a href="{{route('welcome')}}">Home</a></li>
                <li>Verify Details</li>
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
                        <h3>Verify Your Email Address</h3>
                        <div class="">
                            @if(Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                            @elseif(Session::has('resent'))
                            <div class="alert alert-success">A fresh verification link has been sent to your email address.</div>
                            @endif
                        </div>
                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                        </p>
                    </div>
                    <div class="lower-inner centred">
                        <span>or</span>
                        <p><a style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout?</a></p>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection