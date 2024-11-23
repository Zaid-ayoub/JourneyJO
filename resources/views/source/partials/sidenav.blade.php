<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      


      <li class="nav-heading">Pages</li>
      @if(auth()->check() && auth()->user()->role_id == 3)
      <li class="nav-item">
        <a class="nav-link collapsed" href={{route('users')}}>
          <i class="bi bi-people"></i>
          <span>Users</span>
        </a>
      </li>
      @endif
      
      <li class="nav-item">
        <a class="nav-link collapsed" href={{route('category')}}>
          <i class="bi bi-tags"></i>
          <span>Categories</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href={{route('tour')}} id="toursLink">
          <i class="bi bi-map"></i>
          <span>Tours</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href={{route('booking')}}>
          <i class="bi bi-journal-bookmark"></i>
          <span>Bookings</span>
        </a>
      </li><!-- End Register Page Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href={{route('location')}}>
          <i class="bi bi-geo-alt"></i>
          <span>Locations</span>
        </a>
      </li><!-- End Login Page Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('contact_us') }}">
          <i class="bi bi-envelope"></i>
          <span>Contact Us</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->