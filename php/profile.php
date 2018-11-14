<?php
	session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class="background background-dark">
	<?php
		$username = $_SESSION['username'];
		$ch = curl_init('https://lunar-living.herokuapp.com/getUserDetails');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			"username: $username"
			));
		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		$userInfoData = json_decode($data);
		curl_close($ch);
		$_SESSION['firstName'] = $userInfoData->first_name;
	?>
	<main class = 'content_body'>
	<div class='container-fluid padding-zero'>
	<?php include 'signInNavbar.php'; ?>
	</div>
	<div class='container-fluid userlease_container'>
		<div class='row'>
			<div class='col-sm-3'>
				<div class='wrapper'>
					<aside class='main_sidebar'>
						<ul>
							<li class='active'><a href='#'>Profile</a></li>
							<li><a href='user_lease.php'>Lease</a></li>
							<li><a href='payment.php'>Payment</a></li>
							<li><a href='#'>Tickets</a></li>
							<li><a href='laundry.php'>Laundry</a></li>
							<li><a href='review.php'>Review</a></li>
						</ul>
					</aside>
				</div>
			</div>
			<div class='col-sm-9'>
				<div class='card'>
					<img src='../images/profile.jpg' alt='ProfileImage' style='width:100%'>
					<?php
					echo "<h2>". $userInfoData->first_name ." ". $userInfoData->last_name ."</h2>
					<p>". $userInfoData->gender ."</p>"
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
								echo "</br><span>First Name:&nbsp;&nbsp;&nbsp;&nbsp;</span><input id= 'first_name' value=". $userInfoData->first_name ."></br></br>
								<span>Last Name:&nbsp;&nbsp;&nbsp;&nbsp;</span><input id= 'last_name' value=". $userInfoData->last_name ."></br></br>
								<span>Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								<select id= 'gender'>";
									switch($userInfoData->gender){
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
		<div class='chat-body'>
			<button class="open-button" onclick="openForm()">Chat</button>
			<div class="chat-popup" id="myForm">
			<div class="form-container">
				<?php include 'chat.php'; ?>
				<input class="btn cancel" onclick="closeForm()" value='Close' />
			</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>
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
		function openForm() {
			document.getElementById("myForm").style.display = "block";
		}
		function closeForm() {
			document.getElementById("myForm").style.display = "none";
		}
	</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script src='../js/chat.js'></script>
</body>
</html>