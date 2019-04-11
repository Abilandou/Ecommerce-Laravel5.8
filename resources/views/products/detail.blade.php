@extends('layouts.frontLayout.front_design')
@section('content')


<section>
	<div class="container">
		<div class="row">
		@if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block" style="background-color:hotpink;">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong >{!! session('flash_message_error') !!}</strong>
            </div>
        @endif         
        @if(Session::has('flash_message_success'))
            <div class="alert alert-error alert-block" style="background-color:lightblue;">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif       
			<div class="col-sm-3">
				@include('layouts.frontLayout.front_sidebar')
			</div>
			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
								<a href="{{ asset('images/backend_images/products/large/'.$productDetails->image) }}">
									<img width="300px" class="mainImage" src="{{ asset('images/backend_images/products/medium/'.$productDetails->image) }}" alt="" />
								</a>
							</div>
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							<b><i>Other Views of this product.</i></b>
							<hr/>
								<!-- Wrapper for slides -->
								<div class="carousel-inner">
									<div class="item active thumbnails">
										<a href="{{ asset('images/backend_images/products/large/'.$productDetails->image) }}"
											data-standard="{{ asset('images/backend_images/products/small/'.$productDetails->image) }}"
										>
											<!-- <img class="changeImage" style="width=80px;" class="mainImage" src="{{ asset('images/backend_images/products/small/'.$productDetails->image) }}" alt="" /> -->
										</a>
										@foreach($produtAltImages as $altimage)
											<a href="{{ asset('images/backend_images/products/large/'.$altimage->image) }}"
												data-standard="{{ asset('images/backend_images/products/small/'.$altimage->image) }}"
											>
												<img  class="changeImage" width="80px" src="{{ asset('images/backend_images/products/small/'.$altimage->image) }}" alt="">
											</a>
										@endforeach
									</div>
								</div>
						</div>

					</div>
					<div class="col-sm-7">
						<form name="addtocartForm" id="addtocartForm" action="{{url('add_cart')}}"
							method="post">		
						
							{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $productDetails->id }}">
							<input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
							<input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
							<input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
							<input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">

							<div class="product-information"><!--/product-information-->
								<h2><b>Name:</b> {{ $productDetails->product_name }}</h2>
								<p><b>Code:</b>{{ $productDetails->product_code }}</p>
								<span>
								<label ">Quantity:</label>
									<input id="proQuantity" type="number" name="quantity" value="1"  min="1" max="10" />
								<p><br />
								<p>Select Size</p>
									<select name="size" id="selectSize" >
										
										@foreach($productDetails->attributes as $sizes)
										<option value="{{$productDetails->id}}-{{ $sizes->size }}">{{ $sizes->size }}</option>
										@endforeach
									</select>
								</p>
								</span>

								<span>
									<span id="getPrice" style="margin-left:15px;"> ${{ $productDetails->price }}</span>
									@if($total_stock > 0)
										<button type="submit" class="btn btn-fefault cart btn-lg" id="cartButton">
											<i class="fa fa-shopping-cart"></i>
											Order
										</button>
									@endif
								</span>
								
								<p><b>Availability:</b><span id="Availability">@if($total_stock > 0) In Stock @else Not In Stock @endif</p><span>
								<p><b>Condition:</b> Healthy</p>
		
							</div><!--/product-information-->
						</form>

					</div>
				</div><!--/product-details-->
				
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
							<li><a href="#care" data-toggle="tab">Material & Care</a></li>
							<li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="description" >
							<div class="col-sm-12">
								<p>{{ $productDetails->description }}</p>
							</div>
						</div>
						
						<div class="tab-pane fade" id="care" >
							<div class="col-sm-12">
								<p>{{ $productDetails->care }}</p>
							</div>
						</div>
						
						<div class="tab-pane fade" id="delivery" >
							<div class="col-sm-12">
								<p>Write stuffs concerning your delivery here</p>
							</div>
						</div>
						
						
					</div>
				</div><!--/category-tab-->
				
				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>
					
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php $count=1; ?>
							@foreach($relatedProducts->chunk(3) as $chunk)
							<div <?php if($count==1) { ?> class="item active" <?php } else {
								?> class="item" <?php }?>
							>
								@foreach($chunk as $item)
								@if($item->status==1)	
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
											<a href="{{ url('product/'.$item->id) }}">
												<img style="width=230px;"  
													src="{{ asset('images/backend_images/products/small/'.$item->image) }}" alt="" 
												/>
											</a>
												<h2>${{$item->price}}</h2>
												<p>{{$item->product_name}}</p>
												<a href="{{ url('product/'.$item->id) }}">
													<button type="button" class="btn btn-default add-to-cart">
														<i class="fa fa-shopping-cart"></i>Add to cart
													</button>
												</a>
											</div>
										</div>
									</div>
								</div>
								@endif
								@endforeach
								
							</div>
							<?php $count++; ?>
							@endforeach
						</div>
							<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
							</a>
							<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
							</a>			
					</div>
				</div><!--/recommended_items-->
				
			</div>
		</div>
	</div>
</section>


@endsection