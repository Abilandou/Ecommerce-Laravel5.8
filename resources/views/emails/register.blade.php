<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td>Dear {{ $name }}</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Your Account Has Been Created Successfully.</br>
                    Your account information is as below:
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $email }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>PassWord: ******* (as chosen by You)</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks for choosing us our Regards</td></tr>
            <tr><td>Ecom site name <a href="{{ url('/account') }}">Continue to login</a></td></tr>
        </tbody>
    </table>
</body>
</html>