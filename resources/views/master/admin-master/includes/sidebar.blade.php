<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/') }}admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset(Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{ route('admin-dashboard') }}" class="nav-link {{ Session::get('active') == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
              </li>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link {{ Session::get('active') == 'settings' || Session::get('active') == 'adminDetails' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Settings
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin-settings') }}" class="nav-link {{ Session::get('active') == 'settings' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-update-details') }}" class="nav-link {{ Session::get('active') == 'adminDetails' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Details</p>
                </a>
              </li>
            </ul>
          </li>
                <!-- Start Catelouge Group  -->
            <li class="nav-item menu-open">
                <a href="#" class="nav-link {{ Session::get('active') == 'category' || Session::get('active') == 'section' ? 'active' : '' || Session::get('active') == 'product' ? 'active' : '' || Session::get('active') == 'brand' ? 'active' : '' || Session::get('active') == 'banner' ? 'active' : '' || Session::get('active') == 'coupon' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Catelouge
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('section') }}" class="nav-link {{ Session::get('active') == 'section' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sections</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('brand') }}" class="nav-link {{ Session::get('active') == 'brand' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category') }}" class="nav-link {{ Session::get('active') == 'category' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products') }}" class="nav-link {{ Session::get('active') == 'product' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('banners') }}" class="nav-link {{ Session::get('active') == 'banner' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banners</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-coupons') }}" class="nav-link {{ Session::get('active') == 'coupon' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin-orders') }}" class="nav-link {{ Session::get('active') == 'orders' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
            </ul>
          </li><!-- End Catelouge Group  -->

            <!-- Start Product Filter -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ Session::get('active') == 'fabric' || Session::get('active') == 'pattern' ? 'active' : '' || Session::get('active') == 'sleeve' ? 'active' : '' || Session::get('active') == 'fit' ? 'active' : '' || Session::get('active') == 'occasion' ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Product Filters
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('fabric') }}" class="nav-link {{ Session::get('active') == 'fabric' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Fabrics</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pattern') }}" class="nav-link {{ Session::get('active') == 'pattern' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Patterns</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('sleeve') }}" class="nav-link {{ Session::get('active') == 'sleeve' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Sleeves</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('fit') }}" class="nav-link {{ Session::get('active') == 'fit' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Fits</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('occasion') }}" class="nav-link {{ Session::get('active') == 'occasion' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Occasions</p>
            </a>
          </li>
        </ul>
      </li><!-- End Product Filter -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
