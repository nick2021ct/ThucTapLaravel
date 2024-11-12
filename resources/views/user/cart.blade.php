@extends('user.layouts.master')

@section('content')

<section id="wsus__cart_view">
    <div class="container">
        <div class="row">
            <div class="col-xl-9">
                <div class="wsus__cart_list">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-1">Take</th>
                                    <th class="col-2">Product Image</th>
                                    <th class="col-3">Product</th>
                                    <th class="col-2">Status</th>
                                    <th class="col-2">Quantity</th>
                                    <th class="col-1">Total</th>
                                    <th class="col-1">
                                        <a href="{{ route('cart.remove_all_cart') }}" class="btn btn-primary">Clear Cart</a>
                                    </th>
                                </tr>
                                @foreach ($carts as $cart)
                                <tr class="d-flex">
                                    <td class="col-1"><input type="checkbox" class="product-checkbox" data-rowid="{{ $cart->rowId }}"></td>
                                    <td class="col-2">
                                        <img src="{{ asset($cart->options->image) }}" alt="product" class="img-fluid w-50">
                                    </td>
                                    <td class="col-3">
                                        <h7>{{ $cart->name }}</h7>
                                        
                                        @if ($cart->options->variants != null)
                                            @foreach ($cart->options->variants as $key => $variant)
                                                <span>{{ $key }}: {{ $variant['name'] }}</span><br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="col-2">
                                        @if ($cart->options->stock > 0)
                                            <p>In Stock</p>
                                        @else
                                            <p style="color: red">Out of Stock</p>
                                        @endif
                                    </td>
                                    <td class="col-2">
                                        <div class="product_qty_wrapper d-flex align-items-center">
                                            <button class="btn btn-primary btn-sm product-decrement" type="button">-</button>
                                            <input class="product-qty form-control form-control-sm mx-1" type="number" min="1" max="{{ $cart->options->stock }}" data-stock="{{ $cart->options->stock }}" data-rowid="{{ $cart->rowId }}" value="{{ $cart->qty }}" readonly />
                                            <button class="btn btn-primary btn-sm product-increment" type="button">+</button>
                                        </div>
                                    </td>
                                    <td class="col-1">
                                        <h6 id="{{ $cart->rowId }}">${{ $cart->options->total }}</h6>
                                    </td>
                                    <td class="col-1">
                                        {{-- <a href="{{ route('cart.remove_cart', $cart->rowId) }}" ><i class="far fa-times"></i></a> --}}

                                        <button style="border:0ch; background-color: white" class="delete_cart" data-rowid="{{ $cart->rowId }}"><i class="far fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                    <h6>total cart</h6>
                    <p>subtotal: <span id="subtotal">{{ format_price(0) }}</span></p>
                    <p>discount: <span id="discount">{{ format_price(0) }}</span></p>
                    <p class="total"><span>total:</span> <span id="cart_total">{{ format_price(0) }}</span></p>

                    <form id="coupon_form">
                        <input type="text" placeholder="Coupon Code" name="coupon_code">
                        <button type="submit" class="common_btn">apply</button>
                    </form>
                    <button class="checkout_button common_btn mt-4 w-100 text-center" >checkout</button>
                    <button class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                            class="fab fa-shopify"></i> go shop</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.product-increment').on('click',function(){
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                let stock = parseInt(input.data('stock')); 

                if( quantity >stock ){
                    quantity = stock;
                }
                
                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update_quantity') }}",
                    method: "POST",
                    data:{
                        rowId:rowId,
                        quantity:quantity
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            let productId = '#'+rowId;
                            $(productId).text('$'+data.product_total);
                            getCartTotal()
                        }else if(data.status=='error'){
                            toastr.error(data.message,'Error')
                        }
                        
                      
                    }
                })
            });

            
            $('.delete_cart').on('click', function() {
                let rowId = $(this).data('rowid');
        
                $.ajax({
                    url: "{{ route('cart.remove_cart', ':rowId') }}".replace(':rowId', rowId), 
                    method: "POST",
                    data:{
                        rowId:rowId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            window.location.reload();
                        }else if(data.status=='error'){
                            toastr.error(data.message)
                        }
                    }
                })
            });


            $('.product-decrement').on('click',function(){
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');
                if(quantity < 1){
                    quantity = 1;
                }
                
                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update_quantity') }}",
                    method: "POST",
                    data:{
                        rowId:rowId,
                        quantity:quantity
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            let productId = '#'+rowId;
                            $(productId).text('$'+data.product_total);
                            getCartTotal()
                        }else if(data.status=='error'){
                            toastr.error(data.message)
                        }
                     
                    }
                })
            });

            $('#coupon_form').on('submit',function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                    url: "{{ route('cart.apply_coupon') }}",
                    method: "GET",
                    data: formData,
                    success: function(data) {
                        if(data.status == 'success'){
                            toastr.success(data.message,'Success');
                            getCartTotal();
                        }else if(data.status == 'error'){
                            toastr.error(data.message,'Error');
                            getCartTotal();
                        }
                        
                    }
                });
        });

            function getCartTotal() {
                let rowIds = [];

                $('.product-checkbox:checked').each(function() {
                    rowIds.push($(this).data('rowid'));
                });

                $.ajax({
                    url: "{{ route('cart.get_cart_total') }}",
                    method: "POST",
                    data: {
                        rowIds: rowIds
                    },
                    success: function(data) {
                        $('#subtotal').text(data.subtotal);
                        $('#discount').text(data.discount_value);
                        $('#cart_total').text(data.cart_total);
                    }
                });
            }

            $(document).on('change', '.product-checkbox', function() {
                getCartTotal();
            });

            $(document).on('click', '.checkout_button', function() {
                let rowIds = [];
                $('.product-checkbox:checked').each(function() {
                    rowIds.push($(this).data('rowid'));
                });

                $.ajax({
                    url: "{{ route('cart.save_checkout_session') }}",
                    method: "POST",
                    data: { rowIds: rowIds },
                    success: function(data) {
                        if (data.status == 'success') {
                            window.location.href = "{{ route('checkout.index') }}";
                        } else {
                            toastr.error(data.message, 'Error');
                        }
                    }
                });
            });

        
        });

      
    </script>
@endsection