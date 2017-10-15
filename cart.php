<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 10/10/17
 * Time: 15:34
 */

include_once("tools.php");

if (isset($_GET["remove"])){ //check if received request to delete correct and exists
    if (is_numeric($_GET["remove"])) {
        unset($_SESSION["cart"][$_GET["remove"]]);
    }
}

function cartContent()
{
    $totalOrders = count($_SESSION["cart"]);
    if ($totalOrders > 0) {


        $totalOrdersPostfix = $totalOrders == 1 ? 'order in cart' : 'orders in cart';

        list($orderRows, $grandTotal) = ordersRows();
        $grandTotal = sprintf("$%1.2f", $grandTotal);
        $output = <<<"CARTCONTENT"
        <div id="cartpage">
            <table >
            <thead>
                <tr>
                    <th>$totalOrders $totalOrdersPostfix</th>
                </tr>    
            </thead>
            <tfoot>
               <tr>
                    <td>Grand Total: $grandTotal</td>
               </tr>    
            </tfoot>
            <tbody >
                $orderRows
            </tbody>
        </table>
        </div>
        <form method="post" action="confirm.php" id="bookingform">
            <p>
                <input type="submit" name="appending" value="Proceed To Checkout"/>
            </p>
        </form>
CARTCONTENT;
        echo $output;
    } else {
        echo "<p class='cartCentre'>Cart is Empty</p>";
    }
}


function ordersRows()
{
    global $_filename;
    $filename = $_filename;
    $movieCodes = array("key" => "value");
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $movieCodes["$data[7]"] = $data[1];
        }
        fclose($handle);
    }

    // get url of self
    $here = $_SERVER['SCRIPT_NAME'];
    $bits = explode('/', $here);
    $filename = $bits[count($bits) - 1];

    $orderRow = <<<"orderRow"
    <tr>
        <td>
            <table class="ordersTable">
                <thead>
                    <tr>
                        <td colspan="2" class="table-column-50"><strong>%s</strong><br>%s</td>
                        <td colspan="2" style="text-align: right;"><a href="$filename?remove=%d">Remove from Cart</a></td>
                    </tr>
                    <tr>
                        <th>Ticket Type</th>
                        <th>Cost</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;">Total:</td>
                        <td>$%1.2f</td>
                    </tr>
                </tfoot>
                <tbody>
                    %s
                </tbody>
            </table>
        </td>                   
    </tr>
orderRow;

    $rows = '';
    global $_weekDays;
    $grandTotal = 0;
    foreach ($_SESSION["cart"] as $key => $value){
        $daysArr = explode("-", $_SESSION["cart"][$key]["session"]);
        list($tickets, $orderTotal) = ticketsRows($_SESSION["cart"][$key]["seats"], $daysArr);
        $movieCode = $_SESSION["cart"][$key]["movie"];
        $grandTotal += $orderTotal;
        $rows .= sprintf($orderRow,
            isset($movieCodes["$movieCode"]) ? ucfirst($movieCodes["$movieCode"]) : '&nbsp;', //Movie Name
            "Showing at " . $_weekDays["$daysArr[0]"] . ", " . $daysArr[1] . "pm", // session + time
            $key, // row count
            $orderTotal, //total of this order
            $tickets // tickets rows
        );
    }
    return [$rows, $grandTotal];
}

function ticketsRows($seats, $daysArr) {
    $ticketsRow = <<<'ticketsRow'
    <tr>
        <td class="table-column-30">%s</td>
        <td>$%1.2f</td>
        <td>%d</td>
        <td>$%1.2f</td>
    </tr>
ticketsRow;

    $priceType = in_array($daysArr[0], ["MON","TUE"], true) || (in_array($daysArr[0], ["WED", "THU", "FRI"], true) && $daysArr[1] == "1")
                ? "discount" : "full";
    $ticketRows ='';
    global $_seatType;
    global $_prices;
    $orderTotal = 0;
    foreach ($seats as $key => $value) {
        $price = $_prices["$priceType"]["$key"];
        $subtotal = $price * $value;
        $orderTotal += $subtotal;
        if(!$value) { continue; }
        $ticketRows .= sprintf($ticketsRow,
            $_seatType["$key"][0] . " (" .  $_seatType["$key"][1] . ")", //ticket type
            $price, // price
            $value,  //quantity
            $subtotal
        );
    }

    return [$ticketRows, $orderTotal];
}


?>


<!DOCTYPE html>
<html class="iframe">
<head>
    <link type="text/css" rel="stylesheet" href="css/primary.css">
    <link type="text/css" rel="stylesheet" href="css/responsive.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body id="cartContent">
<div class="outer">
    <div class="middle">
        <div class="inner">
            <?php cartContent(); ?>
        </div>
    </div>
</div>

</body>
</html>