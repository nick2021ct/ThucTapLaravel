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
                        <h4>Authenticate</h4>
                        <div>
                            
                            <div class="overflow-hidden">
                                <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModallogin">Create</button>
                              </div>
                              <div class="modal fade" id="exampleModallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModallogin" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content dark-sign-up">
                                    <div class="modal-body social-profile text-start">
                                      <div class="modal-toggle-wrapper">
                                        <h4>Employee register</h4>
                                        <p class="mb-3">
                                           Fill information below to continue.</p>
                                           <form class="row g-3" action="{{ route('admin.employee.store') }}" method="POST">
                                            @csrf
                                            <div class="col-md-12">
                                                <label class="form-label mb-1" for="inputName">Name</label>
                                                <input class="form-control" id="inputName" type="text" placeholder="Enter Your Name" name="name" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label mb-1" for="inputPhone">Phone</label>
                                                <input class="form-control" id="inputPhone" type="text" placeholder="Enter Your Phone" name="phone" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label mb-1" for="inputEmail">Email</label>
                                                <input class="form-control" id="inputEmail" type="email" placeholder="Enter Your Email" name="email" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label mb-1" for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Enter Your Password" name="password" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label mb-1" for="inputPasswordConfirm">Confirm Password</label>
                                                <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm Your Password" name="password_confirmation" >
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Create</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('admin.employee.index') }}">
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
                                    <th scope="col">Image</th>
                                    <th scope="col">phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)

                                <tr class="b-b-tertiary">
                                    <td scope="row">{{ $employee->id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td width="80px"><img src="{{ asset( $employee->image ) }}" alt=""  style="width: 70%"></td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->email }}</td>
                                    
                                    <td>  
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input check-size employee_status" data-employee-id="{{ $employee->id }}" 
                                                   type="checkbox" role="switch" {{ $employee->status == 'active' ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                 
                                    <td>
                                        <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
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
                                @if ($employees->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $employees->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                @for ($i = 1; $i <= $employees->lastPage(); $i++)
                                    <li class="page-item {{ $i == $employees->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $employees->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($employees->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $employees->nextPageUrl() }}" aria-label="Next">
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

            $('.employee_status').on('change',function(){
                var id = $(this).data('employee-id'); 

                $.ajax({
                    url: "{{ route('admin.employee.change_status', ':id') }}".replace(':id', id),
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

