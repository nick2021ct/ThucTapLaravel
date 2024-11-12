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
                        <h4>Order Return</h4>
                    
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.order_return.index') }}">
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
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Total refund</th>
                                    <th scope="col">Return reason</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_return as $order)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $order->id }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ format_price($order->total_refund) }}</td>
                                    <td>{{ $order->return_reason }}</td>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <select class="change_status form-select" name="status" style="width: 75%;"  data-id="{{ $order->id }}">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Accepted</option>                                                                            
                                            <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </td>
                                   
                                    <td>
                                        <a href="{{ route('admin.order.detail',$order->order->id) }}" class="btn btn-primary">Detail</a>
                                        <form action="{{ route('admin.order.destroy', $order->order->id) }}" method="POST" style="display:inline;">
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
                                @if ($order_return->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $order_return->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $order_return->lastPage(); $i++)
                                    <li class="page-item {{ $i == $order_return->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $order_return->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($order_return->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $order_return->nextPageUrl() }}" aria-label="Next">
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

            $('.change_status').on('change',function(){
                var orderId = $(this).data('id'); 
                var status = $(this).val();

                $.ajax({
                    url: "{{ route('admin.order_return.change_status', ':id') }}".replace(':id', orderId),
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

