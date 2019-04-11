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
            <tr><td>
                    Account Activation Needed.<br/>
                    Please Click on below link to activate your account:
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a href="{{ url('/confirm/'.$code) }}">Activate Account.</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks for choosing us our Regards</td></tr>
            <tr><td>Ecom site name </td></tr>
        </tbody>
    </table>
</body>
</html>