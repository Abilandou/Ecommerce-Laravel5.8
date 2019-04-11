@extends('layouts.frontLayout.front_design')
@section('content')

<section>
    <div class="container">
        <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">orders</li>
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
                        <th class="btn-primary text-center">Order ID</th>
                        <th class="btn-danger text-center">Ordered Products</th>
                        <th class="btn-success text-center">Payment Method</th>
                        <th class="btn-info text-center">Grand Total</th>
                        <th class="btn-warning text-center">Ordered Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userOrdersMade as $orderMade)
                    <tr>
                        <td class="text-center">{{ $orderMade->id }}</td>
                        <td class="text-center">
                            @foreach($orderMade->orders as $pro)
                              <a href="{{ url('/orders/'.$orderMade->id) }}"> <i>Name</i>-- {{ $pro->product_name }},<i>code</i>--
                                <small>{{ $pro->product_code }}</a>,</small><br />
                            @endforeach
                        </td>
                        <td class="text-center">{{ $orderMade->payment_method }}</td>
                        <td class="text-center">${{ $orderMade->grand_total }}</td>
                        <td class="text-center">{{ $orderMade->created_at }}</td>
                       
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>  
            </div>
        </div>
    </div>
</section>


@endsection