@extends('user.layouts.master')

@section('content')
    <section id="wsus__cart_view">
        <div class="container">
            <form class="wsus__checkout_form" action="{{ route('checkout.cash_method') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Billing Details
                                @if (Auth::check())
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add new
                                        address</a>
                                @endif
                            </h5>
                            @if (!Auth::check())
                                <div class="row">

                                    <div class="col-md-6 col-lg-12 col-xl-12">
                                        <div class="wsus__check_single_form">
                                            @error('name')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <input type="text" placeholder="Name" name="name">

                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="wsus__check_single_form">
                                            @error('phone')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <input type="text" placeholder="Phone" name="phone">

                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="wsus__check_single_form">
                                            @error('email')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <input type="text" placeholder="Email" name="email">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12 col-xl-4">
                                        <div class="wsus__check_single_form">
                                            @error('province')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <select class="select_2" id="tinh" name="province">
                                                <option value="">Province</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12 col-xl-4">
                                        <div class="wsus__check_single_form">
                                            @error('district')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <select class="select_2" id="quan" name="district">
                                                <option value="">District</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12 col-xl-4">
                                        <div class="wsus__check_single_form">
                                            @error('ward')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <select class="select_2" id="phuong" name="ward">
                                                <option value="">Ward</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="wsus__check_single_form">
                                            @error('zip')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <input type="text" placeholder="Zip *" name="zip">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="wsus__check_single_form">
                                            @error('address_type')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <input type="text" placeholder="Address Type" name="address_type">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12 col-xl-12">
                                        <div class="wsus__check_single_form">
                                            @error('specific_address')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                            <input type="text" placeholder="Specific Address" name="specific_address">

                                        </div>
                                    </div>


                                </div>
                                <br>
                            @endif
                            <div class="row">
                                @if (Auth::check())
                                    @error('shipping_address_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @foreach ($addresser as $address)
                                        <div class="col-xl-6">
                                            <div class="wsus__checkout_single_address">
                                                <div class="form-check">

                                                    <input class="form-check-input shipping_address"
                                                        data-id="{{ $address->id }}" type="radio"
                                                        name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Select Address
                                                    </label>
                                                </div>
                                                <ul>
                                                    <li><span>Name :</span> {{ $address->name }}</li>
                                                    <li><span>Phone :</span> {{ $address->phone }}</li>
                                                    <li><span>Email :</span> {{ $address->email }}</li>
                                                    <li><span>Province :</span> {{ $address->province }}</li>
                                                    <li><span>District :</span> {{ $address->district }}</li>
                                                    <li><span>Ward :</span> {{ $address->ward }}</li>
                                                    <li><span>Zip Code :</span> {{ $address->zip }}</li>
                                                    <li><span>Company :</span> {{ $address->address_type }}</li>
                                                    <li><span>Address :</span> {{ $address->specific_address }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">CheckOut</p>
                            {{-- <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                free shipping
                                <span>(10 - 12 days)</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                express shipping
                                <span>(5 - 10 days)</span>
                            </label>
                        </div> --}}
                            <div class="wsus__order_details_summery">
                                <p><b>product</b> <b></b> <b>quantity</b> <b>Product Total</b></p>
                                @foreach ($checkOutInfo['product_taken'] as $product)
                                    @php
                                        $productCheckout = $products[$product['id']];
                                    @endphp
                                    <p>{{ $productCheckout->name }} <span>{{ $product['qty'] }}</span>
                                        <span>{{ format_price($product['product_total']) }}</span>
                                    </p>
                                @endforeach
                                <hr>
                                <p>subtotal: <span>{{ format_price($checkOutInfo['subtotal']) }}</span></p>
                                {{-- <p>shipping fee: <span>$20.00</span></p> --}}
                                {{-- <p>tax: <span>$00.00</span></p> --}}
                                <p>discount: <span>{{ format_price($checkOutInfo['discount_value']) }}</span></p>
                                <p><b>total:</b> <span><b>{{ format_price($checkOutInfo['total']) }}</b></span></p>
                            </div>
                            <div class="terms_area">
                                <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="">
                                <button type="submit" class="common_btn">Cash on delivery</button>
                            </div>
                            <a href="checkout.html" class="common_btn">Paypal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @if (Auth::check())
        <div class="wsus__popup_address">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>

                        </div>
                        <form action="{{ route('user.address.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="modal-body p-0">
                                <div class="wsus__check_form p-3">
                                    <div class="row">
                                        <div classss="col-md-6">
                                            <div class="wsus__check_single_form">
                                                <input type="text" placeholder="Name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wsus__check_single_form">
                                                <input type="email" placeholder="Email *" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wsus__check_single_form">
                                                <input type="text" placeholder="Phone *" name="phone">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="wsus__check_single_form">
                                                    <select class="select_2" id="tinh" name="province">
                                                        <option value="AL">Province</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="wsus__check_single_form">
                                                    <select class="select_2" id="quan" name="district">
                                                        <option value="AL">District </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="wsus__check_single_form">
                                                    <select class="select_2" id="phuong" name="ward">
                                                        <option value="AL">Ward</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wsus__check_single_form">
                                                <input type="text" placeholder="Zip *" name ="zip">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="wsus__check_single_form">
                                                <input type="text" placeholder="Address Type" name="address_type">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wsus__check_single_form">
                                                <input type="text" placeholder="specific address"
                                                    name="specific_address">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__check_single_form">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
                if (data_tinh.error == 0) {
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        $("#tinh").append('<option value="' + val_tinh.full_name + '">' + val_tinh
                            .full_name + '</option>');
                    });
                    $("#tinh").change(function(e) {
                        var tinh_selected = $(this).val();
                        var idtinh = data_tinh.data.find(tinh => tinh.full_name === tinh_selected)
                            .id;
                        $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(
                            data_quan) {
                            if (data_quan.error == 0) {
                                $("#quan").html('<option value="">District</option>');
                                $("#phuong").html('<option value="">Ward</option>');
                                $.each(data_quan.data, function(key_quan, val_quan) {
                                    $("#quan").append('<option value="' + val_quan
                                        .full_name + '">' + val_quan.full_name +
                                        '</option>');
                                });
                                $("#quan").change(function(e) {
                                    var quan_selected = $(this).val();
                                    var idquan = data_quan.data.find(quan => quan
                                        .full_name === quan_selected).id;
                                    $.getJSON('https://esgoo.net/api-tinhthanh/3/' +
                                        idquan + '.htm',
                                        function(data_phuong) {
                                            if (data_phuong.error == 0) {
                                                $("#phuong").html(
                                                    '<option value="">Ward</option>'
                                                    );
                                                $.each(data_phuong.data,
                                                    function(key_phuong,
                                                        val_phuong) {
                                                        $("#phuong").append(
                                                            '<option value="' +
                                                            val_phuong
                                                            .full_name +
                                                            '">' +
                                                            val_phuong
                                                            .full_name +
                                                            '</option>');
                                                    });
                                            }
                                        });
                                });

                            }
                        });
                    });

                }
            });

            $('input[type="radio"]').prop('checked', false);

            $('.shipping_address').on('click', function() {
                $('#shipping_address_id').val($(this).data('id'));
            });
        });
    </script>
@endsection
