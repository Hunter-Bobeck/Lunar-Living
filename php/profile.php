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
<body class="background background-moon-in-space">
	<?php
		// make sure to remove this line.. It is just static field for testing
		$_SESSION['username'] = 'szpatel@iu.edu';

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
							<li class='active'><a href='#'>Profile</a></li>
							<li><a href='user_lease.php'>Lease</a></li>
							<li><a href='#'>Payment</a></li>
							<li><a href='#'>Tickets</a></li>
						</ul>
					</aside>
				</div>
			</div>
			<div class='col-sm-8'>
				<div class='card'>
					<img src='../images/profile.jpg' alt='ProfileImage' style='width:100%'>
					<?php
					echo "<h2>". $apiData->first_name ." ". $apiData->last_name ."</h2>
					<p>". $apiData->gender ."</p>"
					?>
					<button class='update' id='updateProfileBtn'>Update Profile</button>
				</div>
				<div id='updateProfileModal' class='modal'>
					<!-- Modal content -->
					<div class='modal-content'>
						<div class='modal-header'>
							<h2>Update Profile</h2>
							<span class='close'>&times;</span>	
						</div>
						<div class='modal-body'>
							<?php
								echo "</br><span>First Name:&nbsp;&nbsp;&nbsp;&nbsp;</span><input id= 'first_name' value=". $apiData->first_name ."></br></br>
								<span>Last Name:&nbsp;&nbsp;&nbsp;&nbsp;</span><input id= 'last_name' value=". $apiData->last_name ."></br></br>
								<span>Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								<select id= 'gender'>";
									switch($apiData->gender){
										case 'Male':
											echo"<option value='Male' selected = 'selected'>Male</option>
											<option value='Female'>Female</option>
											<option value='Other'>Other</option>";
											break;
										case 'Female':
											echo"<option value='Male'>Male</option>
											<option value='Female' selected = 'selected'>Female</option>
											<option value='Other'>Other</option>";
											break;
										case 'Other':
											echo"<option value='Male'>Male</option>
											<option value='Female'>Female</option>
											<option value='Other' selected = 'selected'>Other</option>";
											break;
									}
							  	echo "</select></br></br>";
							?>
						</div>
						<div class='modal-footer'>
							<button class = 'update' onclick = 'updateUser()'>Update</button>
						</div>
					</div>
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
		// Get the modal
		var modal = document.getElementById('updateProfileModal');
		// Get the button that opens the modal
		var btn = document.getElementById("updateProfileBtn");
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			modal.style.display = "block";
		}
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		function updateUser(){
			var first_name = document.getElementById("first_name").value;
			var last_name = document.getElementById("last_name").value;
			var gender = document.getElementById("gender").value;
			window.location.href = 'updateProfile.php?firstName=' + first_name +"&lastName=" + last_name + "&gender=" + gender;
		}
	</script>
</body>
</html>