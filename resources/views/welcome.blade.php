@extends('layouts.main')
@section('content')

<!-- banner-section -->
<section class="banner-style-three alternet-2">
    <div class="large-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 carousel-column">
                <div class="carousel-content">
                    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
                        <div class="slide-item" style="background-image: url('assets/images/resource/slider-bg-9.jpg');">
                            <div class="pattern-layer" style="background-image: url('assets/images/shape/shape-8.png');"></div>
                            <div class="content-box">
                                <h1>Discover & Shop The Trend</h1>
                                <p>New Modern Stylist Fashionable Men's Wear Jeans Shirt.</p>
                                <div class="btn-box">
                                    <a href="{{route('shop')}}">Explore Now<i class="flaticon-right-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="slide-item" style="background-image: url('assets/images/resource/slider-bg-9.jpg');">
                            <div class="pattern-layer" style="background-image: url('assets/images/shape/shape-8.png');"></div>
                            <div class="content-box">
                                <h1>Discover & Shop The Trend</h1>
                                <p>New Modern Stylist Fashionable Men's Wear Jeans Shirt.</p>
                                <div class="btn-box">
                                    <a href="{{route('shop')}}">Explore Now<i class="flaticon-right-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="slide-item" style="background-image: url('assets/images/resource/slider-bg-9.jpg');">
                            <div class="pattern-layer" style="background-image: url('assets/images/shape/shape-8.png');"></div>
                            <div class="content-box">
                                <h1>Discover & Shop The Trend</h1>
                                <p>New Modern Stylist Fashionable Men's Wear Jeans Shirt.</p>
                                <div class="btn-box">
                                    <a href="{{route('shop')}}">Explore Now<i class="flaticon-right-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 inner-column">
                <div class="inner-box">
                    <div class="single-item">
                        <figure class="image-box"><img src="{{asset('assets/images/resource/clock-1.png')}}" alt=""></figure>
                        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-9.png);"></div>
                        <div class="inner centred">
                            <h3>Get 25% Off</h3>
                            <p>Table Clock</p>
                        </div>
                    </div>
                    <div class="single-item">
                        <figure class="image-box"><img src="{{asset('assets/images/resource/phone-1.png')}}" alt=""></figure>
                        <div class="pattern-layer"></div>
                        <div class="inner">
                            <h3>Samsung Galaxy</h3>
                            <a href="{{route('shop')}}">Shop Now<i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner-section end -->


<!-- service-style-three -->
<section class="service-style-three">
    <div class="large-container">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-truck"></i></div>
                        <h3><a href="{{route('welcome')}}">Free Shipping</a></h3>
                        <p>Free shipping on oder over $100</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-credit-card"></i></div>
                        <h3><a href="{{route('welcome')}}">Secure Payment</a></h3>
                        <p>We ensure secure payment with PEV</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-24-7"></i></div>
                        <h3><a href="{{route('welcome')}}">Support 24/7</a></h3>
                        <p>Contact us 24 hours a day, 7 days a week</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-undo"></i></div>
                        <h3><a href="{{route('welcome')}}">30 Days Return</a></h3>
                        <p>Simply return it within 30 days for an exchange.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- service-style-three end -->


<!-- shop-style-three -->
<section class="shop-style-three">
    <div class="large-container">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-12 col-sm-12 advice-column">
                <div class="advice-block wow fadeInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="advice-box centred gray-bg">
                        <h3>Summer 2020</h3>
                        <h2>Exclusive Discount</h2>
                        <div class="price"><span><del>$89.00</del> $49.00</span></div>
                        <figure class="image-box"><img src="{{asset('assets/images/resource/headphone-1.png')}}" alt=""></figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 shop-column">
                <div class="shop-inner">
                    <div class="tabs-box">
                        <div class="tab-btn-box clearfix">
                            <h2>Top Selling Items</h2>
                        </div>
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="row clearfix">
                                    @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                        <div class="shop-block-three">
                                            <div class="inner-box">
                                                <figure class="image-box">
                                                    <img src="{{asset('uploads/products/' . $product->image)}}" alt="">
                                                    <span class="category">New</span>
                                                    <ul class="info-list clearfix">
                                                        <li>
                                                            <!-- make an ajax request to add to cart -->
                                                            <a onclick="addToCart(this)" style="cursor: pointer;" data-id="{{$product->id}}" data-quantity="1" id="addCart">
                                                                <i class="flaticon-shopping-cart-1"></i>
                                                            </a>
                                                            <span>Add to cart</span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                                <div class="lower-content">
                                                    <a href="{{route('product', $product->slug)}}">{{$product->name}}</a>
                                                    <span class="price">${{$product->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop-style-three -->


<!-- deals-style-two -->
<section class="deals-style-two">
    <div class="large-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 single-column">
                <div class="single-item wow fadeInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset('assets/images/resource/headphone-2.png')}}" alt=""></figure>
                        <h4>Deal of the day</h4>
                        <h2>Color Headphone</h2>
                        <div class="price"><span><del>$89.00</del> $49.00</span></div>
                        <div class="timer">
                            <div class="cs-countdown" data-countdown="05/24/2024 05:06:59"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 single-column">
                <div class="single-item wow fadeInRight animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset('assets/images/resource/phone-2.png')}}" alt=""></figure>
                        <h4>Deal of the day</h4>
                        <h2>Mobile Phones</h2>
                        <div class="price"><span><del>$99.00</del> $79.00</span></div>
                        <div class="timer">
                            <div class="cs-countdown" data-countdown="05/24/2024 05:06:59"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- deals-style-two end -->


<!-- cta-section -->
<section class="cta-section alternet-2" style="margin-top:120px;">
    <div class="image-layer" style="background-image: url('assets/images/background/cta-bg-3.jpg');"></div>
    <div class="auto-container">
        <div class="cta-inner centred">
            <h2>Sale Upto 50% Off</h2>
            <p>Welcome to the new range of shaving products from master barber. We have over three decades of experience in the male grooming industry</p>
            <a href="{{route('shop')}}" class="theme-btn-one">Shop Now<i class="flaticon-right-1"></i></a>
        </div>
    </div>
</section>
<!-- cta-section end -->


<!-- instagram-style-two -->
<section class="instagram-style-two sec-pad">
    <div class="large-container">
        <div class="sec-title">
            <h2>Follow Us On Instagram</h2>
            <p>Excepteur sint occaecat cupidatat</p>
            <span class="separator" style="background-image: url('assets/images/icons/separator-1.png');"></span>
        </div>
        <div class="instagram-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
            <figure class="image-box">
                <img src="{{asset('assets/images/resource/instagram-7.jpg')}}" alt="">
                <ul class="info-list clearfix">
                    <li><a href=""><i class="flaticon-heart"></i>400</a></li>
                    <li><a href=""><i class="flaticon-commentary"></i>300</a></li>
                </ul>
            </figure>
            <figure class="image-box">
                <img src="{{asset('assets/images/resource/instagram-8.jpg')}}" alt="">
                <ul class="info-list clearfix">
                    <li><a href=""><i class="flaticon-heart"></i>450</a></li>
                    <li><a href=""><i class="flaticon-commentary"></i>100</a></li>
                </ul>
            </figure>
            <figure class="image-box">
                <img src="{{asset('assets/images/resource/instagram-9.jpg')}}" alt="">
                <ul class="info-list clearfix">
                    <li><a href=""><i class="flaticon-heart"></i>330</a></li>
                    <li><a href=""><i class="flaticon-commentary"></i>300</a></li>
                </ul>
            </figure>
            <figure class="image-box">
                <img src="{{asset('assets/images/resource/instagram-10.jpg')}}" alt="">
                <ul class="info-list clearfix">
                    <li><a href=""><i class="flaticon-heart"></i>250</a></li>
                    <li><a href=""><i class="flaticon-commentary"></i>320</a></li>
                </ul>
            </figure>
        </div>
    </div>
</section>
<!-- instagram-style-two -->
<script>
    function addToCart(element) {
        var id = $(element).data('id');
        var quantity = $(element).data('quantity');

        $.ajax({
            url: "{{route('cart-store')}}",
            method: "POST",
            data: {
                id: id,
                quantity: quantity,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                if (data.success) {
                    // Show success notification
                    Toastify({
                        text: 'Product added to cart successfully, Click to see the cart!',
                        duration: 3000,
                        gravity: 'bottom', // 'top' or 'bottom'
                        position: 'right', // 'left', 'center', or 'right'
                        backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc371)',
                        onClick: function() {
                            window.location.href = "{{ route('cart') }}";
                        }
                    }).showToast();
                } else {
                    // Show error notification
                    Toastify({
                        text: 'Something went wrong',
                        duration: 1000,
                        gravity: 'bottom',
                        position: 'right',
                        backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc371)',
                    }).showToast();
                }
                $('#item-count').text(data.items);
            },
            error: function() {
                alert('Error in the AJAX request');
            }
        });
    }
</script>

@endsection