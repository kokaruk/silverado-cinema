<?php
function top_mid_part($pageTitle)
{
    $navigation = navMenu();
    $output = <<<"TOPMIDDLE"
    <!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/primary.css">
    <link type="text/css" rel="stylesheet" href="css/responsive.css">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <script src="bin/wireframe.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>The Silverado Cinema - $pageTitle</title>
</head>
<body>
<header>
    <!-- wireframe switch -->
    <div id="wireframe">
        <span>
            <input type="checkbox" id="wireframecss" onchange="loadCSS()">
            <label for="wireframecss">Wireframe CSS</label>
        </span>
    </div>
    <div class="container wrap header clearfloat">
        <a href="index.php"><img src="img/logo_blue.png" height="122"/></a>
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
}

function navMenu()
    {
        $menuOptions = ['index.php' => 'Home', 'showing.php' => 'Now Showing'];
        $topMenu = "";
        $mobileMenu = "";
        foreach ($menuOptions as $key => $value) {
            $topMenu .= "<li><a href=\"{$key}\">$value</a></li>\r\n";
            $mobileMenu .= "<option value=\"{$key}\">$value</option>\r\n";
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

function getDebugURL(){
    return $_SERVER['SERVER_NAME'] == 'titan.csit.rmit.edu.au'
                                    ? '/home/eh1/e54061/public_html/wp/debug.php'
                                    : 'debug-lite.php';
}