@extends('layouts.frontLayout.front_design')
@section('content')


<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    @foreach($allBanners as $key => $banner)
                        <li data-target="#slider-carousel" data-slide-to="{{$key}}" class="@if($key==0) active @endif"></li>
                    @endforeach
                    </ol>
                    <div class="carousel-inner">
                    @foreach($allBanners as $key => $banner)
                        <div class="item @if($key==0) active @endif">
                            <div class="col-sm-12">
                               <a href="images/frontend_images/banners/{{$banner->image }}"> 
                                    <img src="images/frontend_images/banners/{{$banner->image }}" class="img img-responsive" alt="" /> 
                               </a>
                           </div>
                        </div>
                    @endforeach
                    </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section><!--/slider-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Recent Products</h2>
                    @foreach($productsAll as $product)
                        @if($product->status == "1" && $product->featured_item == "1")
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" width="120" height="170" alt="" />
                                                <h2>${{$product->price}}</h2>
                                                <p>{{$product->product_name}}</p>
                                                <a href="{{url('/product/'.$product->id) }}" class="btn btn-danger btn-lg add-to-cart"><i class="fa fa-shopping-cart"></i>Order</a>
                                            </div>
                                            <!-- <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>${{$product->price}}</h2>
                                                    <p>{{$product->product_name}}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Order</a>
                                                </div>
                                            </div> -->
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    @endforeach
                    <div class="pagination">
                        <ul>
                            <li>{{ $productsAll->links()  }}</li>
                        </ul>
                    </div>
                </div><!--features_items-->  
            </div>
        </div>
    </div>
</section>


@endsection