<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin-dashboard') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link"  href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
          <i class="fas fa-user"></i>Logout
        </a>
        <form action="{{ route('admin-logout') }}" id="logoutForm" method="POST">
             @csrf
        </form>
      </li>
    </ul>
  </nav>
