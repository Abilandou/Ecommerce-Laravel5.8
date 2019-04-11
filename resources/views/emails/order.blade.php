<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <table class="table" width='700px;'>
        <tr><td>&nbsp;</td></tr>
        <tr><td><img scr="{{ asset('images/frontend_images/home/logo.png') }}"></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Hello {{ $name }} {{ $last_name }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Than for shopping with us your order is below:</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Order No:{{ $order_id }} </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>
            <table width="95%" cellpadding="5" cellspacing="5" backgroundcolor="#CCCCCC">
                <tr>
                    <tr>
                        <thead>
                            <td>Product Name</td>
                            <td>Product Code</td>
                            <td>Size</td>
                            <td>Color</td>
                            <td>Quantity</td>
                            <td>Unit Price</td>
                        </thead>
                    </tr>
                    <tr>
                        <tbody>
                        @foreach($productDetails['orders'] as $product)
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->product_color }}</td>
                            <td>{{ $product->product_size }}</td>
                            <td>{{ $product->product_quantity }}</td>
                            <td>${{ $product->product_price}}</td>
                        @endforeach
                        </tbody>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Shipping Charges</td>
                        <td>${{ $productDetails['shipping_charges'] }} </td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Total Payable</td>
                        <td>${{ $productDetails['grand_total'] }} </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <table>
                                <tr>
                                    <td>Bill To:</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['last_name'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['address'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['state'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['city'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['country'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['pincode'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['mobile'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tr>
            </table>
        </td></tr>
    </table>
</body>
</html>