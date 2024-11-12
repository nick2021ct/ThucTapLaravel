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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" >
                                <h4>FlashSale Info</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.flash_sale.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label class="col-md-3 col-form-label">Name Flash Sale</label>
                                        <div class="col-md-9">
                                            <input class="form-control digits" type="text" name="name">
                                            @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-xxl-3 box-col-12 text-start">Start Date</label>
                                        <div class="col-xxl-9 box-col-12"> 
                                          <div class="input-group flatpicker-calender">
                                            <input class="form-control" id="datetime-local1" type="date" name="start_date">
                                        </div>
                                        @error('start_date')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                        </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                        <label class="col-xxl-3 box-col-12 text-start">End Date</label>
                                        <div class="col-xxl-9 box-col-12"> 
                                          <div class="input-group flatpicker-calender">
                                            <input class="form-control" id="datetime-local1" type="date" name="end_date">
                                        </div>
                                        @error('end_date')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                        </div>
                                      </div>
                                    <br>
                                    <div class="mb-3 row">
                                        <label class="col-md-3 col-form-label">Discount(%)</label>
                                        <div class="col-md-9">
                                            <input class="form-control digits" type="number" name="discount">
                                            @error('discount')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                     
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" >
                                <h4>Add Product</h4>
                            </div>
                            <div class="card-body">
                                <table class="table text-center">
                                    <thead>
                                        <tr class="b-b-primary">
                                            <th scope="col">Take</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Stock Quantity</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr class="b-b-tertiary">
                                            <td scope="row">
                                                <input class="form-check-input" id="flexCheckChecked" type="checkbox" name="product[]" value="{{ $product->id }}">
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @error('product')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                <br>
                                <div class="d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
  </div>
@endsection
