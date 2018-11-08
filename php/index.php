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
<body class="background">
<?php
	if(isset($_SESSION['username'])){
		// make sure to remove this line.. It is just static field for testing
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
	}
?>
	<main>
	<?php include 'signInNavbar.php'; ?>
		<img class='mySlides' src='../images/mars-city1.jpeg'>
		<img class='mySlides' src='../images/mars-city2.jpg'>
		<img class='mySlides' src='../images/mars-city3.jpg'>
		<img class='mySlides' src='../images/mars-city4.jpeg'>
		<img class='mySlides' src='../images/mars-city5.jpg'>
		<div id='spacer-index-after-banner'></div>
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-sm-3'>
					<section class='contact-sidebar'>
						<div>
							<div>
								<img src='../images/contact.jpeg' alt='Lunar Living Rental Scehma<'>
							</div>
							
							<div>
								<div class='contact-heading'><strong>Lunar Living Rental Scehma</strong></div>
								<div>
									<span class='contact-phone'>&#9742 (812) 111-1212</span>
									<span class='contact-phone'>&#x2709 lunarliving.space@gmail.com</span>
								</div>
							</div>
						</div>	
					</section>
					<div id='spacer-index-after-banner'></div>
					<section class='contact-sidebar'>
						<div>
							<div class='contact-heading'><strong>Schedule a Appointment</strong></div>
							<form>
								<input class='form-control' type='text' id='newlease-start-date' name='scheduleAppointmentDatePicker' placeholder='Select Date'>
							</form>
						</div>
					</section>
					<div id='spacer-index-after-banner'></div>
					<section class='review-sidebar'>
						<div>
							<div class='contact-heading'><strong>Review</strong></div>
							<p>Please Help us improve</p>
							<p><span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star"></span></p>
							<p><button class='btn btn-info btn-md'>Submit a Review</button></p>
						</div>
					</section>
				</div>
				<div class='col-sm-9'>
					<section class='index-details'>
						<div>
							<div class='name-heading'><strong>Rental Apartments</strong></div>
							<p class='tags'><b>Apartment searching can be exciting for tenants- it’s an opportunity for tenants to upgrade their life.<br>Great for entertaining: spacious, updated 2 bedroom, 1 bathroom apartments
							<br>Space is available for you to take photos whenever.</b>
							</p>
							<img class ='aptImg' src='../images/apt1.jpg'>
							<img class ='aptImg' src='../images/apt2.jpg'>
							<img class ='aptImg' src='../images/apt3.jpg'>
							<img class ='aptImg' src='../images/apt4.jpg'>
						</div>
						<div id='spacer-index-after-banner'></div>
						<div class='name-heading'><strong>User Reviews</strong></div>
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
							<span class='heading'>User Rating &nbsp</span>";
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
					</section>
				</div>
			</div>
		</div>
		<div id='spacer-index-after-banner'></div>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
	<!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
	<script src='../js/moment.min.js'></script>		<!-- Moment JS (necessary for Date Range Picker) -->
	<script src='../js/daterangepicker.min.js'></script>		<!-- Date Range Picker JS (http://www.daterangepicker.com/#usage) -->
	<script type='text/javascript'>
		$('input[name="scheduleAppointmentDatePicker"]').daterangepicker();
		var myIndex = 0, reviewIndex = 0;
		carousel();
		function carousel() {
			var i;
			var x = document.getElementsByClassName("mySlides");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";  
			}
			myIndex++;
			if (myIndex > x.length) {myIndex = 1}    
			x[myIndex-1].style.display = "block";  
			setTimeout(carousel, 3500); // Change image every 3.5 seconds
		}
	</script>
</body>
</html>