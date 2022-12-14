
<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">

			@if (Auth::check())
                <div class="span6">Welcome!<strong> {{ Auth::user()->name }}</strong></div>
            @else
                <div class="span6"><strong>Welcome Unregisterd User.!</strong></div>
            @endif
			<div class="span6">
				<div class="pull-right">
					<a href="{{ route('front-cart-page') }}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ <span class="sumCartItem">{{ sumCartItems(); }}</span> ] Items in your cart </span> </a>
				</div>
			</div>
		</div>
		<!-- Navbar ================================================== -->
		<section id="navbar">
		  <div class="navbar">
		    <div class="navbar-inner">
		      <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		        <a class="brand" href="#">Stack Developers</a>
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li class="active"><a href="{{ route('front-home') }}">Home</a></li>
                    @foreach ($sections as $section)
		            <li class="dropdown">
		              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">{{ $section->name }} <b class="caret"></b></a>
                        @if (!count($section->categories) == 0)
                        <ul class="dropdown-menu">
                            @foreach ($section->categories as $category)
                                <li class="nav-header"><a href="{{ url('/'.$category->url) }}">{{ $category->category_name }}</a></li>
                                    @foreach ($category->subCategory as $subCategory)
                                        <li><a href="{{ url('/'.$subCategory->url) }}">{{ $subCategory->category_name }}</a></li>
                                    @endforeach
                                    <li class="divider"></li>
                            @endforeach
                        </ul>
                        @endif
		            </li>
                    @endforeach
		            {{-- <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Women <b class="caret"></b></a>
		              <ul class="dropdown-menu">
		              	<li class="divider"></li>
		                <li class="nav-header"><a href="#">Tops</a></li>
		                <li><a href="#">Casual Tops</a></li>
		                <li><a href="#">Formal Tops</a></li>
		                <li class="divider"></li>
		                <li class="nav-header"><a href="#">Dresses</a></li>
		                <li><a href="#">Casual Dresses</a></li>
		                <li><a href="#">Formal Dresses</a></li>
		              </ul>
		            </li>
		            <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kids <b class="caret"></b></a>
		              <ul class="dropdown-menu">
		              	<li class="divider"></li>
		                <li class="nav-header"><a href="#">T-Shirts</a></li>
		                <li><a href="#">Casual T-Shirts</a></li>
		                <li><a href="#">Formal T-Shirts</a></li>
		                <li class="divider"></li>
		                <li class="nav-header"><a href="#">Shirts</a></li>
		                <li><a href="#">Casual Shirts</a></li>
		                <li><a href="#">Formal Shirts</a></li>
		              </ul>
		            </li> --}}
		            <li><a href="#">About</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="#">
		            <input type="text" class="search-query span2" placeholder="Search"/>
		          </form>
		          <ul class="nav pull-right">
		            <li><a href="{{ route('front-orders') }}">Orders</a></li>
		            <li class="divider-vertical"></li>
		           @if (Auth::check())
                        <li><a href="{{ route('front-user-account-home') }}">My Account</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit();">Logout</a></li>
                        <form action="{{ route('front-user-logout') }}" method="POST" id="logoutForm">
                            @csrf
                        </form>
                    @else
                    <li><a href="{{ route('front-login-register') }}">Login</a></li>
                   @endif
		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div><!-- /navbar -->
		</section>
	</div>
</div>
