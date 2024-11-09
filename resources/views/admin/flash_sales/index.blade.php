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
    <div class="container-fluid table-space basic_table">
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" >
                        <h4>Flash Sale</h4>
                        <div>
                            
                            <a href="{{ route('admin.flash_sale.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.flash_sale.index') }}">
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
                                    <th scope="col">Product name</th>
                                    <th scope="col">Start date</th>
                                    <th scope="col">End date</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($flashSaleInfo as $info)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $info->id }}</td>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->start_date }}</td>
                                    <td>{{ $info->end_date}}</td>
                                    <td>{{ $info->discount }}%</td>
                                    <td>
                                        @if ($info->status == 1)
                                    <span class="badge badge-light-success">Active</span>
                                    @else
                                    <span class="badge badge-light-danger">InActive</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.flash_sale.edit',$info->id) }}" class="btn btn-warning">Update</a>
                                        <form action="{{ route('admin.flash_sale.destroy', $info->id) }}" method="POST" style="display:inline;">
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
                                @if ($flashSaleInfo->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $flashSaleInfo->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $flashSaleInfo->lastPage(); $i++)
                                    <li class="page-item {{ $i == $flashSaleInfo->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $flashSaleInfo->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($flashSaleInfo->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $flashSaleInfo->nextPageUrl() }}" aria-label="Next">
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
  </div>
@endsection

