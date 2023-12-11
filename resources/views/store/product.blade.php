@extends('layouts.main')
@section('content')
<!-- page-title -->
<section class="page-title centred">
    <div class="pattern-layer" style="background-image: url(assets/images/background/page-title.jpg);"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{$product->name}}</h1>
            <ul class="bread-crumb clearfix">
                <li><i class="flaticon-home-1"></i><a href="{{route('welcome')}}">Home</a></li>
                <li>Product Details</li>
            </ul>
        </div>
    </div>
</section>
<!-- page-title end -->

<!-- product-details -->
<section class="product-details product-details-1">
    <div class="auto-container">
        <div class="product-details-content">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <figure class="product-image">
                        <img src="{{asset('uploads/products/' . $product->image)}}" alt="">
                        <a href="{{asset('uploads/products/' . $product->image)}}" class="lightbox-image"><i class="flaticon-search-2"></i></a>
                    </figure>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="product-info">
                        <h3>{{$product->name}}</h3>
                        <div class="customer-review clearfix">
                            <ul class="rating-box clearfix">
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                            </ul>
                            <div class="reviews"><a href="{{route('welcome')}}">(5 Reviews)</a></div>
                        </div>
                        <span class="item-price">${{$product->price}}</span>
                        <div class="text">
                            <p>{{$product->short_description}}</p>
                        </div>
                        <form action="{{route('simple-cart-store')}}" method="post">
                            @csrf
                            <input type="text" name="id" value="{{$product->id}}" hidden>
                            <div class="othre-options clearfix">
                                <div class="item-quantity"> 
                                    <input class="quantity-spinner" type="text" value="1" name="quantity" onchange="validateQuantity(this)">
                                </div>
                                <div class="btn-box"><button type="submit" class="theme-btn-two">Add to cart</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-discription">
            <div class="tabs-box">
                <div class="tab-btn-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1">Description</li>
                        <li class="tab-btn" data-tab="#tab-2">Reviews(1)</li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">
                        <div class="text">
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                    <div class="tab" id="tab-2">
                        <div class="review-box">
                            <h5>1 Review for Multi-Way Ultra Crop Top</h5>
                            <div class="review-inner">
                                <figure class="image-box"><img src="{{asset('assets/images/resource/review-1.png')}}" alt=""></figure>
                                <div class="inner">
                                    <ul class="rating clearfix">
                                        <li><i class="flaticon-star"></i></li>
                                        <li><i class="flaticon-star"></i></li>
                                        <li><i class="flaticon-star"></i></li>
                                        <li><i class="flaticon-star"></i></li>
                                        <li><i class="flaticon-star-1"></i></li>
                                    </ul>
                                    <h6>Eileen Alene <span>- May 1, 2020</span></h6>
                                    <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim est laborum. Sed perspiciatis unde omnis natus error sit voluptatem accusa dolore mque laudant totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi arch tecto beatae vitae dicta.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
     function validateQuantity(input) {
        const currentValue = parseInt(input.value, 10);
        if (currentValue < 1 || isNaN(currentValue)) {
            input.value = 1;
        }
    }
</script>

@endsection