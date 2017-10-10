<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 26/7/17
 * Time: 2:39 AM
 */
include_once('tools.php');
top_mid_part('Now Showing');
list($movies, $options) = moviesShowing('data/movies.csv');
function moviesShowing($filename)
{
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
            $options .= sprintf('<option value="%s">%s</option>', $data[7], $data[1]) . "\n";
        }
        fclose($handle);
    }
    return array($movies, $options);
}

?>
    <div class="full-width content-row">
        <div class="nowshowing clearfloat">
            <h2>now showing</h2>
            <?php echo $movies ?>
        </div>
        <div id="bookingform" class="clearfloat">
            <form method='post'
                  action="https://titan.csit.rmit.edu.au/~e54061/wp/silverado-test.php"
                  target="_blank">
                <fieldset>
                    <legend><h2>Booking Form</h2></legend>
                    <div class="left"><label for="movie">Movie</label>
                        <select name='movie' id="movie" required>
                            <?php echo $options; ?>
                        </select>
                    </div>
                    <div class="left clearfloat">
                        <label for="session">Session</label>
                        <select name='session' id="session" required>
                            <option value="">Please Select</option>
                            <script type="text/javascript">
                                var days = {
                                    'MON': 'Monday',
                                    'TUE': 'Tuesday',
                                    'WED': 'Wednesday',
                                    'THU': 'Thursday',
                                    'FRI': 'Friday',
                                    'SAT': 'Saturday',
                                    'SUN': 'Sunday'
                                };
                                var hours = [12, 15, 18];
                                for (var day in days) {
                                    for (var i = 0; i < hours.length; i++) {
                                        document.writeln("<option value='" + day + "-" + hours[i] + "'>" + days[day] + "&nbsp;" + hours[i] + ":00</option>")
                                    }
                                }
                            </script>
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
                    <button>Add to Cart</button>
                </p>
            </form>
        </div>
    </div>
<?php
include_once('footer.php')
?>