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
                        <h4>Brand</h4>
                        <div>
                            
                            <a href="{{ route('admin.brand.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.brand.index') }}">
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
                                    <th scope="col">Logo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Updated</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $brand->id }}</td>
                                    <td style="width: 10%"><img class="img-30 me-2" src="{{ asset($brand->logo) }}" alt="profile"></td>
                                    <td>{{ $brand->name }}</td>
                                    <td>  
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input check-size changeStatus" data-id="{{ $brand->id }}" 
                                                   type="checkbox" role="switch" {{ $brand->status == '1' ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $brand->created_at }}</td>
                                    <td>{{ $brand->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.brand.edit',$brand->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.brand.destroy', $brand->id) }}" method="POST" style="display:inline;">
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
                                @if ($brands->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $brands->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $brands->lastPage(); $i++)
                                    <li class="page-item {{ $i == $brands->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $brands->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($brands->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $brands->nextPageUrl() }}" aria-label="Next">
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

        $('.changeStatus').on('change',function(){
            var id = $(this).data('id'); 

            $.ajax({
                url: "{{ route('admin.brand.change_status',':id') }}".replace(':id', id),
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

        
    })
</script>
@endsection