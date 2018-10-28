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
    <title>Lunar Living | Home</title>		<!-- title -->

	<!-- CSS -->
	<link rel='stylesheet' href='../css/reset.css'>		<!-- Reset CSS -->
    <link rel='stylesheet' href='../css/bootstrap.min.css'>		<!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/fontawesome.min.css'>		<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='../css/style.css'>		<!-- custom CSS -->
</head>
<body>
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
						<a class='nav-link' href='../newlease.html'>New Lease</a>
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
                echo"<a class='login-link' href = '../login.html'>Login</a>";
            }
            ?>
		</nav>
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
				</div>
				<div class='col-sm-9'>
					<section class='index-details'>
						<div>
							<div class='name-heading'><strong>Rental Apartments</strong></div>
							<img src='../images/apt1.jpg'>
							<img src='../images/apt2.jpg'>
							<img src='../images/apt3.jpg'>
							<img src='../images/apt4.jpg'>
						</div>
					</section>
				</div>
			</div>
		</div>
		<div id='spacer-index-after-banner'></div>

		<footer class='footer'>
			<div class='container'>
				Copyright 2018 IU-SE-G2
			</div>
		</footer>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
	<!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
	<script src='../js/moment.min.js'></script>		<!-- Moment JS (necessary for Date Range Picker) -->
	<script src='../js/daterangepicker.min.js'></script>		<!-- Date Range Picker JS (http://www.daterangepicker.com/#usage) -->
	<script type='text/javascript'>
		$('input[name="scheduleAppointmentDatePicker"]').daterangepicker();
		var myIndex = 0;
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
			setTimeout(carousel, 2000); // Change image every 2 seconds
		}
	</script>
</body>
</html>