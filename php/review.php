<?php
	session_start();
?>
<!doctype html>
<html lang='en'>
<head>
	<!-- metadata -->
    <meta charset='utf-8'>	<!-- Unicode characterset -->
    <meta http-equiv='X-UA-Compatible' content='IE=epdge'>	<!-- Internet Explorer compatibility -->
    <meta name='viewport' content='width=device-width, initial-scale=1'>	<!-- renders the page according to the device width -->
    <meta name='description' content='Rent a living space, in outer space.'>		<!-- description [shown on searchengine result] -->
    <meta name='keywords' content='Kidd, Living, space, rental, service, management, system, SpaceX, outer, Elon, Musk'>		<!-- keywords for searchengine optimization -->
    <meta name='author' content='IU SE G2'>		<!-- author name -->
    <link rel='icon' href='../images\Icon.ico'>		<!-- favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Lunar Living | Home</title>		<!-- title -->

	<!-- CSS -->
	<link rel='stylesheet' href='../css/reset.css'>		<!-- Reset CSS -->
    <link rel='stylesheet' href='../css/bootstrap.min.css'>		<!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/fontawesome.min.css'>		<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='../css/style.css'>		<!-- custom CSS -->
</head>
<body class="background background-night-sky">
	<?php
		$username = $_SESSION['username'];
		//setup the request, you can also use CURLOPT_URL
		$ch = curl_init('https://lunar-living.herokuapp.com/getUserDetails');

		// Returns the data/output as a string instead of raw data
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
		curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');

		//Set your auth headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			"username: $username"
			));

		// get stringified data/output. See CURLOPT_RETURNTRANSFER
		$data = curl_exec($ch);

		// get info about the request
		$info = curl_getinfo($ch);

		if($data == 'false'){
		echo "User Not Found";
		}
		else {
			$apiData = json_decode($data);
		}

		// close curl resource to free up system resources
        curl_close($ch);
        
        $ch = curl_init('https://lunar-living.herokuapp.com/getReviews');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			"rating: 5"
			));
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
		$fiveStar = json_decode($data)->total;
        curl_close($ch);
        
        $ch = curl_init('https://lunar-living.herokuapp.com/getReviews');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			"rating: 4"
			));
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
		$fourStar = json_decode($data)->total;
        curl_close($ch);
        
        $ch = curl_init('https://lunar-living.herokuapp.com/getReviews');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			"rating: 3"
			));
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
		$threeStar = json_decode($data)->total;
        curl_close($ch);
        
        $ch = curl_init('https://lunar-living.herokuapp.com/getReviews');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			"rating: 2"
			));
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
		$twoStar = json_decode($data)->total;
        curl_close($ch);
        
        $ch = curl_init('https://lunar-living.herokuapp.com/getReviews');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			"rating: 1"
			));
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
		$oneStar = json_decode($data)->total;
		curl_close($ch);
	?>
	<main class = 'content_body'>
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
            if(isset($_SESSION['username'])){
			    echo"<ul class='navbar-nav ml-auto'>";
                    echo "<li>
					<div class='dropdown'>
						<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Hello, ". $apiData->first_name ."</button>
						<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
							<a class='dropdown-item' href='#'>Signout</a>
						</div>
					</div>
                    </li>";
                echo "</ul>";
            }
            else{
                echo"<a class='login-link' href = 'login.php'>Login</a>";
            }
            ?>
		</nav>
	</div>
	<div class='container userlease_container'>
		<div class='row'>
			<div class='col-sm-4'>
				<div class='wrapper'>
					<aside class='main_sidebar'>
						<ul>
                            <li><a href='profile.php'>Profile</a></li>
							<li><a href='user_lease.php'>Lease</a></li>
							<li><a href='#'>Payment</a></li>
                            <li><a href='#'>Tickets</a></li>
                            <li class='active'><a href='#'>Review</a></li>
						</ul>
					</aside>
				</div>
			</div>
			<div class='col-sm-8'>
                <h2 class = 'lease_info'>Review Us</h2>
                <div class = 'rating-section right-space'>
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    </fieldset><br><br><br>
                    <button class='btn btn-info btn-md margin-right' onclick='rateMe()'>Submit Review</button>
                </div>
                <br><br>
                <div class='user-review'>
                    <?php
                    $totalVotes = $fiveStar + $fourStar + $threeStar + $twoStar + $oneStar;
                    $sum = 5 * $fiveStar + 4 * $fourStar + 3 * $threeStar + 2 * $twoStar + $oneStar;
                    if($totalVotes == 0){
                        $avg = 0;
                        $fiveWidth = 0;
                        $fourWidth = 0;
                        $threeWidth = 0;
                        $twoWidth = 0;
                        $oneWidth = 0;
                    }
                    else{
                        $avg = $sum / $totalVotes;
                        $fiveWidth = ($fiveStar/$totalVotes) * 100;
                        $fourWidth = ($fourStar/$totalVotes) * 100;
                        $threeWidth = ($threeStar/$totalVotes) * 100;
                        $twoWidth = ($twoStar/$totalVotes) * 100;
                        $oneWidth = ($oneStar/$totalVotes) * 100;
                    }
                    echo"
                    <span class='heading'>User Rating</span>";
                    if($avg >= 1){
                        echo "<span class='fa fa-star checked'></span>";
                    }
                    else{
                        echo "<span class='fa fa-star'></span>";
                    }
                    if($avg >= 2){
                        echo "<span class='fa fa-star checked'></span>";
                    }
                    else{
                        echo "<span class='fa fa-star'></span>";
                    }
                    if($avg >= 3){
                        echo "<span class='fa fa-star checked'></span>";
                    }
                    else{
                        echo "<span class='fa fa-star'></span>";
                    }
                    if($avg >= 4){
                        echo "<span class='fa fa-star checked'></span>";
                    }
                    else{
                        echo "<span class='fa fa-star'></span>";
                    }
                    if($avg >= 5){
                        echo "<span class='fa fa-star checked'></span>";
                    }
                    else{
                        echo "<span class='fa fa-star'></span>";
                    }
                    echo"
                    <p>". $avg . " average based on ". $totalVotes . " reviews.</p>
                    <hr style='border:3px solid #f1f1f1'>
                    <div class='row'>
                    <div class='side'>
                        <div>5 star</div>
                    </div>
                    <div class='middle'>
                        <div class='bar-container'>
                        <div class='bar-5' style='width:". $fiveWidth ."%;'></div>
                        </div>
                    </div>
                    <div class='side right'>
                        <div>". $fiveStar ."</div>
                    </div>
                    <div class='side'>
                        <div>4 star</div>
                    </div>
                    <div class='middle'>
                        <div class='bar-container'>
                        <div class='bar-4' style='width:". $fourWidth ."%;'></div>
                        </div>
                    </div>
                    <div class='side right'>
                        <div>". $fourStar ."</div>
                    </div>
                    <div class='side'>
                        <div>3 star</div>
                    </div>
                    <div class='middle'>
                        <div class='bar-container'>
                        <div class='bar-3' style='width:". $threeWidth ."%;'></div>
                        </div>
                    </div>
                    <div class='side right'>
                        <div>". $threeStar ."</div>
                    </div>
                    <div class='side'>
                        <div>2 star</div>
                    </div>
                    <div class='middle'>
                        <div class='bar-container'>
                        <div class='bar-2' style='width:". $twoWidth ."%;'></div>
                        </div>
                    </div>
                    <div class='side right'>
                        <div>". $twoStar ."</div>
                    </div>
                    <div class='side'>
                        <div>1 star</div>
                    </div>
                    <div class='middle'>
                        <div class='bar-container'>
                        <div class='bar-1' style='width:". $oneWidth ."%;'></div>
                        </div>
                    </div>
                    <div class='side right'>
                        <div>". $oneStar ."</div>
                    </div>";
                    ?>
                </div>
			</div>
		</div>
	</div>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->	
    <script>
        function rateMe(){
            var starValue = $("input[name='rating']:checked").val();
            window.location.href = 'submitreview.php?rating=' + starValue;
        }
    </script>
</body>
</html>