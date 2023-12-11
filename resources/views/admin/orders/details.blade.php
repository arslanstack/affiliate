@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title d-flex justify-content-between align-items-center">
                <h5>Order Details ({{$order->order_number}})</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tickersTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="ihub-news-records">
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><img src="{{asset('uploads/products/' . get_product_image($item->product_id))}}" style="width:24px; height: 24px; border-radius: 100px; margin-right:12px;" alt="">{{ $item->product_name }}</td>
                                <td>${{number_format($item->price, 2)}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>${{number_format($item->total, 2)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center"><b>Order Total</b></td>
                                <td><b>${{number_format($order->total, 2)}}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title d-flex justify-content-between align-items-center">
                <h5>Affiliate Commission Details</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tickersTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Affiliate Level</th>
                                <th>Percentage</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="ihub-news-records">
                            @foreach($commissions as $commission)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><img src="{{asset('uploads/profile/' . (get_user_image($commission->user_id) ? get_user_image($commission->user_id)  : 'avatar.jpg'))}}" style="width:24px; height: 24px; border-radius: 100px; margin-right:12px;" alt="">{{ get_user_name($commission->user_id) }}</td>
                                <td>Parent Level {{$commission->commission_level_id}}</td>
                                <td>{{$commission->commission_percentage}}</td>
                                <td>${{$commission->commission_amount}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection