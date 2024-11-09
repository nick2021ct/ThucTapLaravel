@extends('user.dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
       @include('user.dashboard.orders.show');
    </div>
</div>
    </div>
</section>
@endsection