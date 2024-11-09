@extends('user.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"> 
            @include('user.dashboard.orders.show')
        </div>
    </div>
</div>

@endsection
