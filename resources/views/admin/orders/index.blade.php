@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{session('success')}}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{session('error')}}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="ibox">
            <div class="ibox-title d-flex justify-content-between align-items-center">
                <h5>Customer Orders</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tickersTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Order Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="ihub-news-records">
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->total }}</td>
                                <td>
                                    @if($order->status == 0)
                                    <span class="badge bg-secondary-subtle text-secondary">Processing</span>
                                    @elseif($order->status == 1)
                                    <span class="badge bg-info">In Transit</span>
                                    @elseif($order->status == 2)
                                    <span class="badge bg-success">Delivered</span>
                                    @elseif($order->status == 3)
                                    <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                    $datetime = \Carbon\Carbon::createFromDate($order->created_at);
                                    echo $datetime->format('d/m/y');
                                    @endphp
                                </td>
                                <td><a target="_blank" href="{{route('admin.order-details', $order->order_number)}}" style="text-decoration: underline;">View Order</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
        });
    });
</script>
@endsection