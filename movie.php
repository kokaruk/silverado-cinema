<?php
/**
 * Created by PhpStorm.
 * User: dimz
 * Date: 26/7/17
 * Time: 2:39 AM
 */
include_once('tools.php');
top_mid_part('Now Showing');
function movieInfo($filename){
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) != FALSE) {
            if ($data[0] == $_GET['movie']) {
                $movie = <<<"MOVIE"
                <h2>$data[1]</h2>
            <div>
                <div class="movie-detailed-wrapper content">
                        <div class="movie-detailed">
                                <img src="img/$data[0].jpg" alt="$data[1]"/>
                        </div>
                        <div>
                            <p><strong>Running Time:</strong> $data[4]</p>
                            <p><strong>Director:</strong> $data[5]</p>
                            <p><strong>Cast:</strong> $data[6]</p>
                            <p id="synopsis">$data[3]</p>
                        </div>
                </div>
            </div>
MOVIE;
                echo $movie;
                break;
            }
        }
    }
    fclose($handle);
}
?>
    <div class="full-width content-row">
        <div class="nowshowing clearfloat">
            <?php movieInfo('data/movies.csv') ?>
        </div>
    </div>

<?php
include_once('footer.php')
?>