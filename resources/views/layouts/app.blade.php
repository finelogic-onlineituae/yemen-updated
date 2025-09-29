<!DOCTYPE html>
<html @auth  lang="ar" dir="rtl" @else lang="en" dir="ltr"  @endauth>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        
{{--         <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/newstyle.css') }}" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/modal.css') }}" rel="stylesheet" />
        
 
       
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-...your-integrity..." crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Croppie JS & CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>


    </head>
    <body>

    {{-- Add this if you're going to use @push('scripts') in child views --}}

        <div class="container-fluid p-0" >        
            <div class="header-container d-flex align-items-center justify-content-center">
                <div class="header-content">
                @include('layouts.app-navigation')
                </div>
            </div>

            <div class="content-container">
                @auth
                <!-- Sidebar (inside container with margin on large screens) -->
                
                    <div class="sidebar" id="sidebar">
                        <button class="close-btn text-white" id="closeMenu"><i class="bi bi-x-circle-fill"></i></button>
                        <a href="/dashboard" class="menu-heading"><i class="bi bi-speedometer"></i>	الصفحة الرئيسية</a>
                        <a href="/myapplications" class="menu-heading"><i class="bi bi-check-circle-fill"></i> 	التطبيق الخاص بك</a>
                            {{-- <div>
                                <a href="#personal-documents" id="id-documents" onclick="toggleCollapseButtonMenu(this)" class="menu-heading" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="personal-documents">
                                    <i @class(['bi', 'bi-dash-circle-fill' => session('category') == 'identity', 'bi-plus-circle-fill' => session('category') != 'identity']) id="id-documents-collapse-button"></i>  وثائق الهوية
                                </a>
                                <div @class(['collapse', 'show' => session('category') == 'identity']) id="personal-documents">
                                <a href="/applications/birth-certificate" @class(['bg-dark text-white' => session('app') == 'birth'])>شهادة إثبات الولادة</a>
                                <a href="/applications/driving-licence">تأكيد رخصة القيادة</a>
                                <a href="/applications/no-id-card">شهادة عدم وجود بطاقة هوية</a>
                                <a href="/applications/no-id-card-group">شهادة عدم وجود بطاقة هوية group</a>
                                <a href="/applications/no-objection-certification"  @class(['bg-dark text-white' => session('app') == 'NOC'])>شهادة عدم ممانعة </a>
                                <a href="/applications/support-statement" @class(['bg-dark text-white' => session('app') == 'support_statement'])>شهادة التبعية </a>


                                
                                <a href="/applications/marriage-certificate"  @class(['bg-dark text-white' => session('app') == 'marriage'])>شهادة الزواج</a>
                                <a href="/applications/family-member"  @class(['bg-dark text-white' => session('app') == 'family'])>شهادة القرابة</a>

                              
                                </div>
                            </div> --}}
                           @foreach ($category as $categorys)
                                <div>
                                <a href="#{{$categorys->id}}" id="visa" onclick="toggleCollapseButtonMenu(this)" class="menu-heading" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="personal-documents">
                                    <i @class(['bi', 'bi-dash-circle-fill' => session('category') == $categorys->id, 'bi-plus-circle-fill' => session('category') != $categorys->id]) class="bi bi-plus-circle-fill"  id="visa-collapse-button"></i>	{{$categorys->category_name_arabic}} 
                                </a>
                                <div  id="{{$categorys->id}}" @class(['collapse', 'show' => session('category') == $categorys->id])>
                                    @foreach ($categorys->FormTypeName as $FormTypeName)
                                        @if($FormTypeName->id != 5 && $FormTypeName->id != 7 &&  $FormTypeName->id != 18 &&  $FormTypeName->id != 19 &&  $FormTypeName->id != 3)
                                        <a @class(['bg-dark text-white' => session('app') == $FormTypeName->url]) href="/{{$FormTypeName->url}}">{{$FormTypeName->application_name_arabic}}</a>
                                        @endif
                                    @endforeach
                                    {{-- <a href="/applications/visa-application">التقدم بطلب للحصول على تأشيرة جديدة</a>
                                    <a href="/#">	قواعد ولوائح التأشيرة</a> --}}
                                </div>
                            </div>
                           @endforeach                        
                    </div>

                @endauth
                    
                
                    <!-- Main Content -->
                    <div class="main-content rounded ">
                  <div  class="bg-warning p-2 pt-3 m-2 rounded text-center">
                      <h6 class="text-dark">Applicants with passport expired 6 months ago should directly visit embassy for application</h6>
                      </div>
                    <div class="{{ request()->is('dashboard') || request()->is('applications/post-confirmation*') ? '' : 'form-border' }}">
                      
                        {{$slot}}
                    </div>

                    </div>
            </div>
        </div>
            <div class="footer-container d-flex justify-content-center align-items-center container-fluid">
                @include('layouts.footer')
                
            </div>
       

       @stack('scripts')
  
    </body>

   <script src="{{ asset('assets/js/custom.js') }}"></script>
   <script src="{{ asset('assets/js/modal.js') }}"></script>
   


{{-- <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'ar',
      includedLanguages: 'en,ar',
    //   layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google-translate-dropdown');
  }

  // Load the translate script after DOM is ready
  window.addEventListener('load', function () {
    if (!window.google || !window.google.translate) {
      var script = document.createElement('script');
      script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
      document.body.appendChild(script);
    } else {
      googleTranslateElementInit(); // fallback if script already loaded
    }
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("langToggle");
    const dropdown = document.getElementById("google-translate-dropdown");

    toggleBtn.addEventListener("click", function () {
      dropdown.classList.toggle("d-none");
    });
  });
</script> --}}

<!-- Google Translate Init Script -->
<script type="text/javascript">
   function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'ar',
      includedLanguages: 'en,ar',
    //   layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google-translate-dropdown');
  }

  // Load the translate script after DOM is ready
  function loadGoogleTranslateScript() {
    if (!window.google || !window.google.translate) {
      const script = document.createElement('script');
      script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
      document.body.appendChild(script);
    } else {
      googleTranslateElementInit(); // fallback if script already loaded
    }
  }

  window.addEventListener('load', loadGoogleTranslateScript);

  // Re-run init on history back/forward
  window.addEventListener('pageshow', function (event) {
    if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
      loadGoogleTranslateScript();
      attachToggleHandler(); // rebind event
    }
  });

  // Attach click handler for language dropdown toggle
  function attachToggleHandler() {
    const toggleBtn = document.getElementById("langToggle");
    const dropdown = document.getElementById("google-translate-dropdown");

    if (toggleBtn && dropdown) {
      toggleBtn.onclick = function () {
        dropdown.classList.toggle("d-none");
      };
    }
  }

  // Bind the toggle button after DOM is ready
  document.addEventListener("DOMContentLoaded", function () {
    attachToggleHandler();
  });
</script>

<script>
document.getElementById('signatureInputtype').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;

    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!allowedTypes.includes(file.type)) {
        alert('Please upload an image file of type JPG or PNG only.');
        this.value = ''; // Reset file input
        return;
    }

    const maxSize = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSize) {
        alert('File size must be less than 2MB.');
        this.value = ''; // Reset file input
        return;
    }
});

</script>




<script>
    function bindEmiratesIdValidation() {
        document.querySelectorAll("input[id^='emiratesIdInput-']").forEach(function (input) {
            if (input.dataset.bound === 'true') return; // Avoid rebinding

            const index = input.id.split('-')[1];
            const errorMsg = document.getElementById(`emiratesIdError-${index}`);

            input.addEventListener('input', function () {
                let value = input.value.replace(/\D/g, '').substring(0, 15);
                let formatted = '';
                if (value.length > 0) formatted += value.substring(0, 3);
                if (value.length > 3) formatted += '-' + value.substring(3, 7);
                if (value.length > 7) formatted += '-' + value.substring(7, 14);
                if (value.length > 14) formatted += '-' + value.substring(14);
                input.value = formatted;

                if (value.length < 15) {
                    errorMsg?.classList.remove('d-none');
                } else {
                    errorMsg?.classList.add('d-none');
                }
            });

            input.addEventListener('keypress', function (e) {
                if (!/\d/.test(e.key)) {
                    e.preventDefault();
                }
            });

            input.dataset.bound = 'true'; // Mark as bound
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        bindEmiratesIdValidation();
    bindPassportValidation();

    });

    // 🔁 Polling to detect DOM changes and bind validation
    const observer = new MutationObserver(() => {
        bindEmiratesIdValidation();
        bindPassportValidation();
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });


    function bindPassportValidation() {
    document.querySelectorAll("input[id^='passportInput-']").forEach(function (input) {
        if (input.dataset.bound === 'true') return;

        const index = input.id.split('-')[1];
        const error = document.getElementById(`passportError-${index}`);

        input.addEventListener('input', function () {
            let value = input.value.replace(/[^a-zA-Z0-9]/g, '').substring(0, 8);
            input.value = value;

            if (value.length !== 8) {
                error?.classList.remove('d-none');
            } else {
                error?.classList.add('d-none');
            }
        });

        input.dataset.bound = 'true';
    });
}

</script>
<script>
  const dateInput = document.getElementById("expire_on");

  // Get today's date
  let today = new Date();

  // Subtract 6 months
  let sixMonthsAgo = new Date();
  sixMonthsAgo.setMonth(today.getMonth() - 6);

  // Format date as YYYY-MM-DD (for input[type=date])
  const formatDate = (date) => {
    let year = date.getFullYear();
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  };

  // Set min attribute
  dateInput.min = formatDate(sixMonthsAgo);
  console.log(dateInput.min);
  
</script>






</html>
