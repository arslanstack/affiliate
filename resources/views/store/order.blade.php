@extends('layouts.main')
@section('content')
<!-- page-title -->
<section class="page-title centred">
    <div class="pattern-layer" style="background-image: url(assets/images/background/page-title.jpg);"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Checkout Sucessfull</h1>
            <ul class="bread-crumb clearfix">
                <li><i class="flaticon-home-1"></i><a href="{{route('welcome')}}">Home</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
</section>
<!-- page-title end -->
<!-- checkout-section -->
<section class="checkout-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 left-column">
                <div class="inner-box">
                    <div class="order-info">
                        <h4 class="sub-title">Your Order Details <small>(<span>{{$order->order_number}}</span>)</small></h4>
                        <div class="order-product">
                            <ul class="order-list clearfix">
                                <li class="title clearfix">
                                    <p>Product</p>
                                    <span>Total</span>
                                </li>
                                @foreach($order->items as $item)
                                <li>
                                    <div class="single-box clearfix">
                                        <img src="{{asset('uploads/products/' . get_product_image($item->product_id))}}" alt="">
                                        <h6>{{$item->product_name}} <small><span style="margin-left: 15px;">(${{number_format($item->price, 2)}} x {{$item->quantity}})</span></small></h6>
                                        <span>${{number_format($item->total, 2)}}</span>
                                    </div>
                                </li>
                                @endforeach
                                <li class="sub-total clearfix">
                                    <h6>Status</h6>
                                    <span>
                                        @if($order->status == 0)
                                        <span class="badge badge-info" style="color: black;">Processing</span>
                                        @elseif($order->status == 1)
                                        <span class="badge badge-dark" style="color: white;">In Transit</span>
                                        @elseif($order->status == 2)
                                        <span class="badge badge-success" style="color: white;">Delivered</span>
                                        @elseif($order->status == 3)
                                        <span class="badge badge-danger" style="color: white;">Declined</span>
                                        @endif
                                    </span>
                                </li>
                                <li class="order-total clearfix">
                                    <h6>Total</h6>
                                    <span>${{number_format($order->total, 2)}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- checkout-section end -->
@endsection