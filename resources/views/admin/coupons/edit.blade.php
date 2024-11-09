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
                    <H4>Coupon</H4>
                  </div>
                  <div class="card-body">

                    <form class="form theme-form flat-form" method="POST" action="{{ route('admin.coupon.update',$coupon->id) }}" >
                      @csrf
                     @method('PUT')

                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="input">Name</label>
                            <input class="form-control" id="input" type="text"  name="name" value="{{ $coupon->name }}">
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="input">Code</label>
                            <input class="form-control" id="input" type="text"  name="code" value="{{ $coupon->code }}">
                            @error('code')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="input">Quantity</label>
                            <input class="form-control" id="input" type="number"  name="quantity" value="{{$coupon->quantity }}">
                            @error('qty')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="input">Max use per person</label>
                            <input class="form-control" id="input" type="number"  name="max_use" value="{{ $coupon->max_use }}">
                            @error('max_use')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        
                        <div class="col">
                          <div class="row">
                            <label class="form-label">Start Date</label>
                            <div class="input-group flatpicker-calender">
                                <input class="form-control" id="datetime-local1" type="datetime" name="start_date" value="{{ $coupon->start_date }}">
                            </div>
                            @error('start_date')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                          </div>
                        </div>
                        <div class="col">
                          <div class="row">
                              <label class="form-label">End Date</label>
                              <div class="input-group flatpicker-calender">
                                <input class="form-control" id="datetime-local1" type="datetime" name="end_date" value="{{ $coupon->end_date }}">
                            </div>
                            @error('end_date')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                      
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="status">Discount type</label>
                            <select class="form-select" id="status" name="discount_type" >
                              <option {{ $coupon->discount_type == 'percent' ? 'selected' : '' }} value="percent">Percent(%)</option>
                              <option {{ $coupon->discount_type == 'amount' ? 'selected' : '' }} value="amount">Amount</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="input">Discount value</label>
                            <input class="form-control" id="input" type="number"  name="discount_value" value="{{ $coupon->discount_value }}">
                            @error('discount_value')
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
                              <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">Active</option>
                              <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">InActive</option>
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
