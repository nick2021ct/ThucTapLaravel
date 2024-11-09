<header class="page-header row">
    <div class="logo-wrapper d-flex align-items-center col-auto"><a href="index.html"><img class="for-light" src="{{ asset('/') }}admin/assets/images/logo/logo.png" alt="logo"><img class="for-dark" src="../assets/images/logo/dark-logo.png" alt="logo"></a><a class="close-btn" href="javascript:void(0)">
        <div class="toggle-sidebar">
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
        </div></a></div>
    <div class="page-main-header col">
      <div class="header-left d-lg-block d-none">
        <form class="search-form mb-0">
          <div class="input-group"><span class="input-group-text pe-0">
              <svg class="search-bg svg-color">
                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Search"></use>
              </svg></span>
            <input class="form-control" type="text" placeholder="Search anything...">
          </div>
        </form>
      </div>
      <div class="nav-right">
        <ul class="header-right">
          
         
          
         
          <li class="profile-dropdown custom-dropdown">
            <div class="d-flex align-items-center">
              @if (Auth::user()->image != null)
              <img width="45px"; height="45px" src="{{ asset(Auth::user()->image) }}" alt="">
              @else
              <img src="{{ asset('/') }}admin/assets/images/profile.png" alt="">
              @endif              
              <div class="flex-grow-1"> 
                <h5>{{ Auth::user()->name }}</h5><span>{{ Auth::user()->role }}</span>
              </div>
            </div>
            <div class="custom-menu overflow-hidden">
              <ul> 
                <li class="d-flex"> 
                  <svg class="svg-color">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Profile"></use>
                  </svg><a class="ms-2" href="user-profile.html">Account</a>
                </li>
                <li class="d-flex"> 
                  <svg class="svg-color">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Message"></use>
                  </svg><a class="ms-2" href="letter-box.html">Inbox</a>
                </li>
                <li class="d-flex"> 
                  <svg class="svg-color">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Document"></use>
                  </svg><a class="ms-2" href="to-do.html">Task</a>
                </li>
                <li class="d-flex"> 
                  <svg class="svg-color">
                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Login"></use>
                  </svg><a class="ms-2" href="login.html">Log Out</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>