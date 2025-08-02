<div class="footer container-fluid">
   {{-- <svg class="footer-wave-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100" preserveAspectRatio="none">
        <path class="footer-wave-path" d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z"></path>
      </svg> --}}
    <div class=" footer-section-div row align-items-center text-center top-bar p-2">
        <!-- Menu Button (hidden on large screens) -->
        <div class="col-lg-6 col-md-6 col-sm-6 d-flex flex-sm-row flex-md-row flex-lg-row flex-xl-row align-items-center justify-content-center">
          <img src="{{ asset('assets/images/logo.png') }}" class=" footer-logo img-fluid" />
          @auth
          <div class="border-start ps-2   border-2 border-sm-0 pe-2 fw-bold border-sm-0 text-start">سفارة <br>الجمهورية اليمنية<br> في الإمارات العربية المتحدة</div>
            @else
            
            <div class="border-end pe-2  border-2 border-sm-0 pe-2 fw-bold border-sm-0 text-end">سفارة <br>الجمهورية اليمنية<br> في الإمارات العربية المتحدة</div>
          @endauth

        </div>
          
      {{--     <button class="btn toggle-btn" id="menuToggle">☰</button> --}}
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex gap-4 flex-column flex-lg-row flex-xl-row justify-content-start pt-5">
        <div>
            <ul class="list-unstyled text-end align-items-center">
                <li><h4>	المعلومات القانونية</h4></li>
                <li><a href="#" class="text-decoration-none text-white">	الشروط والأحكام</a></li>
                <li><a href="#" class="text-decoration-none text-white">	سياسة الخصوصية</a></li>
            </ul>    
        </div>
        <div>
            <ul class="list-unstyled text-end align-items-center">
               @auth
                <li  style="text-align:right"><h4>	تواصل معنا</h4></li>
                 @else
                <li><h4>	تواصل معنا</h4></li>
                @endauth

                <li class="d-flex"><span class="text-success px-1"><i class="bi bi-telephone-fill"></i> </span><span>+971 - 999999999</span></li>
                <hr>
                <li class="d-flex"><span class="text-success px-1"><i class="bi bi-geo-alt-fill"></i> </span><span>شارع الشيخ راشد بن سعيد<br>حي السفارات _ابوظبي <br>الإمارات العربية المتحدة</span></li>
                <hr>
            </ul>    
        </div>
      </div>
      </div>
      <div class="text-center">
        <p>حقوق الطبع والنشر © 2025 سفارة اليمن لدى الإمارات العربية المتحدة</p>
        <p>جميع الحقوق محفوظة</p>
    </div>
</div>