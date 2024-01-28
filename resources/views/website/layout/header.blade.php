

<div class="site-navbar py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="{{ url('/') }}" class="js-logo-clone"><strong class="text-primary">ksa</strong>shopping</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block" style="direction:rtl">
                <li class="active"><a href="{{ url('/') }}" >الرئيسية</a></li>
                <li class="has-children">
                  <a href="{{ url('categories/') }}">الاقسام</a>
                  <ul class="dropdown">
				          @forelse ($categories as $category)
                    <li><a href="{{ url('collection/'.$category->slug.'/') }}">{{ $category->name }}</a></li>
			           	@empty
                    <li>لا يوجد اقسام حاليا</li>
                  @endforelse	

                    <li class="has-children">
                      <a href="#">Vitamins</a>
                      <ul class="dropdown">
                        <li><a href="#">Supplements</a></li>
                        <li><a href="#">Vitamins</a></li>
                        <li><a href="#">Diet &amp; Nutrition</a></li>
                        <li><a href="#">Tea &amp; Coffee</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Diet &amp; Nutrition</a></li>
                    <li><a href="#">Tea &amp; Coffee</a></li>
                    
                  </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <a href="cart.html" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <span class="number">2</span>
            </a>
                        <ul class="nav justify-content-end">
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('cart/') }}">
                                    <i class="fa fa-shopping-cart"></i> Cart (@livewire('frontend.user.cart-count'))
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('wishlist/') }}">
                                    <i class="fa fa-heart"></i> Wishlist (@livewire('frontend.user.wishlist-count'))
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> Username 
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ url('wishlist/') }}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                <li>
                                       <a href="javascript:void" onclick="$('#logout-form').submit();"> <i class="fa fa-sign-out"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    <a class="dropdown-item" href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a>
          </div>
        </div>
      </div>
    </div>
<!-- .fyt
<div class="fyt "  style="float:left;">
			
			<a href="" style="text-decoration:none;" class="" target="_blank"><img src="images/youtube-icon.png" alt="" width="50" height="50" /></a>
			<a href="" style="text-decoration:none;" class="" target="_blank"><img src="images/Facebook-icon.png" alt="" width="50" height="50" /></a>
			<a href="" style="text-decoration:none;" class="" target="_blank"><img src="images/Twitter-icon.png" alt="" width="50" height="50" /></a>
				
	</div> 
	<div class="cart_box " style="float:right;margin-top: 30px"  >
					<b><img class="cart_img" src="images/cart.png" alt=""/><a href="cart/order" style="" class="item_num">5 قطعة |سلة التسوق</a>	
					</b>
	</div> 
   .cart_box
	<div class="clearfix"></div>
	
		<nav class="navbar navbar-expand-sm bg no-gutters nav-bar text-truncate">

						  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
							<span class="navbar-toggler-icon"></span>
						  </button>
						  <div class="collapse navbar-collapse" id="collapsibleNavbar">
							<ul class="navbar-nav " >
							   <li class="nav-item">
								<a class="nav-link active" href="{{ url('home/') }}" >الرئيسية</a>
							  </li>	
							  <li class="nav-item">
								<a class="nav-link" href="{{ url('categories/') }}">المنتجات</a>
							  </li>
							  <li class="nav-item ">
								<a class="nav-link " href="">العروض</a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" href="">عن الشركة</a>
							  </li> 
							   <li class="nav-item">
								<a class="nav-link" href="">المنتجات</a>
							  </li>
							  <li class="nav-item ">
								<a class="nav-link " href="">العروض</a>
							  </li>
							   <li class="nav-item">
								<a class="nav-link" href="">المنتجات</a>
							  </li>
							  <li class="nav-item ">
								<a class="nav-link " href="">العروض</a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" href="">عن الشركة</a>
							  </li> 
							</ul>
						  </div>  
					</nav> #nav-bar -->
	
