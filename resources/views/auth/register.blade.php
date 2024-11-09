@extends('user.layouts.master')

@section('content')
<section id="wsus__login_register">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 m-auto">
                <div class="wsus__login_reg_area">
                  
                    
                    <div class="text-center"><h3 class="" style="color: #08C">Register</h3></div>
                    
                  
                    <div class="tab-content" id="pills-tabContent2">
                        {{-- <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                            aria-labelledby="pills-home-tab2">
                            <div class="wsus__login">
                                <form>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" placeholder="User Name">
                                    </div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input type="password" placeholder="Password">
                                    </div>
                                    <div class="wsus__login_save">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Remember
                                                me</label>
                                        </div>
                                        <a class="forget_p" href="forget_password.html">forget password ?</a>
                                    </div>
                                    <button class="common_btn" type="submit">login</button>
                                    <p class="social_text">Sign in with social account</p>
                                    <ul class="wsus__login_link">
                                        <li><a href="#"><i class="fab fa-google"></i></a></li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </form>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade show active" id="pills-profiles" role="tabpanel"
                            aria-labelledby="pills-profile-tab2">
                            <div class="wsus__login">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="wsus__login_input">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" placeholder="Name" name="name">
                                    </div>
                                    @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                    <div class="wsus__login_input">
                                        <i class="far fa-envelope"></i>
                                        <input type="text" placeholder="Email" name="email">
                                    </div>
                                    @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input type="password" placeholder="Password" name="password">
                                    </div>
                                    @error('password')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input type="password" placeholder="Confirm Password" name="password_confirmation">
                                    </div>
                                    @error('password_confirmation')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                    <p class="social_text">Aready have account? <a style="color: red" href="{{ route('login') }}">Click here!</a></p>
                                    <br>
                                    <button class="common_btn" type="submit">signup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection