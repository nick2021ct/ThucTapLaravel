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
                
                <form action="{{ route('home') }}" method="GET">
                <div class="wsus__product_sidebar" id="sticky_sidebar">
                    <div class="accordion" id="accordionExample">
                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-primary text-end">Search</button>
                        </div>
                        <br>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Brands
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">

                                <ul>
                                    @foreach ($brands as $brand)
                                    <li>
                                        <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand->id }}" 
                                               {{ is_array(request('brands')) && in_array($brand->id, request('brands')) ? 'checked' : '' }}>
                                        {{ $brand->name }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            </div>
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
                                    <div>
                                        <label for="min_price">Min Price:</label>
                                        <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control">
                                    </div>
                                    
                                    <div>
                                        <label for="max_price">Max Price:</label>
                                        <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control">
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
                                        <option> default shorting</option>
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>short by latest</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>low to high </option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>high to low</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row">

                 
                            
                            @foreach ($products as $product)
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
            <div class="col mt-4"> 
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        @if ($products->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link" aria-hidden="true">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                        @endif
            
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
            
                        @if ($products->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link" aria-hidden="true">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        
    </script>
@endsection