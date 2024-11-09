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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Product</h4>
                        <div>
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.product.index') }}">
                            <div class="mb-3 d-flex ">
                                <div style="width: 10px"></div>
                                <input type="text" class="form-control  me-2" id="searchInput" placeholder="Search..." style="width: 30%;" name="search">
                                <button class="btn btn-primary " type="submit">Search</button>
                            </div>
                        </form>
                        <table class="table text-center">
                            <thead>
                                <tr class="b-b-primary">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Thumb Image</th>
                                    <th scope="col">Stock Quantity</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Offer Price</th>

                                    <th scope="col" >Status</th>
                          
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td style="width: 10%"><img class="img-100 me-2" src="{{ asset($product->thumb_image) }}" alt="profile"></td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->price }}</td>

                                    @if ($product->status == 1)
                                    <td><span class="badge badge-light-success">Active</span></td>
                                    @else
                                    <td><span class="badge badge-light-danger">InActive</span></td>
                                    @endif
                               
                                    <td style="width: 280px">
                                       
                                        <div class="btn-group">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                                            <ul class="dropdown-menu dropdown-block">
                                              <li><a class="dropdown-item" href="{{ route('admin.product.show',$product->id) }}">Detail</a></li>
                                              <li><a class="dropdown-item" href="{{ route('admin.product_variant.index',['product'=>$product->id]) }}">Variant</a></li>
                                              <li><a class="dropdown-item" href="#">Images</a></li>
                                            </ul>
                                          </div>
                                        {{-- <a href="{{ route('admin.product.show',$product->id) }}" class="btn btn-success">Detail</a> --}}
                                        <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline;">
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
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
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

