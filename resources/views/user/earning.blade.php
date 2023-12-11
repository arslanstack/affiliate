@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Earnings</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Earnings</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Your Recent Commission Based Earnings</h5>
                </div>
                <div class="card-body">
                    <table id="zero-config" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">SR No.</th>
                                <th>Affiliate User</th>
                                <th>Your Level</th>
                                <th>Commission Percentage</th>
                                <th>Commission Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commissions as $key => $commission)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ get_user_name($commission->shopper_id) }}</td>
                                <td>Parent Affiliate Level {{ $commission->commission_level_id }}</td>
                                <td>{{ $commission->commission_percentage }}%</td>
                                <td>${{ $commission->commission_amount }}</td>
                                <td>
                                    @php
                                    $datetime = \Carbon\Carbon::createFromDate($commission->created_at);
                                    echo $datetime->format('d/m/y');
                                    @endphp
                                </td>
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
    new DataTable('#zero-config');
</script>
@endsection