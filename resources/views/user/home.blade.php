@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Total Earnings</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="{{get_user_total_earnings(Auth::id())}}">0</span></h4>
                            <a href="{{route('earnings')}}" class="text-decoration-underline">View Affiliate Earnings</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-dollar-circle text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Referrals</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{get_user_referrals_count(Auth::id())}}">0</span></h4>
                            <a href="{{route('referrals')}}" class="text-decoration-underline">See details</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-user-circle text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-white-50 mb-0">Orders</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"><span class="counter-value" data-target="{{get_user_orders_count(Auth::id())}}">0</span></h4>
                            <a href="{{route('orders')}}" class="text-decoration-underline text-white-50">View all orders</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-dark rounded fs-3">
                                <i class="bx bx-shopping-bag text-white"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">My Balance</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="{{get_user_available_balance(Auth::id())}}">0</span></h4>
                            <a href="#" class="text-decoration-underline">Withdraw money</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-wallet text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card bg-primary">
                <div class="card-body p-0">
                    <div class="row align-items-center">
                        <div class="col-sm-8" id="small-screen-banner">
                            <div class="px-3">
                                <h2 class="text-white display-6">Refer & Earn Rewards</h2>
                                <p class="fs-16 lh-base text-white">Refer Your Friends & Family to Earn Commission. Share your referral code with others and get a 5% commission on every order they make! Share your referral code <span class="fw-semibold">({{ Auth::user()->referral_code }})</span> or your unique referral link and earn rewards!<i class="mdi mdi-arrow-down"></i></p>
                                <div class="mt-3">
                                    <a id="copyReferralLink" class="btn btn-dark">Copy Referral Link</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" id="small-screen-banner">
                            <div class="px-3">
                                <img src="{{asset('user/assets/images/user-illustarator-1.png')}}" class="img-fluid" alt="">
                            </div>
                        </div>
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
            text: 'Copied!',
            duration: 3000,
            gravity: 'top',
            position: 'right',
        }).showToast();
    });
</script>
@endsection