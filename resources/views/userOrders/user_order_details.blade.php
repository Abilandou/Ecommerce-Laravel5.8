@extends('layouts.frontLayout.front_design')
@section('content')

<section>
    <div class="container">
        <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="{{ url('/orders') }}">orders</a></li>
                    <li class="active">{{ $orderDetails->id }}</li>
                </ol>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
            <table id="userOrderstable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="btn-primary text-center">Product Code</th>
                        <th class="btn-success text-center">Product Name</th>
                        <th class="btn-info text-center">Product Size</th>
                        <th class="btn-warning text-center">Product Colo</th>
                        <th class="btn-danger text-center">Product Price</th>
                        <th class="btn-default text-center">Product Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetails->orders as $proDet)
                    <tr>
                        <td class="text-center">{{ $proDet->product_code }}</td>
                        <td class="text-center">{{ $proDet->product_name }} </td>
                        <td class="text-center">{{ $proDet->product_size }} </td>
                        <td class="text-center">{{ $proDet->product_color }} </td>
                        <td class="text-center">${{ $proDet->product_price }} </td>
                        <td class="text-center">{{ $proDet->product_quantity }} </td>
                    </tr>
                    @endforeach
                   
                </tbody>
                
            </table>  
            <a href="{{ url('/orders') }}"><p style="float:right;" class="text-primary btn-primary">back to orders</p></a>
            </div>
        </div>
    </div>
</section>


@endsection