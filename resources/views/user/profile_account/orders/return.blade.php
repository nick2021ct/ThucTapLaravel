@extends('user.layouts.master')

@section('content')
<div class="container my-5">
    <h3>Return Products</h3>
    <p>Please select the product(s) you want to return.</p>

    <div class="card mb-4">
        <div class="card-header">
            <h4>Available Products</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="productList">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Variants</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderProduct as $product)
                    @php
                    $pricePerProduct = $product->product_total / $product->quantity
                    @endphp
                    <tr class="text-center">
                        <form action="{{ route('return_order.select_product',$product->id) }}" method="POST">
                            @csrf
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product->name }}</td>
                            <td>{{ format_price($pricePerProduct) }}</td>
                            <td>
                                @php
                            $product->variants = json_decode($product->variants, true);
                            @endphp
                            @foreach ($product->variants as $key => $variant)
                                <strong>{{ ucfirst($key) }}:</strong> {{ $variant['name'] ?? 'N/A' }}<br>
                            @endforeach
                            </td>
                            <td>
                                <input type="number" style="width: 60px; text-align: center" value="1" name="quantity" min="1" max="{{ $product->quantity }}"/>/{{ $product->quantity }}
                            </td>
                            <td>{{ format_price($product->product_total) }}</td>
                            <td>
                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                <input type="hidden" name="price" value="{{ $pricePerProduct }}">
                                <button type="submit" class="btn btn-sm btn-primary select-product">Select</button>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (!empty($order_return_info['product']))
    <div class="row">
    <div class="card col-md-8">
        <div class="card-header">
            <h4>Selected Products for Return</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="selectedProducts">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Product Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_return_info['product'] as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ format_price($product['price']) }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['product_total'] }}</td>
                        <td><a class="btn btn-danger" href="{{ route('return_order.unselect_product',$product['product_id']) }}">Delete</a></td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
            <form action="{{ route('return_order.submit_return',$order->id) }}" method="post">
                @csrf
            <div class="mb-3">
                <label for="reason" class="form-label">Reason for Return</label>
                <textarea id="reason" name="return_reason" class="form-control" rows="4" placeholder="Please provide a reason for returning the product(s)." required></textarea>
            </div>
            @error('return_reason')
                <span style="color: red">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn btn-danger">Submit Return</button>
        </form>
        </div>
    </div>
    <div class="card col-md-4">
        <div class="card-header">
            <h4>Return Information</h4>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $orderAddress->name }}</p>
            <p><strong>Address type: </strong>{{ $orderAddress->address_type }}</p>
            <p><strong>Address:</strong> {{ $orderAddress->province }}, {{ $orderAddress->district }}, {{ $orderAddress->ward }}</p>
            <p><strong>Specific Address: </strong>{{ $orderAddress->specific_address }}</p>
            <hr>
            <h6>Total refund: {{ format_price($order_return_info['total_refund']) }}</h6>

        </div>
    </div>
</div>
    @else
    <h3 class="text-center">Please select at least 1 product</h3>
    @endif
    
</div>
@endsection