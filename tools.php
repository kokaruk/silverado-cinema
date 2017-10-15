<?php
//start session
session_start();

/* global vars */
$_filename = 'data/movies.csv';
$_maxSeats = 10;
$_formNoIssues = isset($_SESSION["errors"]) ? $_SESSION["errors"] : true;
$_seatArrayNoIssues = isset($_SESSION["seatserror"]) ? $_SESSION["errors"] : true;

$_weekDays = [
    'MON' => 'Monday',
    'TUE' => 'Tuesday',
    'WED' => 'Wednesday',
    'THU' => 'Thursday',
    'FRI' => 'Friday',
    'SAT' => 'Saturday',
    'SUN' => 'Sunday'
];

$_seatType = [
    "SF" => ["Standard", "Full"],
    "SP" => ["Standard","Concession"],
    "SC" => ["Standard","Child"],
    "FA" => ["First Class", "Adult"],
    "FC" => ["First Class","Child"],
    "BA" => ["Bean Bag", "Adult"],
    "BF" => ["Bean Bag","Family"],
    "BC" => ["Bean Bag", "Child"]
];

$_prices = [
    "full" => ["SF" => 18.5, "SP" => 15.5, "SC" => 12.5, "FA" => 30, "FC" => 25, "BA" => 33, "BF" => 30, "BC" => 30],
    "discount" => ["SF" => 12.5, "SP" => 10.5, "SC" => 8.5, "FA" => 25, "FC" => 20, "BA" => 22, "BF" => 20, "BC" => 20]
];

// validate data has seats and other mandatory values
function seatSelect()
{
    /*
     originally was checking if submitting form only now also confirms the s
     */
    $seatSelect = false;
    $appendingOrder = appendingOrder();
    if ($appendingOrder) {
        // check if seats array has greater than 0 numbers
        // iterate over all numbers
        global $_maxSeats;
        foreach ($_POST["seats"] as $key => $value) {
            if (is_numeric($value) && $value > 0 && $value <= $_maxSeats) {
                $seatSelect = true;
                break;
            }
        }
    }
    return $seatSelect;
}

function appendingOrder()
{
    return isset($_POST["appending"]);
}

function top_mid_part($pageTitle)
{
    // highlight current menu item
    $here = $_SERVER['SCRIPT_NAME'];
    $bits = explode('/', $here);
    $filename = $bits[count($bits) - 1];

    $navigation = navMenu();
    $cartContentCount = count($_SESSION["cart"]);
    $output = <<<"TOPMIDDLE"
<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet prefetch" href="css/primary.css">
    <link type="text/css" rel="stylesheet" href="css/responsive.css">
    <link type="text/css" rel="stylesheet" href="css/modalstyle.css">
    <style>nav a[href$="$filename"] { background-color: rgba(60,74,83,0.5); }</style>
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <script src="bin/validators.js"></script>
    <script src="bin/wireframe.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>The Silverado Cinema - $pageTitle</title>
</head>
<body>
<header>
   
    <div class="container wrap header clearfloat">
        <div id="cart">
           <!-- <a href="account.php" data-modal="">
                <img src="img/account.svg" alt="account"></a> 
                login / logout account. <!-- TODO create login / logout
                -->
            <a href="cart.php" data-modal="">
                <img src="img/cart.svg" alt="cart" />($cartContentCount)</a>
        </div>
        <a href="index.php">
            <img src="img/logo_blue.png" height="122" alt="Silverado Cinema"/>
        </a>
    </div>
</header>
<nav>
   $navigation
</nav>
<main id="wrap">
    <div id="page" class="masthead clearfloat">
        <div id="maincont" class="container">
            <div class="full-width left">
                <div class="content full-page clearfloat shadow">
TOPMIDDLE;
    echo $output;
    echo false;
}

function navMenu()
{
    $menuOptions = ['Home' => 'index.php', 'Now Showing' => 'showing.php'];
    $topMenu = "";
    $mobileMenu = "";
    foreach ($menuOptions as $key => $value) {
        $topMenu .= "<li><a href=\"{$value}\">$key</a></li>\r\n";
        $mobileMenu .= "<option value=\"{$value}\">$key</option>\r\n";
    }
    $navigation = <<< "MENUSECTION"
        <div id="menu" class="container clearfloat shadow">
        <ul>
            $topMenu
        </ul>
    </div>
    <div id="dropmenu" class="clearfloat container" style="display: none;">
        <select  title="submenu navigation"  name="dropmenu" onchange="window.location.href=this.value">
            <option value="">Menu</option>
            $mobileMenu
        </select>
    </div>
MENUSECTION;
    return $navigation;
}

function moviesShowing()
{
    global $_filename;
    $filename = $_filename;
    $row = 1;
    $movies = "";
    $options = '<option value="">Please Select</option>' . "\n";
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $movie = <<<"MOVIE"
                <div class="movie">
                    <a href="movie.php?movie=$data[0]">
                        <div class="movie-inner">
                            <div class="movie-item">
                                <img src="img/$data[0].jpg" alt="$data[1]"/>
                            </div>
                            <div class="movie-info">
                                <img class="img-blur" src="img/$data[0].jpg" alt="$data[1]"/>
                                <div class="movie-info-inner">
                                    <div class="movie-info-inner-title">
                                        <h3>$data[1]</h3>
                                        <p>$data[2]</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
MOVIE;
            $row % 2 == 0
                ? $movie .= "\n</div>\n"
                : $movie = "<div>\n" . $movie . "\n";
            $movies .= $movie;
            $row++;
            $seatSelect = seatSelect();
            $appendingOrder = appendingOrder();
            $seatSelect === false && $appendingOrder
                ? $options .=
                sprintf('<option value="%s" %s>%s</option>',
                    $data[7],
                    $_POST["movie"] == $data[7] ? 'selected' : '',
                    ucfirst($data[1])) . "\n"
                : $options .= sprintf('<option value="%s">%s</option>', $data[7], ucfirst($data[1])) . "\n";
        }
        fclose($handle);
    }
    return array($movies, $options);
}
