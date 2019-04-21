@extends('layouts.frontLayout.front_design')
@section('content')


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                @include('layouts.frontLayout.front_sidebar')
            </div>
            <div class="col-sm-8 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">{{$cmsPageDetails->title}}</h2>
                        <h4>{{$cmsPageDetails->sub_title_one}}</h4>
                            <p>{{$cmsPageDetails->description}}</p>

                        <h4>
                            {{$cmsPageDetails->sub_title_two}}
                        </h4>
                            <p>
                                {{$cmsPageDetails->content_two}}
                             </p>

                        <h4>
                            {{$cmsPageDetails->sub_title_three}}
                        </h4>
                            <p>
                                {{$cmsPageDetails->content_three}}
                            </p>
                </div><!--features_items-->  
            </div>
        </div>
    </div>
</section>


@endsection