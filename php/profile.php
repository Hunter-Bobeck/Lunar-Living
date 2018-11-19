<?php
	session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class="background background-dark">
	<?php
		$username = $_SESSION['username'];
		if($_SESSION["usertype"] != 2){
			$_SESSION['chatuser'] = $username;
		}
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
							<?php
							if($_SESSION["usertype"] == 1){
								echo"<li><a href='user_lease.php'>Lease</a></li>
								<li><a href='payment.php'>Payment</a></li>";
							}
							if($_SESSION["usertype"] == 2){
								echo"<li><a href='newlease.php'>New Lease</a></li>";
								echo"<li><a href='allLogin.php'>All Users</a></li>";
								echo"<li><a href='allLease.php'>All Leases</a></li>";
							}
							if($_SESSION["usertype"] == 2){
								echo"<li><a href='adminchat.php'>Chats</a></li>";
							}
							?>
							<li><a href='ticketStatus.php'>Tickets</a></li>
							<?php
							if($_SESSION["usertype"] == 2){
								echo"<li><a href='map.php'>Ticket Map</a></li>";
							}
							?>
							<li><a href='events.php'>Events</a></li>
							<li><a href='laundry.php'>Laundry</a></li>
							<li><a href='review.php'>Review</a></li>
							<?php
							if($_SESSION["usertype"] == 2){
								echo"<li>
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
			<div class='col-sm-5'>
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
			<?php
				$username = $_SESSION['username'];
				$ch = curl_init('https://lunar-living.herokuapp.com/getOxygenLevels');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					"username: $username"
					));
				$data = curl_exec($ch);
				$info = curl_getinfo($ch);
				$oxygenData = json_decode($data);
				curl_close($ch);
			?>
			<div class='col-sm-4'>
			<div class = 'row'>
				<div class='col-sm-12 oxygen'>
					<h2 class='text-centered oxygen-level'>Oxygen Level</h2>
					<button class='save-oxygen' id='updateOxygenBtn' >Save Oxygen</button>
				</div>
				<div id='updateOxygenModal' class='modal'>
					<!-- Modal content -->
					<div class='modal-content'>
						<div class='modal-header'>
							<h2>Save Oxygen</h2>
							<span class='close'>&times;</span>	
						</div>
						<div class='modal-body'>
							<?php
								echo "<br/><span>Select Apt: </span><select id='aptSelect' onChange='showDates(this,". json_encode($oxygenData) .")'>
										<option value='0'>Select Apt</option>";
										foreach($oxygenData as $currLevel){
											echo"<option value='". $currLevel->aptID ."'>". $currLevel->aptID ."</option>";
										}
										echo"   
										</select><br/><br/>";
								echo "<div class='oxygenDetailsOn' id='oxygenDetailsOn'>
										<span style='font-size:35px;'>Oxygen Status: </span><span class='green-dot'></span><br/><button class = 'update' onclick = 'saveOxygen()'>Cancel All Request</button><br/><br/>
									</div>";
								echo "<div class='oxygenDetailsOff' id='oxygenDetailsOff'>
										<span style='font-size:35px;'>Oxygen Status: </span><span class='red-dot'></span><br/><button onclick='cancelAllRequest()' class='update'>Cancel All Request</button><br/><br/>
										<span id='currentDateSpan'></span><br/><br/>
									</div>";
								echo"<div class='form-group dates-picker' id ='dates-picker'>
										<span>No Supply Needed on: </span>
										<input id = 'dates' class='form-control' type='text' name='oxygenDateRange' placeholder='Start Date - End Date'><br/><br/>
									</div>";
							?>
						</div>
						<div class='modal-footer'>
							<button class = 'update' onclick = 'saveOxygen()'>Save</button>
						</div>
					</div>
				</div>
			</div>
			<div class = 'row'>
				<div class='col-sm-2'>
					<?php
					foreach($oxygenData as $currLevel){
						if($currLevel->start_date == null){
							echo"<div><img src='../images/on.jpg' class='progress-bar-image'></div>";
						}
						else{
							$startTime = strtotime($currLevel->start_date);
							$endTime = strtotime($currLevel->end_date);
							$currTime = time();
							if((($currTime >= $startTime) && ($currTime <= $endTime))){
								echo"<div><img src='../images/stop.png' class='progress-bar-image'></div>";
							}
							else{
								echo"<div><img src='../images/on.jpg' class='progress-bar-image'></div>";
							}
						}
					}
					?>
				</div>
				<div class='col-sm-10'>
					<?php
					foreach($oxygenData as $currLevel){
						if($currLevel->amount > 80){
							echo"<div class='progress-bar green stripes'>
							<span style='width: " . $currLevel->amount . "%'>". $currLevel->aptID . "</span>
							<span style='width: " . $currLevel->amount . "%'></span>
							</div>";
						}
						else if($currLevel->amount > 50){
							echo"<div class='progress-bar blue stripes'>
							<span style='width: " . $currLevel->amount . "%'>". $currLevel->aptID . "</span>
							<span style='width: " . $currLevel->amount . "%'></span>
							</div>";
						}
						else if($currLevel->amount > 20){
							echo"<div class='progress-bar orange stripes'>
							<span style='width: " . $currLevel->amount . "%'></span>
							<span style='width: " . $currLevel->amount . "%'>". $currLevel->aptID . "</span>
							</div>";
						}
						else{
							echo"<div class='progress-bar red stripes'>
							<span style='width: " . $currLevel->amount . "%'>". $currLevel->aptID . "</span>
							<span style='width: " . $currLevel->amount . "%'></span>
							</div>";
						}
					}
					?>
				</div>
			</div>
			</div>
		</div>
		<?php
		if($_SESSION["usertype"] != 2){
			echo "<div class='chat-body'>
			<button class='open-button' onclick=\"openForm()\">Chat</button>
			<div class='chat-popup' id='myForm'>
				<div class='form-container'>";
		 	include 'chat.php'; 
			echo"<input class='btn cancel' onclick=\"closeForm()\" value='Close' />
				</div>
			</div>
			</div>";
		}
		?>
	</div>
	<?php include 'footer.php'; ?>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
	<!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
	<script src='../js/moment.min.js'></script>		<!-- Moment JS (necessary for Date Range Picker) -->
    <script src='../js/daterangepicker.min.js'></script>		<!-- Date Range Picker JS (http://www.daterangepicker.com/#usage) -->
    <script>
		$('input[name="oxygenDateRange"]').daterangepicker();
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
		var modalOxygen = document.getElementById('updateOxygenModal');
		var btnOxygen = document.getElementById("updateOxygenBtn");
		var spanOxygen = document.getElementsByClassName("close")[1];
		btnOxygen.onclick = function() {
			modalOxygen.style.display = "block";
		}
		spanOxygen.onclick = function() {
			modalOxygen.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == modal) {
				modalOxygen.style.display = "none";
			}
		}
		function saveOxygen(){
			var dateRange = document.getElementById("dates").value;
			var aptId = document.getElementById("aptSelect").value;
			var ranges = dateRange.split("-");
			window.location.href = 'stopOxygen.php?aptID=' + aptId +"&start_date=" + ranges[0].trim() + "&end_date=" + ranges[1].trim();
		}

		function openForm() {
			document.getElementById("myForm").style.display = "block";
			document.cookie = "deliver=1";
		}
		function closeForm() {
			document.getElementById("myForm").style.display = "none";
			document.cookie = "deliver=0";
		}
        function showDates(current, lease) {
            // Set selected value as variable
			var selectValue = current.options[current.selectedIndex].value;
			var modalOxygenOn = document.getElementById('oxygenDetailsOn');
			var modalOxygenOff = document.getElementById('oxygenDetailsOff');
			var modalOxygenDatePicker = document.getElementById('dates-picker');
			var currentDateSpan = document.getElementById("currentDateSpan");
			// Empty the time select field
			modalOxygenOn.style.display = "none";
			modalOxygenOff.style.display = "none";
			modalOxygenDatePicker.style.display = "none";
            if(selectValue != 0){
				for(var iterator = 0; iterator < lease.length; iterator++){
					var arrayItem = lease[iterator];
					var currAptID = arrayItem.aptID;
					if(currAptID == selectValue){
						var start_date = arrayItem.start_date;
						var end_date = arrayItem.end_date;
						break;
					}
				}
                if(start_date == null){
					modalOxygenOn.style.display = "block";
					modalOxygenDatePicker.style.display = "block";
                }
				else{
					modalOxygenOff.style.display = "block";
					modalOxygenDatePicker.style.display = "block";
					currentDateSpan.textContent = "Current Off Date: " + start_date.substring(0,10) + " to " + end_date.substring(0,10);
				}
			}
		}
		function cancelAllRequest() {
			var aptId = document.getElementById("aptSelect").value;
			window.location.href = 'cancelAllRequest.php?aptID=' + aptId;
		}
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
	<?php
	if($_SESSION["usertype"] != 2){
	echo"<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script>
	<script src='../js/chat.js'></script>";
	}
	?>
</body>
</html>