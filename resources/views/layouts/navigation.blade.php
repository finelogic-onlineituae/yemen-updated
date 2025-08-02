{{-- <div class="row mt-2 align-items-center text-center border shadow">
    <div class="col-6 col-sm-6">
        <img src="{{ asset('assets/images/logo.png') }}" width="80" />
    </div>
    <div class="col-4">Embassy of <h4>The Republic of Yemen</h4> in UAE</div>
    <div class="col-2">
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu">
          <li><button class="dropdown-item" type="button">Profile</button></li>
          <li>
            <button class="dropdown-item" type="button">
                <form id="logout" action="{{ route('logout') }}" method="POST"> 
                    @csrf 
                    <a href="#" class="text-decoration-none" onclick="document.getElementById('logout').submit();" class="">Logout</a>
                </form>
            </button>
        </li>
        </ul>
      </div>
    </div>
</div> --}}

<div class="row mt-2 align-items-center text-center border shadow top-bar">
  <!-- Menu Button (hidden on large screens) -->
  <div class="col-2 col-lg-2 col-md-2 col-sm-2 button-div"><button class="btn toggle-btn" id="menuToggle">☰</button></div>
  <div class="col-8 col-lg-10 col-md-6 col-sm-6">Embassy of <h4>The Republic of Yemen</h4> in UAE</div>
  <div class="col-2 col-lg-2 col-md-4 col-sm-4">
      <img src="{{ asset('assets/images/logo.png') }}" class="logo" />
  </div>
                            
</div>