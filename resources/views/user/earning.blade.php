@extends('layouts.app')
@section('content')
<div class="col-lg-12 col-md-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Your Affiliate Earnings</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
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
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Affiliate User</th>
                            <th>Your Level</th>
                            <th>Commission Percentage</th>
                            <th>Commission Amount</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection