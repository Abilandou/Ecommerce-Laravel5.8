<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset PassWord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td>Dear <?php echo( $name ) ?></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Your Request For A New PassWord is Granted.</br>
                    Your Account information is below with new Password :
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: <?php echo( $email ) ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>New PassWord:<?php echo( $password ) ?> </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks for choosing us our Regards.</td></tr>
            <tr><td>Ecom site name <a href="{{ url('/login_register') }}">Continue to login</a></td></tr>
        </tbody>
    </table>
</body>671855818
</html>