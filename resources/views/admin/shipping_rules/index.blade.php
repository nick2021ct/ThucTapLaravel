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
                        <h4>Shipping Rule</h4>
                        <div>
                            
                            <a href="{{ route('admin.shipping_rule.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.shipping_rule.index') }}">
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
                                    <th scope="col">Type</th>
                                    <th scope="col">Min cost</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shipping_rules as $shipping_rule)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $shipping_rule->id }}</td>
                                    <td>{{ $shipping_rule->name }}</td>
                                    <td>
                                        @if ( $shipping_rule->type ==1)
                                            Flat Cost
                                        @else
                                            Minimum Order Amount
                                        @endif
                                    </td>
                                    <td>{{ $shipping_rule->min_cost }}</td>
                                    <td>{{ $shipping_rule->cost }}</td>
                                    @if ($shipping_rule->status == 1)
                                    <td><span class="badge badge-light-success">Active</span></td>
                                    @else
                                    <td><span class="badge badge-light-danger">InActive</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('admin.shipping_rule.edit',$shipping_rule->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.shipping_rule.destroy', $shipping_rule->id) }}" method="POST" style="display:inline;">
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
                                @if ($shipping_rules->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $shipping_rules->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $shipping_rules->lastPage(); $i++)
                                    <li class="page-item {{ $i == $shipping_rules->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $shipping_rules->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($shipping_rules->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $shipping_rules->nextPageUrl() }}" aria-label="Next">
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

