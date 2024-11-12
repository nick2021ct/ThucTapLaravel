@extends('admin.layouts.master')


@section('content')
<style>
    .sub-info {
    font-size: 0.85em;
    color: #555;
}

.sub-row {
    background-color: #f8f9fa;
    color: #333;
    font-size: 0.85em;
}

.sub-row td {
    padding: 5px;
}
</style>
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
                        <h4>Product variant for {{ $product->name }}</h4>
                        <div>
                            
                            <a href="{{ route('admin.product_variant.create',['product'=>request()->product]) }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('admin.product_variant.index') }}">
                            <div class="mb-3 d-flex">
                                <div style="width: 10px"></div>
                                <input type="text" class="form-control me-2" id="searchInput" placeholder="Search..." style="width: 30%;" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="product" value="{{ request('product') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                        <table class="table text-center">
                            <thead>
                                <tr class="b-b-primary">
                                    <th scope="col">Type</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_variants as $variant)
                                    <tr class="b-b-tertiary">
                                        <th scope="row">
                                          Variant
                                        </th>
                                        <th>
                                            {{ $variant->name }}
                                        </th>
                                        <th>
                                            {{ $variant->created_at }}
                                        </th>
                                        <td>  
                                            <div class="form-check form-switch form-check-inline">
                                                <input class="form-check-input check-size changeVariantStatus" data-variant-id="{{ $variant->id }}" 
                                                      type="checkbox" role="switch" {{ $variant->status == '1' ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                
                                        <th>
                                            <a href="{{ route('admin.product_variant_item.create',['productId'=>$product->id,'variantId'=>$variant->id]) }}" class="btn btn-primary">Create</a>

                                            <a href="{{ route('admin.product_variant.edit',$variant->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.product_variant.destroy', $variant->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </th>
                                    </tr>
                                        @foreach ($variant->variantItems as $variant_item)
                                        <tr>
                                        <td></td>
                                        <td>{{ $variant_item->name }}</td>
                                        <td>{{ $variant_item->created_at }}</td>

                                        <td>  
                                            <div class="form-check form-switch form-check-inline">
                                                <input class="form-check-input check-size changeVariantItemStatus" data-item-id="{{ $variant_item->id }}" 
                                                       type="checkbox" role="switch" {{ $variant_item->status == '1' ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                    <td>

                                        <a href="{{ route('admin.product_variant_item.edit',$variant_item->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.product_variant_item.destroy', $variant_item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                        @endforeach
                                
                                  
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if ($product_variants->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $product_variants->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $product_variants->lastPage(); $i++)
                                    <li class="page-item {{ $i == $product_variants->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $product_variants->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($product_variants->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $product_variants->nextPageUrl() }}" aria-label="Next">
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

        $('.changeVariantStatus').on('change',function(){
            var id = $(this).data('variant-id'); 

            $.ajax({
                url: "{{ route('admin.product_variant.change_status',':id') }}".replace(':id', id),
                type: 'PUT',
                success: function(data){
                    if(data.status == 'success'){
                        toastr.success(data.message,'Success');
                    }else if(data.status == 'error'){
                        toastr.error(data.message,'Error');
                    }

                }
            })
        })

        $('.changeVariantItemStatus').on('change', function() {
            var id = $(this).data('item-id'); 

            $.ajax({
                url: "{{ route('admin.product_variant_item.change_status', ':id') }}".replace(':id', id), 
                type: 'PUT',
                success: function(data) {
                    if(data.status == 'success'){
                        toastr.success(data.message, 'Success');
                    } else if(data.status == 'error') {
                        toastr.error(data.message, 'Error');
                    }
                }
            })
        })
    })
</script>
@endsection

