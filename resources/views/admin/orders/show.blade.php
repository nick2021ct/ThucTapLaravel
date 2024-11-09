@extends('admin.layouts.master')


@section('content')
<div class="page-body">
    <div class="container-fluid">
      <div class="row page-title">
        <div class="col-sm-6">
          <h3>Order Detail</h3>
        </div>
        
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid table-space basic_table">
      <div class="col-sm-12">
        <div class="card col-sm-12">
          <div class="card-header d-flex justify-content-between align-items-center" >
            <h5><strong>Order code:</strong> {{ $order->order_code }}</h5>
        </div>
        
        </div>
      </div>

        <div class="row"> 
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" >
                        <h4>Order Address</h4>
                    </div>

                    <div class="card-body checkbox-checked">
                        <div class="row">
                            <form action="{{ route('admin.order.change_order_address',$orderAddress->order_id) }}" method="POST">
                              @csrf
                              @method('PUT')
                                <div class="mb-3 ">
                                  <label for="inputEmail4">Name</label>
                                  <input class="form-control" id="inputEmail4" type="text" value="{{ $orderAddress->name }}" name="name">
                                </div>
                              <div class="row">
                                <div class="mb-3 col-sm-6">
                                  <label for="inputEmail5">Phone</label>
                                  <input class="form-control" id="inputEmail5" type="text" value="{{ $orderAddress->phone }}" name="phone">
                                </div>
                                <div class="mb-3 col-sm-6">
                                  <label for="inputPassword7">Email Address</label>
                                  <input class="form-control" id="inputPassword7" type="text" value="{{ $orderAddress->email }}" name="email">
                                </div>
                              </div>
                              <div class="row">
                                <div class="mb-3 col-sm-4">
                                    <label for="inputState">Province</label>
                                    <input class="form-control" id="inputEmail4" type="text" value="{{ $orderAddress->province }}" name="province">

                                  
                                  </div>
                                  <div class="mb-3 col-sm-4">
                                    <label for="inputState">District</label>
                                    <input class="form-control" id="inputEmail4" type="text" value="{{ $orderAddress->district }}" name="district">

                                   
                                  </div>
                                  <div class="mb-3 col-sm-4">
                                    <label for="inputState">Ward</label>
                                    <input class="form-control" id="inputEmail4" type="text" value="{{ $orderAddress->ward }}" name="ward">

                                  </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-6">
                                    <label for="inputAddress5">Zip</label>
                                    <input class="form-control" id="inputAddress5" type="text" value="{{ $orderAddress->zip }}" name="zip">
                                  </div>
                                  <div class="mb-3 col-sm-6">
                                    <label for="inputCity">Address Type</label>
                                    <input class="form-control" id="inputCity" type="text" value="{{ $orderAddress->address_type }}" name="address_type">
                                  </div>
                            </div>
                             
                              <div class="mb-3">
                                <label for="inputAddress2">specific Address</label>
                                <input class="form-control" id="inputAddress2" type="text" value="{{ $orderAddress->specific_address }}" name="specific_address">
                              </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Change Address</button>
                            </div>
                            </form>
                          </div>
                         
                        </div>
                </div>
            </div>

            
            <div class="col-sm-12">
                 
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" >
                        <h4>Order Product</h4>
                    
                    </div>
                    <div class="table-responsive">
                      
                        <table class="table text-center">
                            <thead>
                                <tr class="b-b-primary">
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Variants</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Product Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderProduct as $product)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $product->id }}</td>
                                    <td style="width: 200px"><img src="{{ asset($product->product->thumb_image) }}" alt="" width="40%"></td>
                                    <td>{{ $product->product->name }}</td>
                                    <td>
                                        @php
                                            $product->variants = json_decode($product->variants, true);
                                        @endphp
                                        @foreach ($product->variants as $key => $variant)
                                            <strong>{{ ucfirst($key) }}:</strong> {{ $variant['name'] ?? 'N/A' }}<br>
                                        @endforeach
                                       </td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ format_price($product->product_total) }}</td>
                                  
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>
                                       
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

