@extends('layouts.app')

@section('content')

<div class="col-lg-12 col-md-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Your Referral Tree</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area pt-4">
            {!! tree_builder(Auth::id())!!}
        </div>
    </div>
</div>
@endsection