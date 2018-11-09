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
		$userData = curl_exec($ch);

		// get info about the request
		$info = curl_getinfo($ch);

		if($userData == 'false'){
		echo "User Not Found";
		}
		else {
			$userInfoData = json_decode($userData);
		}

		// close curl resource to free up system resources
		curl_close($ch);
	?>
	<main class = "content_body">
        <div class='container-fluid padding-zero'>
            <?php include 'signInNavbar.php'; ?>
        </div>
        <div class="container-fluid userlease_container">
            <div class="row">
                <div class="col-sm-3">
                    <div class='wrapper'>
                        <aside class='main_sidebar'>
                            <ul>
                                <li><a href='profile.php'>Profile</a></li>
                                <li><a href='user_lease.php'>Lease</a></li>
                                <li><a href='payment.php'>Payment</a></li>
                                <li><a href='#'>Tickets</a></li>
                                <li class='active'><a href='#'>Stats</a></li>
                                <li><a href='review.php'>Review</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-9">
                    
                </div>
            </div>
        </div>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
    <script>
        function callPayment(aptID, username, amount){
            window.location.href = "paymentpage.php?aptID=" + aptID;
        }
    </script>
</body>
</html>