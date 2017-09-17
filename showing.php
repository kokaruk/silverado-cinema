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
        <a href="index.php"><img src="img/logo_blue.png"/></a>
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
        <select title="submenu navigation" name="dropmenu" onchange="window.location.href=this.value">
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
                <div class="content full-page shadow">
                    <div class="full-width content-row">
                        <div class="nowshowing clearfloat">
                            <h2>now showing</h2>
                            <div>
                                <div class="movie">
                                    <a href="#">
                                        <div class="movie-inner">
                                            <div class="movie-item">

                                                <img src="img/HO00004815.jpg" alt="Atomic Blonde"/>

                                            </div>
                                            <div class="movie-info">
                                                <img class="img-blur" src="img/HO00004815.jpg" alt="Atomic Blonde"/>
                                                <div class="movie-info-inner">
                                                    <div class="movie-info-inner-title">
                                                        <h3>Atomic Blonde</h3>
                                                        <p>action</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie">
                                    <a href="#">
                                        <div class="movie-inner">
                                            <div class="movie-item">
                                                <img src="img/HO00004950.jpg" alt="Diary of a Wimpy Kid"/>
                                            </div>
                                            <div class="movie-info">
                                                <img class="img-blur" src="img/HO00004950.jpg"/>
                                                <div class="movie-info-inner">
                                                    <div class="movie-info-inner-title">
                                                        <h3>Diary of a Wimpy Kid</h3>
                                                        <p>childrens</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <div class="movie">
                                    <a href="#">
                                        <div class="movie-inner">
                                            <div class="movie-item">

                                                <img src="img/HO00005257.jpg" alt="big sick"/>

                                            </div>
                                            <div class="movie-info">
                                                <img class="img-blur" src="img/HO00005257.jpg"/>
                                                <div class="movie-info-inner">
                                                    <div class="movie-info-inner-title">
                                                        <h3>big sick</h3>
                                                        <p>Romantic Comedy</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie">
                                    <a href="#">
                                        <div class="movie-inner">
                                            <div class="movie-item">

                                                <img src="img/HO00005496.jpg" alt="My Neighbour Totoro"/>

                                            </div>
                                            <div class="movie-info">
                                                <img class="img-blur" src="img/HO00005496.jpg"/>
                                                <div class="movie-info-inner">
                                                    <div class="movie-info-inner-title">
                                                        <h3>My Neighbour Totoro</h3>
                                                        <p>Art / Foreign</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="bookingform" class="clearfloat">
                            <form method='post'
                                  action="https://titan.csit.rmit.edu.au/~e54061/wp/silverado-test.php?ref=showing"
                                  target="_blank">
                                <fieldset>
                                    <legend><h2>Booking Form</h2></legend>
                                    <div class="left"><label for="movie">Movie</label>
                                        <select name='movie' id="movie" required>
                                            <option value="">Please Select</option>
                                            <option value='AC'>Aromic Blonde</option>
                                            <option value='RC'>Diary of a Wimpy Kid</option>
                                            <option value='CH'>The big sick</option>
                                            <option value='AF'>My Neighbour Totoro</option>
                                        </select>
                                    </div>

                                    <div class="left clearfloat">
                                        <label for="session">Session</label>
                                        <select name='session' id="session" required>
                                            <option value="">Please Select</option>
                                            <option value='MON-13'>MON-13</option>
                                            <option value='MON-18'>MON-18</option>
                                            <option value='MON-21'>MON-21</option>
                                            <option value='TUE-13'>TUE-13</option>
                                            <option value='TUE-18'>TUE-18</option>
                                            <option value='TUE-21'>TUE-21</option>
                                            <option value='WED-13'>WED-13</option>
                                            <option value='WED-18'>WED-18</option>
                                            <option value='WED-21'>WED-21</option>
                                            <option value='THU-13'>THU-13</option>
                                            <option value='THU-18'>THU-18</option>
                                            <option value='THU-21'>THU-21</option>
                                            <option value='FRI-13'>FRI-13</option>
                                            <option value='FRI-18'>FRI-18</option>
                                            <option value='FRI-21'>FRI-21</option>
                                            <option value='SAT-12'>SAT-12</option>
                                            <option value='SAT-15'>SAT-15</option>
                                            <option value='SAT-18'>SAT-18</option>
                                            <option value='SAT-21'>SAT-21</option>
                                            <option value='SUN-12'>SUN-12</option>
                                            <option value='SUN-15'>SUN-15</option>
                                            <option value='SUN-18'>SUN-18</option>
                                            <option value='SUN-21'>SUN-21</option>
                                        </select>
                                    </div>
                                    <div class="clearfloat"></div>
                                    <div class="clearfloat">
                                        <fieldset>
                                            <legend><h3>Seats</h3></legend>
                                            <fieldset class="left">
                                                <legend>Standard</legend>
                                                <div class="clearfloat">
                                                    <p><label for="seats[SF]">Adult</label>
                                                        <input type='number' name='seats[SF]' id='seats[SF]' value='0'
                                                               min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                    </p>
                                                    <p><label for="seats[SP]">Concession</label>
                                                        <input type='number' name='seats[SP]' id='seats[SP]' value='0'
                                                               min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                    </p>
                                                    <p><label for="seats[SC]">Child</label>
                                                        <input type='number' name='seats[SC]' id='seats[SC]' value='0'
                                                               min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                    </p>
                                            </fieldset>
                                            <fieldset class="left">
                                                <legend>First Class</legend>
                                                <p><label for="seats[FA]">Adult</label>
                                                    <input type='number' name='seats[FA]' id='seats[FA]' value='0'
                                                           min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                </p>
                                                <p><label for="seats[FC]">Child</label>
                                                    <input type='number' name='seats[FC]' id='seats[FC]' value='0'
                                                           min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                </p>
                                            </fieldset>
                                            <fieldset class="clearfloat">
                                                <legend>Bean Bags</legend>
                                                <p><label for="seats[BA]">Adult</label>
                                                    <input type='number' name='seats[BA]' id='seats[BA]' value='0'
                                                           min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                </p>
                                                <p><label for="seats[BF]">Family</label>
                                                    <input type='number' name='seats[BF]' id='seats[BF]' value='0'
                                                           min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                </p>
                                                <p><label for="seats[BC]">Child</label>
                                                    <input type='number' name='seats[BC]' id='seats[BC]' value='0'
                                                           min="0" max="10" inputmode="numeric" pattern="[0-9]*"/>
                                                </p>
                                            </fieldset>
                                        </fieldset>
                                </fieldset>
                                <p>
                                    <button>Book</button>
                                </p>
                            </form>
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
