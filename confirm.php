<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 10/10/17
 * Time: 15:34
 */


include_once("tools.php");


function confirm()
{
    $totalOrders = count($_SESSION["cart"]);
    if ($totalOrders > 0) {

        $output = <<<"CONFIRMORDER"
        <form method="post" action="confirmprocessor.php" id="bookingform" 
            name="bookingform" onsubmit="return confirmValidate();" target="_parent">
        <p>
            <fieldset>
                <legend id="cartpage">Confirm your details</legend>
                <div class="clearfloat">
                    <p><label for="confirmName">Full name</label>
                        <input type='text' name='confirm[Name]' 
                            title="Input valid characters. Latin letters Only." placeholder="First Last"
                            id='confirmName' pattern="^[a-zA-Z \-.']+$" autofocus required/>
                    </p>
                     <p><label for="confirmEmail">Email</label>
                        <input type='email' name='confirm[Email]' id='confirmEmail' 
                        title="Input valid email address" placeholder="name@email.com"
                        pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus required
                        />
                    </p>
                     <p><label for="confirmMobile">Mobile phone</label>
                        <input type='text' name='confirm[Mobile]' id='confirmMobile' 
                        title="Input valid Australian mobile number" placeholder="04 XXXX XXXX"
                        pattern="^(\(04\)|04|\+614)([ ]?\d){8}$" autofocus required/>
                    </p>
            </fieldset>
            <input type="submit" name="appending" value="confirm"/>
        </p>
        </form>
CONFIRMORDER;
        echo $output;
    } else {
        echo "<p class='cartCentre'>Cart is Empty</p>";
    }
}


?>


<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/primary.css">
    <link type="text/css" rel="stylesheet" href="css/responsive.css">
    <link
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <script src="bin/validators.js"></script>
</head>
<body id="cartContent">
<div class="outer">
    <div class="middle">
        <div id="formConfirm" class="inner">
            <?php confirm(); ?>
        </div>
    </div>
</div>
</body>