@extends('user.dashboard.layouts.master')

@section('content')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>create address</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{ route('user.address.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-xl-12 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>name <b>*</b></label>
                      <input type="text" placeholder="Name" name="name" >
                      @error('name')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                      
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>email</label>
                      <input type="email" placeholder="Email" name="email">
                      @error('name')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>phone <b>*</b></label>
                      <input type="text" placeholder="Phone" name="phone">
                      @error('name')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Province <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2" id="tinh" name="province" >
                            <option value="">Province</option>
                        </select>
                      </div>
                      @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>District <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2" id="quan" name="district">
                            <option value="">District</option>

                        </select>
                      </div>
                      @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Ward <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2" id="phuong" name="ward">
                            <option value="">Ward</option>

                        </select>
                      </div>
                      @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>zip code <b>*</b></label>
                      <input type="text" placeholder="Zip Code" name ="zip">
                      @error('zip')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>address type <b>*</b></label>
                      <input type="text" placeholder="Home / Office / others" name="address_type">
                      @error('address_type')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>specific address <b>*</b></label>
                      <input type="text" placeholder="specific address" name="specific_address">
                      @error('specific_address')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                 
               
                  <div class="col-xl-6">
                    <button type="submit" class="common_btn">Create</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm',function(data_tinh){	
            if(data_tinh.error==0){
               $.each(data_tinh.data, function (key_tinh,val_tinh) {
                  $("#tinh").append('<option value="'+val_tinh.full_name+'">'+val_tinh.full_name+'</option>');
               });
               $("#tinh").change(function(e){
                    var tinh_selected = $(this).val();
                    var idtinh = data_tinh.data.find(tinh => tinh.full_name === tinh_selected).id; 
                    $.getJSON('https://esgoo.net/api-tinhthanh/2/'+idtinh+'.htm',function(data_quan){	       
                        if(data_quan.error==0){
                           $("#quan").html('<option value="">District</option>');  
                           $("#phuong").html('<option value="">Ward</option>');   
                           $.each(data_quan.data, function (key_quan,val_quan) {
                              $("#quan").append('<option value="'+val_quan.full_name+'">'+val_quan.full_name+'</option>');
                           });
                           $("#quan").change(function(e){
                                var quan_selected = $(this).val(); 
                                var idquan = data_quan.data.find(quan => quan.full_name === quan_selected).id; 
                                $.getJSON('https://esgoo.net/api-tinhthanh/3/'+idquan+'.htm',function(data_phuong){	       
                                    if(data_phuong.error==0){
                                       $("#phuong").html('<option value="">Ward</option>');   
                                       $.each(data_phuong.data, function (key_phuong,val_phuong) {
                                          $("#phuong").append('<option value="'+val_phuong.full_name+'">'+val_phuong.full_name+'</option>');
                                       });
                                    }
                                });
                           });
                            
                        }
                    });
               });   
                
            }
        });
     });	    
     </script>
@endsection