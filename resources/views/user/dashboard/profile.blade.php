@extends('user.dashboard.layouts.master')

@section('content')


      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>basic information</h4>
                <form action="{{ route('user.my_profile.profile',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-xl-10 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie"></i>
                            <input type="text" placeholder="Name" name="name" value="{{ $user->name }}">
                        </div>
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-xl-10 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="far fa-phone-alt"></i>
                            <input type="text" placeholder="Phone" name="phone" value="{{ $user->phone }}">
                          </div>
                        </div>
                        @error('phone')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                        <div class="col-xl-10 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fal fa-envelope-open"></i>
                            <input type="email" placeholder="Email" name="email" value="{{ $user->email }}">
                          </div>
                        </div>
                        @error('email')
                           <span style="color: red">{{ $message }}</span>
                       @enderror
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-md-6">
                      <div class="wsus__dash_pro_img">
                        @if ( $user->image != null )
                        <img src="{{ asset($user->image) }}" alt="img" class="img-fluid w-100">
                        @else
                        <img src="{{ asset('/') }}user/images/ts-2.jpg" alt="img" class="img-fluid w-100">
                        @endif
                        <input type="file" name="image">
                      </div>
                    </div>
                    @error('image')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                    <div class="col-xl-12">
                      <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                    </div>
                </form>
                    <form method="POST" action="{{ route('user.my_profile.password',$user->id) }}">
                      @csrf
                      @method('PUT')
                    <div class="wsus__dash_pass_change mt-2">
                      <div class="row">
                        <div class="col-xl-4 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-unlock-alt"></i>
                            <input type="password" placeholder="Current Password" name="current_password">
                          </div>
                          @error('current_password')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                        </div>
                        <div class="col-xl-4 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-lock-alt"></i>
                            <input type="password" placeholder="New Password" name="password">
                          </div>
                          @error('password')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                        </div>
                        <div class="col-xl-4">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-lock-alt"></i>
                            <input type="password" placeholder="Confirm Password" name="password_confirmation">
                          </div>
                          @error('password_confirmation')
                          <span style="color: red">{{ $message }}</span>
                      @enderror
                        </div>
                        <div class="col-xl-12">
                          <button class="common_btn" type="submit">upload</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection