<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 26/7/17
 * Time: 2:39 AM
 */
include_once('tools.php');
top_mid_part('Now Showing');

list($mId, $mTitle, $mTypeDescr, $mSynonpsis, $mRunningTime, $mDirector, $mCast, $mType) = movieData($_filename);

function movieData($filename)
{
    $movieData = '';
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) != FALSE) {
            if ($data[0] == $_GET['movie']) {
                $movieData = $data;
                break;
            }
        }
    }
    fclose($handle);
    return $movieData;
}


function movieInfo()
{
    global $mId, $mTitle, $mSynonpsis, $mRunningTime, $mDirector, $mCast;
    $movie = <<<"MOVIE"
                <h2>$mTitle</h2>
            <div>
                <div class="movie-detailed-wrapper content">
                        <div class="movie-detailed">
                                <img src="img/$mId.jpg" alt="$mTitle"/>
                        </div>
                        <div>
                            <p><strong>Running Time:</strong> $mRunningTime</p>
                            <p><strong>Director:</strong> $mDirector</p>
                            <p><strong>Cast:</strong> $mCast</p>
                            <p id="synopsis">$mSynonpsis</p>
                        </div>
                </div>
            </div>
MOVIE;
    echo $movie;
}

?>
    <div class="full-width content-row">
        <div class="nowshowing clearfloat">
            <?php movieInfo() ?>
        </div>
        <div id="bookingform" class="clearfloat">
            <form onsubmit="return boookingValidate();"
                  method="post"
                  id="bookingform"
                  action="bookprocessor.php">
                <fieldset>
                    <legend><h2>Book Movie Now</h2></legend>

                    <div class="left clearfloat">
                        <input type="hidden" name="movie" id="movie" value="<?php echo $mType ?>">
                        <label for="session">Session</label>
                        <select name='session' id="session" required>
                            <option value="">Please Select</option>
                            <!-- php below re-selects dropdown optios, they get reset when validation fails -->
                            <script type="text/javascript">
                                var selectedTime = "" + <?php
                                    $seatSelect = seatSelect();
                                    $appendingOrder = appendingOrder();
                                    $seatSelect === false && $appendingOrder
                                        ? print "'" . $_POST["session"] . "'" : print "''"; ?>;
                                var sessions = {
                                    "AC" : ["WED-9", "THU-9", "FRI-9", "SAT-9", "SUN-9"],
                                    "CH" : ["MON-1", "TUE-1", "WED-6", "THU-6", "FRI-6", "SAT-12", "SUN-12"],
                                    "RC" : ["MON-9", "TUE-9", "WED-1", "THU-1", "FRI-1", "SAT-6", "SUN-6"],
                                    "AF" : ["MON-6", "TUE-6", "SAT-3", "SUN-3"]
                                };
                                var days = {
                                    'MON': 'Monday',
                                    'TUE': 'Tuesday',
                                    'WED': 'Wednesday',
                                    'THU': 'Thursday',
                                    'FRI': 'Friday',
                                    'SAT': 'Saturday',
                                    'SUN': 'Sunday'
                                };
                                var typeSessions = sessions['<?php echo $mType ?>'];
                                for (var ii = 0; ii < typeSessions.length;ii++) {
                                    var sessionsSplit = typeSessions[ii].split("-");
                                    var option = days[sessionsSplit[0]] + "&nbsp;" + sessionsSplit[1] + "pm";
                                    var selected = selectedTime === typeSessions[ii] ? 'selected' : '';
                                    document.writeln("<option " + selected + " value='" + typeSessions[ii] + "'>" + option + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                    <div class="clearfloat"></div>
                    <div id="seats" class="clearfloat
                    <?php $seatSelect = seatSelect();
                    $appendingOrder = appendingOrder();
                    if ($seatSelect === false && $appendingOrder)
                        echo 'errorgroup' ?>">
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
                            <?php
                            $seatSelect = seatSelect();
                            $appendingOrder = appendingOrder();
                            if ($seatSelect === false && $appendingOrder)
                                echo "<p style=\"color:red\">Must select at least one seat</p>" ?>
                        </fieldset>
                    </div>
                </fieldset>
                <p id="total">Total: $<spsan id="totalPrice">0.00</spsan></p>
                <p>
                    <input type="submit" name="appending" value="Add to Cart"/>
                </p>
            </form>
        </div>
    </div>
    <script src="bin/calculation.js"></script>
<?php
include_once('footer.php')
?>