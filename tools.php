<?php
session_start();
function top_mid_part($pageTitle)
{
    $navigation = navMenu();
    $output = <<<"TOPMIDDLE"
<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet prefetch" href="css/primary.css">
    <link type="text/css" rel="stylesheet" href="css/responsive.css">
    <link type="text/css" rel="stylesheet" href="css/modalstyle.css"
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
    <div id="cart">
    <img src="img/account.svg" alt="account">
    <a 
       data-modalTitle=""  
       data-modalDesc="" 
       href="https://www.google.com/maps/place/147+Wardour+St,+Soho,+London+W1F+8WD,+UK/@51.514197,-0.134724,16z/data=!4m5!3m4!1s0x487604d357825039:0xf0c170d8fa918a9b!8m2!3d51.5141967!4d-0.1347244?hl=en-GB" 
       data-modal="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4175.8218601402605!2d-0.1390235133502716!3d51.51397674271494!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604d357825039%3A0xf0c170d8fa918a9b!2s147+Wardour+St%2C+Soho%2C+London+W1F+8WD%2C+UK!5e0!3m2!1sen!2sin!4v1468326690641">
      <img src="img/cart.svg" alt="cart" />
    </a>
    
    
        
        
        
    </div>
        <a href="index.php"><img src="img/logo_blue.png" height="122" alt="Silverado Cinema"/></a>
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
