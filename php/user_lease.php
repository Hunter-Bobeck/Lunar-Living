<?php
session_start();
?>


<!doctype html>
<html lang='en'>
<?php include 'header.php';?>
<link rel='stylesheet' href='../css/user_lease.css'>
<body class='animation-background'>
<canvas id="canvas"></canvas>
    <?php

$username = $_SESSION['username'];
$first_name = $_SESSION['firstName'];
//setup the request, you can also use CURLOPT_URL
$ch = curl_init('https://lunar-living.herokuapp.com/getUserLease');

// Returns the data/output as a string instead of raw data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');

//Set your auth headers
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    "username: $username",
));

// get stringified data/output. See CURLOPT_RETURNTRANSFER
$data = curl_exec($ch);

// get info about the request
$info = curl_getinfo($ch);

if ($data == 'false') {
    echo "User Not Found";
} else {
    $apiData = json_decode($data);
}

// close curl resource to free up system resources
curl_close($ch);
?>
	<main class = "content_body">
        <div class='container-fluid padding-zero'>
            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <a class='navbar-brand' href='index.php'><img src='../images\Title.png' class='title'></a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>

                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav mr-auto'>
                        <li class='nav-item active'>
                            <a class='nav-link current-lunar-living-nav-link' href='index.php'>Home <span class='sr-only'>(current)</span></a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='newlease.php'>New Lease</a>
                        </li>
                    </ul>
                </div>

                <?php
                if (isset($_SESSION['username'])) {
                    echo "<ul class='navbar-nav ml-auto'>";
                    echo "<li>
                        <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Hello, " . $first_name . "</button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                <a class='dropdown-item' href='#]logout.php'>Signout</a>
                            </div>
                        </div>
                        </li>";
                echo "</ul>";
                } else {
                    echo "<a class='login-link' href = 'login.php'>Login</a>";
                }
                ?>
            </nav>
        </div>
        <div class="container-fluid userlease_container">
            <div class="row">
                <div class="col-sm-3">
                    <div class='wrapper'>
                        <aside class='main_sidebar'>
                            <ul>
                                <li><a href='profile.php'>Profile</a></li>
                                <?php
                                if ($_SESSION["usertype"] == 1) {
                                    echo "<li class='active'><a href='user_lease.php'>Lease</a></li>
                                                                    <li><a href='payment.php'>Payment</a></li>";
                                }
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li><a href='newlease.php'>New Lease</a></li>";
                                    echo "<li><a href='allLogin.php'>All Users</a></li>";
                                    echo "<li><a href='allLease.php'>All Leases</a></li>";
                                    echo "<li><a href='appointments.php'>All Appointments</a></li>";
                                    echo "<li><a href='allpromocodes.php'>All Promo Codes</a></li>";
                                }
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li><a href='adminchat.php'>Chats</a></li>";
                                }
                                ?>
                                <li><a href='ticketStatus.php'>Tickets</a></li>
                                <?php
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li><a href='map.php'>Ticket Map</a></li>";
                                }
                                ?>
                                <li><a href='events.php'>Events</a></li>
                                <li><a href='laundry.php'>Laundry</a></li>
                                <li><a href='review.php'>Review</a></li>
                                <?php
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li>
                                        <a onclick='displayStats()' href='#'>Stats</a>
                                        <ul id='statsChilds' class= 'statsChilds'>
                                            <li><a href='paymentstats.php'>Payment Stats</a></li>
                                            <li><a href='ticketstats.php'>Ticket Area Stats</a></li>
                                            <li><a href='ticketstatsstatus.php'>Ticket Status Stats</a></li>
                                        </ul>
                                    </li>";
                                }
                                ?>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-9 side-col">
                    <div class="container">
                    <span data-shadow-text="Text-Shadow" class='user_lease_info'>Signed Leases</span><br><br><br>
                    <div class='row'>
                        <?php
                        $leaseArray = $apiData->Lease;
                        $index = 1;
                        foreach ($leaseArray as $lease) {
                            echo "
                                <div class='col-sm-3'>
                                    <div class='tour'>
                                        <a class='tour-img' style='background-image: url(../images/apt.jpg);' href='user_lease_details.php?aptID=" . $lease->aptID . "&groupNo=" . $lease->groupNo . "&startDate=" . substr($lease->start_date, 0, 10) . "&endDate=" . substr($lease->end_date, 0, 10) . "'>
                                            <p class='price'><span id=lease" . $index . ">Apt " . $lease->aptID . "</span></p>
                                        </a>
                                    </div>
                                </div>";
                            $index++;
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php';?>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
    <script>
        function displayStats(){
			var statsChilds = document.getElementById("statsChilds");
			if(statsChilds.style.display == "none"){
				statsChilds.style.display = "block";
			}
			else{
				statsChilds.style.display = "none";
			}
		}
    </script>
    <script>
		function fn() {
			window.requestAnimFrame = (function () {
				return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (callback) {
							window.setTimeout(callback, 1000 / 60);
						}
			})();
			var canvas = document.getElementById('canvas'), ctx = canvas.getContext('2d'), w = canvas.width = window.innerWidth, h = canvas.height = window.innerHeight, hue = 217, stars = [], count = 0, maxStars = 1200;
			var canvas2 = document.createElement('canvas'), ctx2 = canvas2.getContext('2d');
			canvas2.width = 100;
			canvas2.height = 100;
			var half = canvas2.width / 2, gradient2 = ctx2.createRadialGradient(half, half, 0, half, half, half);
			gradient2.addColorStop(0.025, '#fff');
			gradient2.addColorStop(0.1, 'hsl(' + hue + ', 61%, 33%)');
			gradient2.addColorStop(0.25, 'hsl(' + hue + ', 64%, 6%)');
			gradient2.addColorStop(1, 'transparent');
			ctx2.fillStyle = gradient2;
			ctx2.beginPath();
			ctx2.arc(half, half, half, 0, Math.PI * 2);
			ctx2.fill();
			function random(min, max) {
				if (arguments.length < 2) {
					max = min;
					min = 0
				}
				if (min > max) {
					var hold = max;
					max = min;
					min = hold
				}
				return Math.floor(Math.random() * (max - min + 1)) + min
			}

			function maxOrbit(x, y) {
				var max = Math.max(x, y), diameter = Math.round(Math.sqrt(max * max + max * max));
				return diameter / 2
			}

			var Star = function () {
				this.orbitRadius = random(maxOrbit(w, h));
				this.radius = random(60, this.orbitRadius) / 12;
				this.orbitX = w / 2;
				this.orbitY = h / 2;
				this.timePassed = random(0, maxStars);
				this.speed = random(this.orbitRadius) / 900000;
				this.alpha = random(2, 10) / 10;
				count++;
				stars[count] = this
			};
			Star.prototype.draw = function () {
				var x = Math.sin(this.timePassed) * this.orbitRadius + this.orbitX, y = Math.cos(this.timePassed) * this.orbitRadius + this.orbitY, twinkle = random(10);
				if (twinkle === 1 && this.alpha > 0) {
					this.alpha -= 0.05
				} else if (twinkle === 2 && this.alpha < 1) {
					this.alpha += 0.05
				}
				ctx.globalAlpha = this.alpha;
				ctx.drawImage(canvas2, x - this.radius / 2, y - this.radius / 2, this.radius, this.radius);
				this.timePassed += this.speed
			};
			for (var i = 0; i < maxStars; i++) {
				new Star()
			}
			function animation() {
				ctx.globalCompositeOperation = 'source-over';
				ctx.globalAlpha = 0.8;
				ctx.fillStyle = 'hsla(' + hue + ', 64%, 6%, 1)';
				ctx.fillRect(0, 0, w, h);
				ctx.globalCompositeOperation = 'lighter';
				for (var i = 1, l = stars.length; i < l; i++) {
					stars[i].draw()
				}
				;
				window.requestAnimationFrame(animation)
			}

			animation();
		}
		fn();
	</script>
</body>
</html>