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
                    <H4>Shipping Rule</H4>
                  </div>
                  <div class="card-body">
                    <form class="form theme-form flat-form" method="POST" action="{{ route('admin.shipping_rule.update',$shipping_rule->id) }}" >
                      @csrf
                      @method('PUT')
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="pwd">Name</label>
                            <input class="form-control" id="pwdre" type="text"  name="name" value="{{ $shipping_rule->name }}">
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="status">Type</label>
                            <select class="form-select shipping-type " id="status " name="type">
                              <option {{ $shipping_rule->type == 1 ? 'seleted' : '' }} value="1">Flat cost</option>
                              <option {{ $shipping_rule->type == 0 ? 'seleted' : '' }} value="0">Minimum Order Amount</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                      <div class="row min_cost d-none">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="pwd">Minimum Amount</label>
                            <input class="form-control" id="min_cost" type="text"  name="min_cost" value="{{ $shipping_rule->min_cost }}">
                            @error('min_cost')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="pwd">Cost</label>
                            <input class="form-control" id="pwdre" type="number"  name="cost" value="{{ $shipping_rule->cost }}">
                            @error('cost')
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
                              <option {{ $shipping_rule->status == 1 ? 'seleted' : '' }} value="1">Active</option>
                              <option {{ $shipping_rule->status == 0 ? 'seleted' : '' }} value="0">InActive</option>
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

@section('scripts')
    <script>
      $(document).ready(function(){
        $('body').on('change', '.shipping-type', function(){
          let value = $(this).val();

          if(value !== '0'){
            $('.min_cost').addClass('d-none')
          }else{
            $('.min_cost').removeClass('d-none')
          }
        })
      });
    </script>
@endsection