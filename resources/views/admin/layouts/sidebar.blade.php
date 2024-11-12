<div class="overlay"></div>
        <aside class="page-sidebar" data-sidebar-layout="stroke-svg">
          <div class="left-arrow" id="left-arrow">
            <svg class="feather">
              <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-left"></use>
            </svg>
          </div>
          <div id="sidebar-menu">
            <ul class="sidebar-menu" id="simple-bar">
              <li class="pin-title sidebar-list p-0">
                <h5 class="sidebar-main-title">Pinned</h5>
              </li>
              <li class="line pin-line"></li>
              <li class="sidebar-main-title">Product Controller</li>
              @if (Auth::user()->role == "admin")
              <li class="sidebar-list"> 
                <svg class="pinned-icon">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                </svg><a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                  </svg><span>DashBoard</span></a>
              </li>
              <li class="sidebar-list"> 
                <svg class="pinned-icon">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                </svg><a class="sidebar-link" href="javascript:void(0)">
                  <svg class="stroke-icon">
                    <use href=""></use>
                  </svg><span>Product</span>
                  <div class="badge badge-primary rounded-pill">2</div>
                  <svg class="feather">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                  </svg></a>
                <ul class="sidebar-submenu"> 
                  <li><a href="{{ route('admin.product.index') }}"> 
                      <svg class="svg-menu">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                      </svg>Product list</a></li>
                  <li><a href="{{ route('admin.brand.index') }}"> 
                      <svg class="svg-menu">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                      </svg>Brand</a></li>
                
                </ul>
              </li>
              <li class="sidebar-list"> 
                <svg class="pinned-icon">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                </svg><a class="sidebar-link" href="{{ route('admin.coupon.index') }}">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                  </svg><span>Coupon</span></a>
              </li>
              <li class="sidebar-list"> 
                <svg class="pinned-icon">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                </svg><a class="sidebar-link" href="{{ route('admin.flash_sale.index') }}">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                  </svg><span>Flash sale</span></a>
              </li>
              <li class="sidebar-list"> 
                <svg class="pinned-icon">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                </svg><a class="sidebar-link" href="{{ route('admin.employee.index') }}">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                  </svg><span>Employee</span></a>
              </li>
              
              @endif
              <li class="sidebar-list"> 
                <svg class="pinned-icon">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                </svg><a class="sidebar-link" href="{{ route('admin.pos.index') }}">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                  </svg><span>Point of Sale</span></a>
              </li>
              <li class="sidebar-list"> 
                <svg class="pinned-icon">
                  <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                </svg><a class="sidebar-link" href="{{ route('admin.order.index') }}">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                  </svg><span>Orders</span></a>
                </li>
                <li class="sidebar-list"> 
                  <svg class="pinned-icon">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                  </svg><a class="sidebar-link" href="{{ route('admin.order_return.index') }}">
                    <svg class="stroke-icon">
                      <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                    </svg><span>Order Return</span></a>
                </li>
                <li class="line"> </li>

            </ul>
          </div>
          <div class="right-arrow" id="right-arrow">
            <svg class="feather">
              <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-right"></use>
            </svg>
          </div>
        </aside>