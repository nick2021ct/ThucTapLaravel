@extends('admin.layouts.master')


@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="row page-title">
      <div class="col-sm-6">
        <h3>Product Page</h3>
      </div>
      <div class="col-sm-6">
        <nav>
          <ol class="breadcrumb justify-content-sm-end align-items-center">
            <li class="breadcrumb-item"> <a href="index.html">
                <svg class="svg-color">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Home"></use>
                </svg></a></li>
            <li class="breadcrumb-item">ECommerce</li>
            <li class="breadcrumb-item active">Product Page</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row product-page-main p-0">
      <div class="box-col-6 col-md-6 col-xxl-4">
        <div class="card">
          <div class="card-body pb-0">
            <div class="product-slider swiper-container slider2" id="sync1">
              <div class="swiper-wrapper">
                @foreach ($product->productImageGallery as $proImage)
                <div class="swiper-slide"><img src="{{ asset($proImage->image) }}" alt=""></div>
            @endforeach
              </div>
            </div>
            <div class="swiper-container slider-thumbnail" id="sync2">
              <div class="swiper-wrapper">
                @foreach ($product->productImageGallery as $proImage)
                <div class="swiper-slide"><img src="{{ asset($proImage->image) }}" alt=""></div>
            @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-col-6 order-xxl-0 order-1 col-xxl-5">
        <div class="card">
          <div class="card-body">
            <div class="product-page-details">
              <h3 class="f-28 f-w-600">{{ $product->name }}</h3>
            </div>
            @if ($product->offer_price !=null)
            <div class="product-price">${{ $product->offer_price }}  
              <del>${{ $product->price }} </del>
            </div>
            @else
            <div class="product-price">${{ $product->price }}  
            </div>
            @endif
            <hr>
            <div class="row flex-wrap justify-content-center">
              @foreach ($product->productVariant as $variants)
                  <div class="col-md-3 mb-2"> 
                      <div class="btn-group w-100">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $variants->name }}
                          </button>
                          <ul class="dropdown-menu dropdown-block">
                              @foreach ($variants->items as $item)
                                  <li><a class="dropdown-item" href="#">{{ $item->name }}</a></li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              @endforeach
          </div>
         
            
          
          </div>
            
            
            <hr>
            <p>{{ $product->short_description }}</p>
            <hr>
            <div>
              <table class="product-page-width table-borderless">
                <tbody>
                  <tr>
                    <td> <b>Brand &nbsp;&nbsp;&nbsp;:</b></td>
                    <td>{{ $product->brand->name }}</td>
                  </tr>
                  <tr>
                    <td> <b>Availability &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                      @if ($product->stock>0)
                      <td class="font-success">
                      In stock
                    </td>
                    @else
                    <td class="font-danger">
                        Out stock
                      </td>
                    @endif
                  </tr>
                  {{-- <tr>
                    <td> <b>Seller &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                    <td>ABC</td>
                  </tr>
                  <tr>
                    <td> <b>Fabric &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                    <td>Cotton</td>
                  </tr> --}}
                </tbody>
              </table>
            </div>
            <hr>
            {{-- <div class="row">
              <div class="col-md-4">
                <h6 class="product-title">share it</h6>
              </div>
              <div class="col-md-8">
                <div class="product-icon">
                  <ul class="product-social">
                    <li class="d-inline-block"><a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li class="d-inline-block"><a href="https://accounts.google.com/" target="_blank"><i class="fa-brands fa-google-plus-g"></i></a></li>
                    <li class="d-inline-block"><a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                    <li class="d-inline-block"><a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    <li class="d-inline-block"><a href="https://rss.app/" target="_blank"><i class="fa fa-rss"></i></a></li>
                  </ul>
                  <form class="d-inline-block f-right"></form>
                </div>
              </div>
            </div> --}}
           
          </div>
        </div>
      </div>
      <div class="box-col-12 col-md-6 col-xxl-3">
        <div class="card">
        
        </div>
       
      </div>
      <div class="col-sm-12">
        <div class="card">
          <div class="row product-page-main m-2">
            <div class="col-sm-12">
              <ul class="nav nav-tabs border-tab nav-primary mb-0" id="top-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="false">Details</a>
                  <div class="material-border"></div>
                </li>
               
              </ul>
              <div class="tab-content" id="top-tabContent">
                <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                  <p class="mb-0 m-t-20">{{ $product->long_description }}&quot;</p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid ends-->
</div>
  @endsection
