
<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
?>

<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fas fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fas fa-envelope"></i> info@domain.com</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> </a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> </a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fas fa-facebook"></i>@facebook</a></li>
								<li><a href="#"><i class="fas fa-twitter"></i>@twitter</a></li>
								<li><a href="#"><i class="fas fa-linkedin"></i>@linkIn</a></li>
								<li><a href="#"><i class="fas fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fas fa-google-plus"></i>@GooglePlus</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html">
							<!-- <img src="images/frontend_images/home/logo.png" alt="" /> -->
								<h6>Dulfy<span>@ZamaniPrice</span></h6>
							</a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fas fa-user"></i> About</a></li>
								<li><a href="#"><i class="fas fa-star"></i> Contact</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Services</a></li>
								<li><a href="/cart"><i class="fas fa-shopping-cart"></i> Cart</a></li>
								@if(empty(Auth::check()))
								<li><a href="{{url('/login_register') }}"><i class="fas fa-lock"></i> Login</a></li>
								@else
									<li><a href="{{url('/account') }}"><i class="fas fa-user"></i>Account</a></li>
									<li><a href="{{url('/user_logout') }}"><i class="fas fa-star"></i> Logout</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										@foreach($mainCategories as $mainCat)
											@if($mainCat->status == "1")
												<li><a href="{{asset('/products/'.$mainCat->url) }}">{{$mainCat->name}}</a></li>
											@endif
										@endforeach
										<li><a href="/cart">Cart</a></li>
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Adopt<i class="fas fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Young Puppy</a></li>
										<li><a href="blog-single.html">Mature Puppy</a></li>
                                    </ul>
                                </li> 
								<!-- <li><a href="404.html">Ser</a></li>
								<li><a href="contact-us.html">Contact</a></li> -->
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="{{ url('/search_products') }}" method="post">
								{{ csrf_field() }}
								<input 
									type="text" 
									name="product_search" 
									placeholder="Search"
									required
								/>
								<button 
									type="submit"  
									class="btn btn-default btn-mini"
									style=" border-width:1px; margin-left:-3px; border-color:green"
								>Go</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->