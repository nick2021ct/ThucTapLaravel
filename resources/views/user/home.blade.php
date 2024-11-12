@extends('user.layouts.master')

@section('content')
<section id="wsus__product_page">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__pro_page_bammer">
                    <img src="{{ asset('/') }}/user/images/pro_banner_1.jpg" alt="banner" class="img-fluid w-100">
                    <div class="wsus__pro_page_bammer_text">
                        <div class="wsus__pro_page_bammer_text_center">
                            <p>up to <span>70% off</span></p>
                            <h5>wemen's jeans Collection</h5>
                            <h3>fashion for wemen's</h3>
                            <a href="#" class="add_cart">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="wsus__sidebar_filter ">
                    <p>filter</p>
                    <span class="wsus__filter_icon">
                        <i class="far fa-minus" id="minus"></i>
                        <i class="far fa-plus" id="plus"></i>
                    </span>
                </div>
                <div class="wsus__product_sidebar" id="sticky_sidebar">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    All Categories
                                </button>
                            </h2>
                           
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Price
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="price_ranger">
                                        <input type="hidden" id="slider_range" class="flat-slider" />
                                        <button type="submit" class="common_btn">filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree3">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree3" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    brand
                                </button>
                            </h2>
                            <div id="collapseThree3" class="accordion-collapse collapse show"
                                aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault11">
                                        <label class="form-check-label" for="flexCheckDefault11">
                                            gentle park
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked22">
                                        <label class="form-check-label" for="flexCheckChecked22">
                                            colors
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked222">
                                        <label class="form-check-label" for="flexCheckChecked222">
                                            yellow
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked33">
                                        <label class="form-check-label" for="flexCheckChecked33">
                                            enice man
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked333">
                                        <label class="form-check-label" for="flexCheckChecked333">
                                            plus point
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="row">
                    <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                        <div class="wsus__product_topbar">
                            <div class="wsus__product_topbar_left">
                               
                                <div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>default shorting</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row">

                                @php
                                $showProduct = [];
                            
                                if ($flashSaleProduct != null) {
                                    foreach ($flashSaleProduct as $item) {
                                        $item->is_flash_sale = true;
                                        $item->discount = $flashSale->discount;
                                        $item->discount_price = discount_price($item->price,$flashSale->discount);
                                        $showProduct[] = $item; 
                                    }
                                }
                            
                                foreach ($products as $item) {
                                    $item->is_flash_sale = false;
                                    $showProduct[] = $item; 
                                }
                            @endphp
                            
                            @foreach ($showProduct as $product)
                                <div class="col-xl-4 col-sm-6">
                                    <div class="wsus__product_item">
                                        @if ($product->is_flash_sale)
                                            <span class="wsus__minus">{{ $product->discount }}%</span>
                                        @endif
                                        <a class="wsus__pro_link" href="{{ route('detail', $product->id) }}">
                                            <img src="{{ asset($product->thumb_image) }}" alt="product" class="img-fluid w-100 img_1" />
                                            <img src="{{ asset($product->thumb_image) }}" alt="product" class="img-fluid w-100 img_2" />
                                        </a>
                                        <ul class="wsus__single_pro_icon">
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                                            <li><a href="#"><i class="far fa-random"></i></a></li>
                                        </ul>
                                        <div class="wsus__product_details">
                                            <a class="wsus__category" href="#">{{ $product->brand->name }}</a>
                                            <a class="wsus__pro_name" href="#">{{ $product->name }}</a>
                                            @if ($product->is_flash_sale)
                                                <p class="wsus__price">{{ format_price($product->discount_price) }} <del>{{ format_price($product->price) }}</del></p>
                                            @else
                                                    <p class="wsus__price">{{ format_price($product->price) }}</p>
                                            @endif
                                            <form class="shopping-cart-form">
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                               <div class="row">
                                                @foreach ($product->productVariant as $variant)
                                                <div class="col-xl-6 col-sm-6">
                                                    <p class="mb-2">{{ $variant->name }}:</p>
                                                    <select class="select_2 col" name="variants[]">
                                                        @foreach ($variant->variantItems as $item)
                                                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endforeach
                                                <input type="hidden" min="1" max="100" name="qty" value="1" />
                                               </div>
                                                <button type="submit" style="border: none" class="add_cart" href="#">add to cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-12">
                <section id="pagination">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </section>
            </div> --}}
        </div>
    </div>
</section>
@endsection