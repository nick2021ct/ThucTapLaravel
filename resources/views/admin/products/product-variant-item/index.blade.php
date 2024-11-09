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
                        <h4>Product variant Item for {{ $variant->name }}</h4>
                        <div>
                            
                            <a href="{{ route('admin.product_variant_item.create',['productId'=>$product->id,'variantId'=>$variant->id]) }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.product_variant.index') }}">
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Updated</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($variantItems as $item)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->productVariant->name }}</td>
                                    @if ($item->status == 1)
                                    <td><span class="badge badge-light-success">Active</span></td>
                                    @else
                                    <td><span class="badge badge-light-danger">InActive</span></td>
                                    @endif
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.product_variant_item.edit',$item->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.product_variant_item.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                                @if ($variantItems->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $variantItems->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $variantItems->lastPage(); $i++)
                                    <li class="page-item {{ $i == $variantItems->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $variantItems->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($variantItems->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $variantItems->nextPageUrl() }}" aria-label="Next">
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

