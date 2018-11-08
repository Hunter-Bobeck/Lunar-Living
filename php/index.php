<?php
	session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
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
								<span class="heading">User Rating</span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<p>4.1 average based on 254 reviews.</p>
								<hr style="border:3px solid #f1f1f1">

								<div class="row">
								<div class="side">
									<div>5 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
									<div class="bar-5"></div>
									</div>
								</div>
								<div class="side right">
									<div>150</div>
								</div>
								<div class="side">
									<div>4 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
									<div class="bar-4"></div>
									</div>
								</div>
								<div class="side right">
									<div>63</div>
								</div>
								<div class="side">
									<div>3 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
									<div class="bar-3"></div>
									</div>
								</div>
								<div class="side right">
									<div>15</div>
								</div>
								<div class="side">
									<div>2 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
									<div class="bar-2"></div>
									</div>
								</div>
								<div class="side right">
									<div>6</div>
								</div>
								<div class="side">
									<div>1 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
									<div class="bar-1"></div>
									</div>
								</div>
								<div class="side right">
									<div>20</div>
								</div>
							</div>
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