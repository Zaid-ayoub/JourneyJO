    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
  
      <div class="d-flex align-items-center justify-content-between">
        <a href={{route('dashboard')}} class="logo d-flex align-items-center">
          <h1 class="m-0 text-primary"><span class="text-dark">Journey</span>JO</h1>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->
  
      
  
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
  
          <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a>
          </li><!-- End Search Icon-->
  
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
                <span class="badge bg-success badge-number">{{ $messageCount ?? 0 }}</span>
            </a><!-- End Messages Icon -->
        
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                <li class="dropdown-header">
                    You have {{ $messageCount ?? 0 }} new messages
                    <a href="{{ route('contact_us') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <!-- Add dynamic messages here as needed -->
            </ul><!-- End Messages Dropdown Items -->
        </li><!-- End Messages Nav -->
        
  
          <li class="nav-item dropdown pe-3">
              @method('patch')
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
            </a><!-- End Profile Iamge Icon -->
  
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>{{ Auth::user()->name }}</h6>
                <span>Web Designer</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                      <i class="bi bi-person"></i>
                      <span>Profile</span>
                    </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                  <i class="bi bi-gear"></i>
                  <span>Account Settings</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li>
                <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                  <i class="bi bi-question-circle"></i>
                  <span>Need Help?</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li>
                  <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center dropdown-item p-0">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none w-100 text-start text-body">
                      <i class="bi bi-box-arrow-right"></i>
                      <span>Log Out</span>
                    </button>
                  </form>
                </li>
                
                
  
            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->
  
        </ul>
      </nav><!-- End Icons Navigation -->
  
    </header><!-- End Header -->