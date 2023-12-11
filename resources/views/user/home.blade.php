@extends('layouts.app')

@section('content')

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-card-four">
        <div class="widget-content">
            <div class="w-header">
                <div class="w-info">
                    <h6 class="value">Available Balance</h6>
                </div>
            </div>

            <div class="w-content">

                <div class="w-info">
                    <p class="value">$ {{get_user_available_balance(Auth::id())}}</p>
                </div>

            </div>

            <div class="w-progress-stats">
                <div class="progress">
                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{get_user_total_earnings(Auth::id()) == 0 ? 0 : (get_user_available_balance(Auth::id())/get_user_total_earnings(Auth::id())) * 100}}%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="">
                    <div class="w-icon">
                        <p>{{get_user_total_earnings(Auth::id()) == 0 ? 0 : (get_user_available_balance(Auth::id())/get_user_total_earnings(Auth::id())) * 100}}%</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-card-five">
        <div class="widget-content">
            <div class="account-box">

                <div class="info-box">
                    <div class="icon">
                        <span>
                            <img src="{{asset('user/src/assets/img/money-bag.png')}}" alt="money-bag">
                        </span>
                    </div>

                    <div class="balance-info">
                        <h6>Total Earnings</h6>
                        <p>${{get_user_total_earnings(Auth::id())}}</p>
                    </div>
                </div>

                <div class="card-bottom-section">
                    <a href="{{route('earnings')}}" class="">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-card-five">
        <div class="widget-content">
            <div class="account-box">

                <div class="info-box">
                    <div class="balance-info">
                        <p>Refer Your Friends & Family to Earn Commission</p> <br>
                        <h6 class="text-start float-start">Your referral code is: <span><strong>{{ Auth::user()->referral_code }}</strong></span></h6>
                    </div>
                    <div class="card-bottom-section text-start float-start">
                        <a id="copyReferralLink" class="btn btn-sm btn-primary">Copy Referral Link</a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('copyReferralLink').addEventListener('click', function() {
        var referralLink = document.createElement('textarea');
        referralLink.value = '{{ route("register", ["referral_token" => Auth::user()->referral_code]) }}';
        document.body.appendChild(referralLink);
        referralLink.select();
        document.execCommand('copy');
        document.body.removeChild(referralLink);
        Toastify({
            text: 'Referral Link Copied!',
            duration: 3000,
            gravity: 'bottom',
            position: 'right',
        }).showToast();
    });
</script>
@endsection