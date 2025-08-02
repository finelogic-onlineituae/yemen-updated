
  <div class="row align-items-center text-center">
    <!-- Menu Button (hidden on large screens) -->
    <div class="col col-lg-6 col-md-10 col-sm-12 d-flex justify-content-center align-items-center">
        {{-- <span class=" header_logo_section"> --}}
        @auth
        <div class="d-block bg-white d-lg-none d-xl-none d-flex justify-content-center">
          <button class="btn toggle-btn" id="menuToggle">☰</button>
        </div>
        @endauth
        <img src="{{ asset('assets/images/logo.png') }}" class="logo img-fluid header_logo_section" />
        @auth
        <div class="border-start ps-2  border-2 fw-bold text-start header_logo_section">سفارة <br>الجمهورية اليمنية</br>  في الإمارات العربية المتحدة</div>
          @else
          <div class="border-end pe-2 text-white  border-2 fw-bold text-end header_logo_section">سفارة <br>الجمهورية اليمنية</br> في الإمارات العربية المتحدة</div>
        @endauth
      {{-- </span> --}}
        <ul class="list-unstyled d-flex gap-3 justify-content-center text-center language_ul">
          <li>
            <div class="language-switch-wrapper">
              <i id="langToggle" class="fas fa-globe" style="cursor: pointer; font-size: 20px;"><span class="language_but">لغة</span></i>
              <div id="google-translate-dropdown" class=" mt-2"></div>
            </div>
          </li>
        </ul>

      <button class="btn header_logo_section2 d-lg-none d-xl-none " id="userPanelToggle " onclick="userPanelToggle()">
        <i class="fas fa-user"> </i>
      </button>
          <div id="userPanelBox" class="user-panel-box d-none">
            
            <div class="userPanelBox_div">
              <ul class="list-unstyled d-flex gap-3 justify-content-center text-center">
                @auth
                  <li class="my_application_ul"><a href="/myapplications" class="text-decoration-none application-link">تطبيقاتي</a></li>
                  <li>
                    <a href="/notifications" class="text-decoration-none application-link">
                      <div class="number">{{ $notification }}</div>
                      <i class="fas fa-bell"></i>
                    </a>
                  </li>
                @else
                  <li><a href="/myapplications" class="text-decoration-none application-link">تطبيقاتي</a></li>
                @endauth
              </ul>
            
              <div>
                @auth
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                    {{ auth()->user()->name }}
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/profile">مظهر جانبي</a></li>
                    <li>
                      <form id="logout" action="{{ route('logout') }}" method="POST"> 
                        @csrf 
                        <a href="#" class="dropdown-item" onclick="document.getElementById('logout').submit();">تسجيل الخروج</a>
                      </form>
                    </li>
                  </ul>
                </div>
                @else
                <ul class="list-unstyled d-flex gap-3 justify-content-center text-center">
                  <li>
                    <a href="{{ route('register') }}" class="btn register-btn bg-black text-white">سجل هنا</a>
                  </li>
                </ul>

                @endauth
              </div>
          </div>
          </div>



    </div>
  {{-- <div class="col-2 col-lg-2 col-md-0 col-sm-0 pt-2 d-none d-lg-block d-xl-block  align-items-end translate-wrapper" style="text-align:center; padding:10px;">
       
    </div> --}}
  
    <div class="col-4 col-lg-4 col-md-0 col-sm-0 pt-3 d-none d-lg-block d-xl-block  align-items-end">
      <ul class="list-unstyled d-flex gap-3 justify-content-center text-center">
       @auth
        <li class="my-application-li"><a href="/myapplications" class="text-decoration-none application-link">تطبيقاتي</a></li>
         
        <li>
          <a href="/notifications" class="text-decoration-none application-link">
            <div class="number">{{$notification}}</div>
              <i class="fas fa-bell"></i>
          </a>
        </li>
         @else
          <li style="margin-left: auto;"><a href="/myapplications" class="text-decoration-none application-link">تطبيقاتي</a></li>
      @endauth


       
      </ul>
       
    </div>
    
  {{--     <button class="btn toggle-btn" id="menuToggle">☰</button> --}}
  <div class="col-2 col-lg-2 col-md-6 col-sm-6 d-none d-lg-block d-xl-block">
    @auth
    <div class="dropdown">
      <div class="user_log_section dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        {{ auth()->user()->name }}
        <i class="fas fa-user"> </i>
        
      </div>
      {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user"> </i>
        {{ auth()->user()->name }}
      </button> --}}
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"  style="z-index:1300;">
        <li><a class="dropdown-item" href="/profile">مظهر جانبي</a></li>
        <li>
          <form id="logout" action="{{ route('logout') }}" method="POST"> 
            @csrf 
            <a href="#" class="dropdown-item text-decoration-none" onclick="document.getElementById('logout').submit();" class="">تسجيل الخروج</a>
          </form>
        </li>
      </ul>
    </div>
    @else  
    <div>
      <a href="{{ route('register') }}" class="btn register-btn">	سجل هنا</a>
    </div>
    @endauth    
  </div>                      
  </div>

