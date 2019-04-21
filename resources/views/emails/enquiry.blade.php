<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>contact Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td>Contact Message From <?php echo( $email ) ?> On Ecommerce</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>The above name is making enquiry concerning the following:</br>

                </td>
            </tr>
            <tr><td>&nbsp</td></tr>
            <tr><td>Customer Name: <?php echo($name)?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Customer Email: <?php echo( $email ) ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Subject:<?php echo( $subject ) ?> </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Message:<?php echo( $user_message ) ?> </td></tr>
        </tbody>
    </table>
</body>
</html>
