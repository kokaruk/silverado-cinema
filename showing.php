<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 26/7/17
 * Time: 2:39 AM
 */
include_once('tools.php');
top_mid_part('Now Showing');
list($movies, $options) = moviesShowing();

?>
    <div class="full-width content-row">
        <div class="nowshowing clearfloat">
            <h2>now showing</h2>
            <?php echo $movies ?>
        </div>
        <div id="bookingform" class="clearfloat">
            <form onsubmit="return boookingValidate();"
                  method="post"
                  id="bookingform"
                  action="bookprocessor.php"
                  >

                <fieldset>
                    <legend><h2>Booking Form</h2></legend>
                    <?php
                        echo  $_formNoIssues ? "" : "<p style=\"color:red\">There was an issue submitting your order, please try again</p>";
                        unset($_SESSION["errors"]);
                    ?>
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
                                var selectedTime =  "" + <?php
                                                    $seatSelect = seatSelect();
                                                    $appendingOrder = appendingOrder();
                                                    $seatSelect === false && $appendingOrder
                                                    ? print "'" . $_POST["session"] . "'" : print "''" ; ?>;
                                var days = {
                                    'MON': 'Monday',
                                    'TUE': 'Tuesday',
                                    'WED': 'Wednesday',
                                    'THU': 'Thursday',
                                    'FRI': 'Friday',
                                    'SAT': 'Saturday',
                                    'SUN': 'Sunday'
                                };
                                var hoursWeek = [1, 6, 9];
                                var hoursWknd = [12, 3, 6, 9];
                                for (var day in days) {
                                    var hours = day === 'SAT' || day === 'SUN' ?  hoursWknd : hoursWeek;
                                    for (var i = 0; i < hours.length; i++) {
                                            var value = day + "-" + hours[i];
                                            var option = days[day] + "&nbsp;" + hours[i] + "pm" ;
                                            var selected = selectedTime === value ? 'selected' : '';
                                            document.writeln("<option " + selected + " value='" + value + "'>" + option + "</option>")
                                    }
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
                        <fieldset >
                            <legend><h3>Seats</h3></legend>
                            <fieldset class="left">
                                <legend>Standard</legend>
                                <div class="clearfloat">
                                    <p><label for="seats[SF]">Adult</label>
                                        <input type='number' name='seats[SF]' id='seats[SF]' value='0'
                                               min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
                                    </p>
                                    <p><label for="seats[SP]">Concession</label>
                                        <input type='number' name='seats[SP]' id='seats[SP]' value='0'
                                               min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
                                    </p>
                                    <p><label for="seats[SC]">Child</label>
                                        <input type='number' name='seats[SC]' id='seats[SC]' value='0'
                                               min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
                                    </p>
                            </fieldset>
                            <fieldset class="left">
                                <legend>First Class</legend>
                                <p><label for="seats[FA]">Adult</label>
                                    <input type='number' name='seats[FA]' id='seats[FA]' value='0'
                                           min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
                                </p>
                                <p><label for="seats[FC]">Child</label>
                                    <input type='number' name='seats[FC]' id='seats[FC]' value='0'
                                           min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
                                </p>
                            </fieldset>
                            <fieldset class="clearfloat">
                                <legend>Bean Bags</legend>
                                <p><label for="seats[BA]">Adult</label>
                                    <input type='number' name='seats[BA]' id='seats[BA]' value='0'
                                           min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
                                </p>
                                <p><label for="seats[BF]">Family</label>
                                    <input type='number' name='seats[BF]' id='seats[BF]' value='0'
                                           min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
                                </p>
                                <p><label for="seats[BC]">Child</label>
                                    <input type='number' name='seats[BC]' id='seats[BC]' value='0'
                                           min="0" max="<?php echo $_maxSeats?>" inputmode="numeric" pattern="[0-9]*"/>
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
                <p id="total">Total: $<span id="totalPrice">0.00</span></p>
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