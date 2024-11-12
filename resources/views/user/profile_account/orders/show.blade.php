{{-- @extends('user.profile_account.layouts.master')

@section('content')
 --}}


<div class="dashboard_content">
    <div class="wsus__invoice_area">
        <div class="row d-flex justify-content-center align-items-center h-100">

            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <span class="lead fw-normal">Order code: {{ $order->order_code }}</span>
                                    <span class="text-muted small">Order date: {{ $order->created_at }}</span>
                                </div>
                                
                                <div>

                                @if ($order->status == 'completed')
                                <a href="{{ route('return_order',$order->id) }}"
                                    class="btn btn-outline-danger"
                                    type="button">Return order</a>
                                @endif
                                @if ($order->status == 'pending' || $order->status == 'processing')
                                <a href="{{ route('order_history.cancel', $order->id) }}"
                                    class="btn btn-outline-primary"
                                    type="button">{{ $order->status !== 'canceled' ? 'Cancel order' : 'Cancel reorder' }}</a>
                                @endif
                                </div>
                            </div>
                            <br>
                            @if ($order->status == 'canceled')
                                <h4 style="color: red; text-align: center">Order had been canceled</h4>
                            @else
                                @php
                                    $progress = match ($order->status) {
                                        'pending' => 1,
                                        'processing' => 2,
                                        'shipped' => 3,
                                        'completed' => 4,
                                        'canceled' => 5,
                                        default => 1,
                                    };
                                @endphp
                                <div
                                    class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                    <span class="dot"></span>
                                    <hr class="flex-fill  {{ $progress >= 2 ? 'track-line' : '' }}"><span
                                        class="dot"></span>
                                    <hr class="flex-fill {{ $progress >= 3 ? 'track-line' : '' }}"><span
                                        class="dot"></span>
                                    <hr class="flex-fill {{ $progress >= 4 ? 'track-line' : '' }}">
                                    @if ($progress >= 4)
                                        <span class="d-flex justify-content-center align-items-center big-dot dot">
                                            <i class="fa fa-check text-white"></i></span>
                                    @else
                                        <span class="dot"></span>
                                    @endif

                                </div>

                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="d-flex flex-column align-items-start"><span>Pending</span>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center"><span>Processing</span></div>
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <span>Shipped</span></div>
                                    <div class="d-flex flex-column align-items-center"><span>Completed</span></div>
                                    {{-- <div class="d-flex flex-column align-items-end"><span>Delivered</span></div> --}}
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="wsus__invoice_header">
            <div class="wsus__invoice_content">
                <div class="row">
                    <h4 class="text text-center">Address</h4>
                    <p><strong>Name:</strong> {{ $orderAddress->name }}</p>
                    <p><strong>Phone:</strong> {{ $orderAddress->phone }}</p>
                    <p><strong>Email:</strong> {{ $orderAddress->email }}</p>
                    <p><strong>Province:</strong> {{ $orderAddress->province }}</p>
                    <p><strong>District:</strong> {{ $orderAddress->district }}</p>
                    <p><strong>Ward:</strong> {{ $orderAddress->ward }}</p>
                    <p><strong>Zip:</strong> {{ $orderAddress->zip }}</p>
                    <p><strong>Address Type:</strong> {{ $orderAddress->address_type }}</p>
                    <p><strong>Specific Address:</strong> {{ $orderAddress->specific_address }}</p>

               
                </div>
            </div>
            <h4 class="text text-center">Product</h4>

            <div class="table-responsive">
                <br>
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th class="images">Image</th>
                            <th class="name">Product</th>
                            <th class="amount">Variants</th>
                            <th class="quantity">Quantity</th>
                            <th class="total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderProduct as $product)
                            <tr>
                                <td class="images" style="width: 200px;">
                                    <img src="{{ asset($product->product->thumb_image) }}" alt=""
                                        style="width: 80px; height: auto;">
                                </td>
                                <td class="name">{{ $product->product->name }}</td>
                                <td class="amount">
                                    @php
                                        $product->variants = json_decode($product->variants, true);
                                    @endphp
                                    @foreach ($product->variants as $key => $variant)
                                        <strong>{{ ucfirst($key) }}:</strong> {{ $variant['name'] ?? 'N/A' }}<br>
                                    @endforeach
                                </td>
                                <td class="quantity">{{ $product->quantity }}</td>
                                <td class="total">{{ format_price($product->product_total) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <div class="d-flex justify-content-between">
                <span class="text-muted">Subtotal</span>
                <span>{{ format_price($order->subtotal) }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Discount</span>
                <span>{{ format_price($order->discount) }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total Amount</span>
                <span>{{ format_price($order->total) }}</span>
            </div>
        </div>
    </div>
</div>

{{-- </div>
</section>
@endsection --}}
