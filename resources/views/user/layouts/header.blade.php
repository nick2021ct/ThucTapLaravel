<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="wsus__mobile_menu_area">
                    <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                <div class="wsus_logo_area">
                    <a class="wsus__header_logo" href="{{ route('home') }}">
                        <img src="{{ asset('/') }}/user/images/logo_2.png" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>
            <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                <div class="wsus__search">
                    <form method="GET" action="{{ route('home') }}">
                        <input type="text" placeholder="Search..." name="search">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                <div class="wsus__call_icon_area">
                    <div class="wsus__call_area">
                        <div class="wsus__call">
                            <i class="fas fa-user-headset"></i>
                        </div>
                        <div class="wsus__call_text">
                            <p>example@gmail.com</p>
                            <p>+569875544220</p>
                        </div>
                    </div>
                    <ul class="wsus__icon_area">
                        {{-- <li><a href="wishlist.html"><i class="fal fa-heart"></i><span>05</span></a></li>
                        <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li> --}}
                        <li><a class="wsus__cart_icon" href="#"><i 
                                    class="fal fa-shopping-bag"></i><span>{{Cart::count()}}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        @if (Cart::content()->isNotEmpty())
        <ul>
            @foreach (Cart::content()->take(4) as $cart)
            <li>
                <div class="wsus__cart_img">
                    <a href=""><img  src="{{ asset($cart->options->image) }}" alt="product" class="img-fluid w-100"></a>
                </div>
                <div class="wsus__cart_text">
                    <a class="wsus__cart_title" href="#">{{ $cart->name }}</a>
                    <p>{{ format_price($cart->price) }}</p>
                    <a class="wsus__cart_title" href="#">quantity: {{ $cart->qty }}</a>
                </div>
            </li>
            <div style="height: 120px"></div>
            @endforeach
            @if (count(Cart::content()) >4)
            <br>
                <p>...View cart to see more</p>
            @endif
       
        </ul>
        <h5>sub total <span>{{ format_price(showProductTotal()) }}</span></h5>  
        @else
        <p class="text-center">Your cart is empty</p>
      
        @endif
        
        <div class="wsus__minicart_btn_area ">
            <a class="common_btn btn btn-primary" href="{{ route('cart.index') }}">view cart</a>
        </div>
    </div>

</header>
