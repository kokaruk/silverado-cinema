<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 15/10/17
 * Time: 15:36
 */

include_once("tools.php");


if (isset($_POST["confirm"])){
    $_SESSION["customer"] = $_POST;
}

// put cart contents to csv

toCSV();

function toCSV(){
    // cust details
    $name = $_POST["confirm"]["Name"];
    $email = $_POST["confirm"]["Email"];
    $phone = $_POST["confirm"]["Mobile"];


    // build movie codes array
    global $_filename;
    $filename = $_filename;
    $movieCodes = array("key" => "value");
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $movieCodes["$data[7]"] = $data[1];
        }
        fclose($handle);
    }

    // get global session time
    global $_weekDays;

    // global seats
    global $_seatType;

    // write to csv
    if (($handle = fopen("data/orders.txt.csv", "a")) !== FALSE) {

        foreach ($_SESSION["cart"] as $key => $value){
            //movie name
            $movieCode = $_SESSION["cart"][$key]["movie"];
            $movieName = ucfirst($movieCodes["$movieCode"]);
            // session time
            $daysArr = explode("-", $_SESSION["cart"][$key]["session"]);
            $sessionTime = $_weekDays["$daysArr[0]"] . " " . $daysArr[1] . "pm";
            fwrite($handle, $name . ",");
            fwrite($handle, $email . ",");
            fwrite($handle, $phone . ",");
            fwrite($handle, $movieName . ",");
            fwrite($handle, $sessionTime);
            $seats = $_SESSION["cart"][$key]["seats"];
            foreach ($seats as $key => $value){
                if(!$value) { continue; };
                fwrite($handle, "," . $_seatType["$key"][0] . " (" .  $_seatType["$key"][1] . ")" . "x" . $value);
            }
            fwrite($handle, "\n");
        }
        fclose($handle);
    }

}


function cartContent()
{
    if (isset($_POST["confirm"])) {
        $name = $_POST["confirm"]["Name"];
        $email = $_POST["confirm"]["Email"];
        $phone = $_POST["confirm"]["Mobile"];
        $output = <<<"CARTCONTENT"
        <div id="cartpage">
            <table >
            <thead>
                <tr>
                   <th>$name<br>$email<br>$phone</th>
                   <th>
                        <img src="img/logo_blue.png" height="122" alt="Silverado Cinema"/><br>
                        %s <br>
                        %s                
                   </th>
                </tr>
                  
            </thead>
            <tfoot>
                 <tr>
                    <td style="text-align: right;">Total:</td>
                    <td> %1.2f </td>
               </tr> 
            </tfoot>
            <tbody >
               %s
            </tbody>
        </table>
        </div>
CARTCONTENT;

        // build movie codes array
        global $_filename;
        $filename = $_filename;
        $movieCodes = array("key" => "value");
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $movieCodes["$data[7]"] = $data[1];
            }
            fclose($handle);
        }

        // get global session time
        global $_weekDays;

        $orderConfirmation = ''; //output to screen

        foreach ($_SESSION["cart"] as $key => $value) { // for each cart content
            // movie name build
            $movieCode = $_SESSION["cart"][$key]["movie"];
            $movieName = $movieCodes["$movieCode"];
            // session time
            $daysArr = explode("-", $_SESSION["cart"][$key]["session"]);
            $sessionTime = $_weekDays["$daysArr[0]"] . ", " . $daysArr[1] . "pm";
            // tickets list
            list($tickets, $orderTotal) = ticketsRows($_SESSION["cart"][$key]["seats"], $daysArr);

            $orderConfirmation .= sprintf($output,
                $movieName, //movie name
                $sessionTime, // time
                $orderTotal, // order total
                $tickets // tickets

            );
        }
        echo $orderConfirmation;

    } else {
        echo "<p class='cartCentre'>Nothing to see here, move along 🖕</p>";
    }
}

function ticketsRows($seats, $daysArr){
    $ticketsRow = <<<"ticketsRow"
    <tr>
        <td>%s</td>
        <td>%1.2f</td>
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
            $value ." x " .$_seatType["$key"][0] . " (" .  $_seatType["$key"][1] . ")", //ticket type
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
    <?php cartContent(); ?>
    </body>
    </html>