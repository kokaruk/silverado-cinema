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



<svg style="display:none">
    <defs>
        <symbol viewBox="0 0 38 38" id="icon-cross">
            <path d="M19 17.6l5.3-5.4 1.4 1.4-5.3 5.4 5.3 5.3-1.4 1.4-5.3-5.3-5.3 5.3-1.4-1.4 5.2-5.3-5.2-5.3 1.4-1.4 5.3 5.3z"/>
        </symbol>
        <symbol viewBox='0 0 150 130' id="icon-loading">
            <title>Loading</title>
            <path d='M81.5 33l30.8-32.8c0.3-0.3 0.5-0.2 0.3 0.3 -1.8 5.2-1.7 15.3-1.7 15.3 -0.1 6.8-0.8 11.7-6.6 17.9L74.8 65.1c-0.2 0.2-0.4 0-0.3-0.2 1.5-5.1 1.2-15.1 1.2-15.1C75.4 45.6 76.4 38.4 81.5 33M105.9 54.8l43.8 10.3c0.4 0.1 0.4 0.4-0.2 0.4 -5.4 1-14.1 6.1-14.1 6.1 -6 3.3-10.5 5.2-18.8 3.2l-41.9-9.9c-0.3-0.1-0.2-0.3 0-0.4 5.2-1.3 13.7-6.5 13.7-6.5C92 55.9 98.7 53.1 105.9 54.8M99.4 86.3l13 43.2c0.1 0.4-0.1 0.5-0.4 0.1 -3.6-4.2-12.4-9.2-12.4-9.2 -5.8-3.5-9.7-6.5-12.2-14.6L75 64.5c-0.1-0.3 0.2-0.4 0.3-0.2 3.7 3.9 12.5 8.6 12.5 8.6C91.5 74.8 97.3 79.2 99.4 86.3M68.7 97l-30.8 32.8c-0.3 0.3-0.5 0.2-0.3-0.3 1.8-5.2 1.7-15.3 1.7-15.3 0.1-6.8 0.8-11.7 6.6-17.9l29.5-31.4c0.2-0.2 0.4 0 0.3 0.2 -1.5 5.1-1.2 15.1-1.2 15.1C74.8 84.4 73.8 91.6 68.7 97M44.1 75.8L0.3 65.4C-0.1 65.3-0.1 65 0.5 65c5.4-1 14.1-6.1 14.1-6.1 6-3.3 10.5-5.2 18.8-3.2l41.9 9.9c0.3 0.1 0.2 0.3 0 0.4 -5.2 1.3-13.7 6.5-13.7 6.5C58.1 74.7 51.3 77.5 44.1 75.8M50.2 43.8l-13-43.2c-0.1-0.4 0.1-0.5 0.4-0.1C41.2 4.7 50 9.7 50 9.7c5.8 3.5 9.7 6.5 12.2 14.6l12.4 41.3c0.1 0.3-0.2 0.4-0.3 0.2 -3.7-3.9-12.5-8.6-12.5-8.6C58.1 55.4 52.4 50.9 50.2 43.8'/>
        </symbol>
    </defs>
</svg>

<script  src="bin/modal.js"></script>

</body>
</html>

<?php
function getDebugURL(){
    return $_SERVER['SERVER_NAME'] == 'titan.csit.rmit.edu.au'
        ? '/home/eh1/e54061/public_html/wp/debug.php'
        : 'debug-lite.php';
}
    include_once (getDebugURL());
?>