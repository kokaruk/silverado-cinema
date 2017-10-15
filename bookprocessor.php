<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 14/10/17
 * Time: 17:06
 */

include_once ('tools.php');

// add to cart form processor
try{
    /*
        checks that:
        1. seats array holds ints and within allowed range
        2. $_Post not empty
    */
    $seatSelect = seatSelect();
    // check if movie data is allowed
    $_SESSION["errors"] = checkMovieCodes() && checkDateFormat() ? true : false ;
    $_formNoIssues = $_SESSION["errors"];
    if ($seatSelect && $_formNoIssues) {
        $_SESSION["cart"][] = $_POST;
    }
    header('Location: showing.php');
} catch (Exception $e) {

}


function checkMovieCodes(){
    global $_filename;
    $filename = $_filename;
    $movieCodes = array();
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            array_push($movieCodes, $data[7]);
        }
        fclose($handle);
    }
    return in_array($_POST["movie"], $movieCodes, true);
}


function checkDateFormat() {
     return preg_match('/^(MON|TUE|WED|THU|FRI|SAT|SUN){1}\-\d{1,2}$/', $_POST["session"]);
}


