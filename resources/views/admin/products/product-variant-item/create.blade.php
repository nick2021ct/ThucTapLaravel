@extends('admin.layouts.master')


@section('content')
        <div class="page-body">
          <div class="container-fluid">
            <div class="row page-title">
              <div class="col-sm-6">
                <h3>Base Input</h3>
              </div>
             
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
             
              <div class="">
                <div class="card">
                  <div class="card-header pb-0">
                    <H4>Product Variant Item for {{ $variant->name }}</H4>
                  </div>
                  <div class="card-body">

                    <form class="form theme-form flat-form" method="POST" action="{{ route('admin.product_variant_item.store') }}" enctype="multipart/form-data">
                      @csrf
                     

                   
                      <input class="form-control" id="input" type="hidden" placeholder="name" name="variant_id" value="{{ $variant->id }}" >
                      <input class="form-control" id="input" type="hidden" placeholder="name" name="product_id" value="{{ $product->id }}" >


                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="input">Item Name</label>
                            <input class="form-control" id="input" type="text" placeholder="name" name="name" >
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select" id="status" name="status">
                              <option value="1">Active</option>
                              <option value="0">InActive</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col"></div>
                        <div class="text-end">
                          <button class="btn btn-primary me-2 btn-square" type="submit">Submit</button>
                          <input class="btn btn-danger btn-square" type="reset" value="Cancel">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
             
          </div>
          <!-- Container-fluid starts-->
        </div>
@endsection
