@extends('admin.layouts.master')


@section('content')

<div class="container mt-4">
    <h2 class="text-center mb-4">Point of Sale (POS)</h2>

    <!-- Card for displaying products -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Products</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @php
                    $showProduct = [];
                
                    if ($flashSaleProduct != null) {
                        foreach ($flashSaleProduct as $item) {
                            $item->is_flash_sale = true;
                            $item->discount = $flashSale->discount;
                            $item->discount_price = discount_price($item->price,$flashSale->discount);
                            $showProduct[] = $item; 
                        }
                    }
                
                    foreach ($products as $item) {
                        $item->is_flash_sale = false;
                        $showProduct[] = $item; 
                    }
                @endphp
                @foreach ($showProduct as $product)
                
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <form action="{{ route('admin.pos.addToPOS') }}" method="POST">
                            @csrf
                        <img src="{{ asset($product->thumb_image) }}" class="card-img-top" alt="asdasd">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="row">
                                @foreach ($product->productVariant as $variant)
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3 ">
                                        <p class="mb-2"><strong>{{ $variant->name }}:</strong></p>
                                        <select class="form-select" style="width: 120px; height: 30px; font-size: 14px; line-height: 1;" name="variants[]">
                                            @foreach ($variant->variantItems as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <strong style="font-size:17px">Quantity:</strong>
                                </div>
                                <div class="col">
                                    <input style="width: 100%;" class="form-control" type="number" min="1" max="100" name="qty" />
                                </div>
                            </div>
                            @if ($product->is_flash_sale)
                                <h5 class="card-text"><del style="color: red">{{ format_price($product->price) }}</del>
                                    {{ format_price($product->discount_price) }}</h5>
                            @else
                                <h5 class="card-text">{{ format_price($product->price) }}</h5>
                            @endif
                                <input type="hidden" name="product_id" value="{{$product->id}}">

                                <button type="submit" class="btn btn-primary w-100">Add Prouct</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                   
            </div>
        </div>
    </div>

    <!-- Cart Section -->
    <div class="card">
        <div class="card-header">
            <h4>Total Table</h4>
        </div>
        <div class="card-body">
            @if (isset($pos['product']) )
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Variants</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                       @foreach ($pos['product'] as $product)
                       <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>
                            @foreach ($product['variants'] as $key => $variantItems)
                                <p>{{ $key }} : {{ implode(', ', $variantItems) }}</p>
                            @endforeach
                        </td>
                        <td>{{ format_price($product['price']) }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ format_price($product['product_total']) }}</td>
                        <td>
                            <form action="{{ route('admin.pos.removeFromPOS',$product['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                       @endforeach
                       
                </tbody>
            </table>
            <br>
            <div class="text-start">
                <h5>Total: {{ format_price($pos['total']) }}</h5>
                <div class=" mb-3">
                    <br>
                    <form action="{{ route('admin.pos.checkout') }}" method="POST">
                    @csrf
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control " name="amount_paid" placeholder="Amount Paid" >
                    </div>
                </div>
            </div>
        
            </div>
                <div class="card-footer text-end">
            
                @csrf
                <input type="hidden" name="customer_id" value="asdasd">
                <input type="hidden" name="total" value="asdasd">
                <button type="submit" class="btn btn-success">Complete Order</button>
            </form>
        </div>
        @else
                <h3 class="text-center">Please add product first</h3>
        @endif

        
    </div>
</div>
@endsection
