@extends('layouts.main')
@section('content')
<section class="page-title centred">
    <div class="pattern-layer" style="background-image: url(assets/images/background/page-title.jpg);"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Affiliate System Shop</h1>
            <ul class="bread-crumb clearfix">
                <li><i class="flaticon-home-1"></i><a href="{{route('welcome')}}">Home</a></li>
                <li>Shop</li>
            </ul>
        </div>
    </div>
</section>

<!-- shop-page-section -->
<section class="shop-page-section shop-page-1">
    <div class="auto-container">
        <div class="our-shop">
            <div class="row clearfix">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 shop-block">
                    <div class="shop-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{asset('uploads/products/' . $product->image)}}" alt="">
                                <ul class="info-list clearfix">
                                    <li>
                                        <a onclick="addToCart(this)" style="cursor: pointer;" data-id="{{$product->id}}" data-quantity="1" id="addCart"><i class="flaticon-shopping-cart-1"></i></a>
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
</section>
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
                        duration: 3000,
                        gravity: 'top',
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