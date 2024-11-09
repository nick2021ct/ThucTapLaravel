@extends('admin.layouts.master')


@section('content')
<div class="page-body">
    <div class="container-fluid">
      <div class="row page-title">
        <div class="col-sm-6">
          <h3>Bootstrap Basic Tables</h3>
        </div>
        
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid table-space basic_table">
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" >
                        <h4>Order</h4>
                    
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.order.index') }}">
                            <div class="mb-3 d-flex ">
                                <div style="width: 10px"></div>
                                <input type="text" class="form-control  me-2" id="searchInput" placeholder="Search..." style="width: 30%;" name="search">
                                <button class="btn btn-primary " type="submit">Search</button>
                            </div>
                        </form>
                        <table class="table text-center">
                            <thead>
                                <tr class="b-b-primary">
                                    <th scope="col">Id</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? null }}</td>
                                    <td>{{ format_price($order->subtotal) }}</td>
                                    <td>{{ format_price($order->discount) }}</td>
                                    <td>{{ format_price($order->total) }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <select class="form-select" name="status" style="width: 65%;" id="order_status" data-order-id="{{ $order->id }}">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>                                                                            
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </td>
                                   
                                    <td>
                                        <a href="{{ route('admin.order.detail',$order->id) }}" class="btn btn-primary">Detail</a>
                                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>
                        <br>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if ($orders->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $orders->lastPage(); $i++)
                                    <li class="page-item {{ $i == $orders->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($orders->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
  </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#order_status').on('change',function(){
                var orderId = $(this).data('order-id'); 
                var status = $(this).val();

                $.ajax({
                    url: "{{ route('admin.order.change_order_status', ':id') }}".replace(':id', orderId),
                    type: 'PUT',
                    data: {status: status},
                    success: function(data){
                        if(data.status == 'success'){
                            toastr.success(data.message,'Success');
                        }else if(data.status == 'error'){
                            toastr.error(data.message,'Error');
                        }

                    }
                })
            })
        })
    </script>
@endsection

