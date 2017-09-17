<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 26/7/17
 * Time: 2:39 AM
 */
?>
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
    <title>The Silverado Cinema</title>
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
    <!-- menu by Elwyn -->
    <div id="menu" class="container clearfloat shadow">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="showing.php">Now Showing</a></li>
            <!--   <li><a href="#location">Location</a></li>
               <li><a href="#contact">Contact</a></li>
               <li><a href="#about">About</a></li> -->
        </ul>
    </div>
    <div id="dropmenu" class="clearfloat container" style="display: none;">
        <select  title="submenu navigation"  name="dropmenu" onchange="window.location.href=this.value">
            <option value="">Menu</option>
            <option value="index.php">Home</option>
            <option value="showing.php">Now Showing</option>
        </select>
    </div>
</nav>
<main id="wrap">
    <div id="page" class="masthead clearfloat">
        <div id="maincont" class="container">
            <div class="full-width left">
                <div class="content full-page clearfloat shadow">
                    <div class="content-row whitecontent">
                        <div class="full-width">
                            <H1>Silverado</H1>

                            <p>All bells and whistles of a big-town multiplex cinema-theatre for a much more affordable
                                price.</p>
                            <p>
                                Our aim is to bring the very best mix of arthouse, contemporary and classic cinema
                                enriched
                                with loads of specially curated film festivals, Talking Picture events and HD Captured
                                stage
                                performances.</p>
                            <ul>
                                <li>Dolby&trade; sound and picture</li>
                                <li>Upgraded 3d projection.</li>
                                <li>Reclining Goldclass seats.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="content-row bluecontent">
                        <div class="full-width">
                            <h2>upgraded sitting</h2>
                        </div>
                        <div class="column-50 left">
                            <img id="floorplan" src="img/floorplan.png"/>
                        </div>
                        <div class="mast_desc">
                            <p>40 Normal seats, booking options:</p>
                            <ul>
                                <li>Full adult</li>
                                <li>Concession adult</li>
                                <li>Child under 12</li>
                            </ul>
                            <p>12 First Class seats, booking options:</p>
                            <ul>
                                <li>Adult</li>
                                <li>Child under 12</li>
                            </ul>
                            <p>13 Bean Bag seats, booking options:</p>
                            <ul>
                                <li>Adult (2 adults)</li>
                                <li>Family (1 adult + 1 child)</li>
                                <li>Child (3 children under 12)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="content-row whitecontent">
                        <div class="full-width">
                            <h2>The Total Cinema Experience</h2>
                            <h3>Dramatic Imaging</h3>
                            <p>Astonishing brightness, deep darks, and vibrant colors in Dolby Vision&trade; render each moment with spectacular impact.</p>
                            <h3>Moving Audio</h3>
                            <p>Breathtaking sound in Dolby Atmos &copy; fills the room and flows all around you. Astonishing brightness, deep darks and vibrant colors render each moment with spectacular impact. Breathtaking sound in Dolby&reg; fills the room and flows all around you. The sleek, power recliners reverberate to move you deep into the story.</p>
                            <h3>Inspired Design</h3>
                            <p>Ideal environment and premium seats draw you in and maximize your enjoyment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="container clearfloat footer shadow">
    <div class="footer-padding footer-cont">
        <div class="foot-col">
            <h2>Silverado Cinema &copy; <?php echo date("Y"); ?></h2>
            <p>The best seat in town</p>

        </div>
        <div class="foot-col">
            <p><a target="_blank" href="http://www.dolby.com/us/en/platforms/dolby-cinema.html">About Dolby&trade;
                    Technology</a></p>
        </div>
    </div>
</footer>
</body>
