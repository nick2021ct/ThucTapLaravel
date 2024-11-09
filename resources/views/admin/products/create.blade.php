@extends('admin.layouts.master')


@section('content')
<style>
  .note-toolbar .note-btn {
        color: black !important;
    }
</style>
<div class="page-body">
  <div class="container-fluid">
      <div class="row page-title">
          <div class="col-sm-6">
              <h3>Create Product</h3>
          </div>
      </div>
  </div>

  <div class="container-fluid">
      <div class="card">
          <div class="card-header pb-0">
              <h4>Product Information</h4>
          </div>
          <div class="card-body">
              <form class="form theme-form flat-form" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                  @csrf

                  <div class="row">
                      <div class="col-md-6">
                          <div class="card mb-3">
                              <div class="card-header pb-0">
                                  <h5>Basic Information</h5>
                              </div>
                              <div class="card-body">
                                  <div class="mb-3">
                                      <label class="form-label" for="name">Name</label>
                                      <input class="form-control" id="name" type="text" placeholder="name" name="name">
                                      @error('name')
                                          <span style="color: red">{{ $message }}</span>
                                      @enderror
                                  </div>
                                      <div class="mb-3">
                                        <label class="form-label" for="brand">Brand</label>
                                        <select class="form-select" id="brand" name="brand">
                                          <option value="">Select</option>
                                          @foreach ($brands as $brand)
                                          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>

                                  <div class="mb-3">
                                      <label class="form-label" for="sku">Sku</label>
                                      <input class="form-control" id="sku" type="text" placeholder="sku" name="sku">
                                      @error('sku')
                                          <span style="color: red">{{ $message }}</span>
                                      @enderror
                                  </div>

                                  <div class="mb-3">
                                      <label class="form-label" for="stock">Stock Quantity</label>
                                      <input class="form-control" id="stock" type="number" placeholder="Stock quantity" name="stock">
                                      @error('stock')
                                          <span style="color: red">{{ $message }}</span>
                                      @enderror
                                  </div>

                                      <div class="mb-3">
                                          <label class="form-label" for="price">Price</label>
                                          <input class="form-control" id="price" type="number" placeholder="VND" name="price">
                                          @error('price')
                                              <span style="color: red">{{ $message }}</span>
                                          @enderror
                                      </div>

                                    
                              </div>
                          </div>
                          <div class="card solid-border rounded-3">
                            <div class="card-header">
                                <h6 class="sub-title f-w-500">Product Type</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="d-block">
                                            <input class="checkbox-primary checkbox-border-primary" id="chk-ani_8" type="checkbox" name="new" value="1">New Arrival
                                        </label>
                                        <label class="d-block">
                                            <input class="checkbox-secondary checkbox-border-secondary" id="chk-ani_9" type="checkbox" name="featured" value="1">Featured
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block">
                                            <input class="checkbox-tertiary checkbox-border-tertiary" id="chk-ani_10" type="checkbox" name="top" value="1">Top Product
                                        </label>
                                        <label class="d-block">
                                            <input class="checkbox-tertiary checkbox-border-danger" id="chk-ani_11" type="checkbox" name="best" value="1">Best Product
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                          <div class="card mb-3">
                              <div class="card-header pb-0">
                                  <h5>Images & Variants</h5>
                              </div>
                              <div class="card-body">
                                  <div class="mb-3">
                                      <label class="form-label" for="thumb_image">Thumb Image</label>
                                      <input class="form-control" id="thumb_image" type="file" name="thumb_image">
                                      @error('thumb_image')
                                          <span style="color: red">{{ $message }}</span>
                                      @enderror
                                  </div>
                              </div>
                              <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Image <code>(Multiple image supported!)</code></label>
                                    <input class="form-control" id="image" type="file" name="image[]" multiple>
                                    @error('image')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="card mb-3">
                      <div class="card-header pb-0">
                          <h5>Product Description & Status</h5>
                      </div>
                      <div class="card-body">
                          <div class="mb-3">
                              <label class="form-label" for="short_note">Short Note</label>
                              <textarea class="form-control" id="short_note" rows="3" name="short_description"></textarea>
                              @error('short_description')
                                  <span style="color: red">{{ $message }}</span>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label class="form-label" for="long_note">Long Note</label>
                              <textarea class="form-control" id="summernote" rows="5" name="long_description"></textarea>
                              @error('long_description')
                                  <span style="color: red">{{ $message }}</span>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-select" id="status" name="status">
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                              </select>
                          </div>
                      </div>
                  </div>

                  <!-- Nút Submit -->
                  <div class="text-end">
                      <button class="btn btn-primary me-2 btn-square" type="submit">Submit</button>
                      <input class="btn btn-danger btn-square" type="reset" value="Cancel">
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
      $('#summernote').summernote({
          height: 300, 
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']]
          ]
      });
  });
      $('form').on('submit', function() {
        $('#summernote').val($('#summernote').summernote('code'));
    });
    
</script>
@endsection