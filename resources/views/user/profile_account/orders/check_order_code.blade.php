@extends('user.layouts.master')

@section('content')
<section id="wsus__login_register">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 m-auto">
                <div class="wsus__forget_area">
                    <h4>Copy your order code here</h4>
                    <div class="wsus__login">
                        <form action="{{ route('order_history.show') }}" method="GET">
                            @csrf
                            <div class="wsus__login_input">
                                <input type="text" name="order_code">
                            </div>
                            <button class="common_btn" type="submit">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection