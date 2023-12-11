@extends('layouts.main')
@section('content')
<!-- page-title -->
<section class="page-title centred">
    <div class="pattern-layer" style="background-image: url(assets/images/background/page-title.jpg);"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Cart</h1>
            <ul class="bread-crumb clearfix">
                <li><i class="flaticon-home-1"></i><a href="{{ route('welcome') }}">Home</a></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
</section>
<!-- page-title end -->
<!-- cart section -->
<section class="cart-section cart-page">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                <div class="table-outer">
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th>&nbsp;</th>
                                <th class="prod-column">Product Name</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th class="price">Price</th>
                                <th class="quantity">Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <tr>
                                <td colspan="4" class="prod-column">
                                    <div class="column-box">
                                        <div class="remove-btn" data-id="{{ $cart['id'] }}">
                                            <i class="flaticon-close"></i>
                                        </div>
                                        <div class="prod-thumb">
                                            <a href="{{route('product', get_product_slug($cart['product_id']))}}" target="_blank"><img src="{{ asset('uploads/products/' . get_product_image($cart['product_id'])) }}" alt=""></a>
                                        </div>
                                        <div class="prod-title">
                                            {{ get_product_name($cart['product_id']) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="price">${{ get_product_price($cart['product_id']) }}</td>
                                <td class="qty">
                                    <div class="item-quantity">
                                        <!-- Add data-id and data-product-id attributes to store cart item id and product id -->
                                        <input class="quantity-spinner" type="text" value="{{ $cart['quantity'] }}" onchange="updateTable(this)" name="quantity" data-id="{{ $cart['id'] }}" data-product-id="{{ $cart['product_id'] }}">
                                    </div>
                                </td>
                                <td class="sub-total" id="subtotal_{{ $cart['id'] }}">
                                    ${{ get_product_subtotal($cart['product_id'], $cart['quantity']) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="othre-content clearfix">
            <div class="coupon-box pull-left clearfix">
                <a href="{{route('shop')}}" class="theme-btn-two">Continue Exploring More Items<i class="flaticon-left-2"></i></a>
            </div>
        </div>
        <div class="cart-total">
            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12 offset-xl-7 cart-column">
                    <div class="total-cart-box clearfix">
                        <h4>Cart Totals</h4>
                        <ul class="list clearfix">
                            <li>Subtotal:<span id="orderSubTotal">${{ get_total($carts) }}</span></li>
                            <li>Order Total:<span id="orderTotal">${{ get_total($carts) }}</span></li>
                        </ul>
                        <a href="{{route('checkout')}}" class="theme-btn-two">Proceed to Checkout<i class="flaticon-right-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-btn');
        removeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const cartItemId = btn.getAttribute('data-id');
                const url = `/remove-cart-item/${cartItemId}`;
                fetch(url, {
                        method: 'GET',
                    })
                    .then(response => response.json())
                    .then(data => {
                        const subtotalElement = document.getElementById(`subtotal_${cartItemId}`);
                        if (subtotalElement) {
                            subtotalElement.innerHTML = `$${data.subtotal}`;
                        }

                        const orderTotalElement = document.getElementById('orderTotal');
                        orderTotalElement.textContent = `$${data.total}`;
                        document.getElementById('orderSubTotal').textContent = `$${data.total}`;

                        const tableRow = btn.closest('tr');
                        if (tableRow) {
                            tableRow.remove();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    });
</script>

<script>
    function updateTable(changedQuantityInput) {
        const newQuantity = changedQuantityInput.value;
        const cartItemId = changedQuantityInput.getAttribute('data-id');
        const productId = changedQuantityInput.getAttribute('data-product-id');

        if (newQuantity < 1) {
            changedQuantityInput.value = 1;
            return; // Do not proceed further if the value is less than 1
        }
        const url = `/update-cart/${cartItemId}/${newQuantity}`;
        fetch(url, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                const subtotalElement = document.getElementById(`subtotal_${cartItemId}`);
                console.log(subtotalElement);
                if (subtotalElement) {
                    subtotalElement.innerHTML = `$${data.subtotal}`;
                } else {
                    console.error(`Element with ID subtotal_${cartItemId} not found`);
                }
                const orderTotalElement = document.getElementById('orderTotal');
                orderTotalElement.textContent = `$${data.total}`;
                document.getElementById('orderSubTotal').textContent = `$${data.total}`;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
@endsection