<?php
session_start();
?>


<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class="background background-dark">
    <?php

		$username = $_SESSION['username'];
		//setup the request, you can also use CURLOPT_URL
		$ch = curl_init('https://lunar-living.herokuapp.com/getUserLease');

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
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Hello, ". $userInfoData->first_name ."</button>
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
        <div class="container-fluid userlease_container">
            <div class="row">
                <div class="col-sm-3">
                    <div class='wrapper'>
                        <aside class='main_sidebar'>
                            <ul>
                                <li><a href='profile.php'>Profile</a></li>
                                <li><a href='user_lease.php'>Lease</a></li>
                                <li class='active'><a href='#'>Payment</a></li>
                                <li><a href='#'>Tickets</a></li>
                                <li><a href='review.php'>Review</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="container">
                        <h2 class = 'lease_info'>Payments</h2>
                        <a href='payment.php'><h4 class = 'shift-right link-prop'>&lt;&nbspPayment<h4></a><br>
                        <div class='row table-wrapper-scroll-y'>
                        <?php
                        $leaseArray = $apiData->Lease;
                        $index = 1;
                        echo"
                        <table class='table table-dark table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Apt Name</th>
                                <th scope='col'>Paid By</th>
                                <th scope='col'>Paid Amount</th>
                                <th scope='col'>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($leaseArray as $lease){
                            $ch = curl_init('https://lunar-living.herokuapp.com/paymentHistory');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                'Content-Type: application/json',
                                "apt_name: $lease->aptID"
                                ));
                            $data = curl_exec($ch);
                            $info = curl_getinfo($ch);
                            $paymentData = json_decode($data);
                            curl_close($ch);
                            foreach($paymentData as $payment){
                                echo"
                                <tr>
                                    <th scope='row'>". $payment->paymentID ."</th>
                                    <td>". $lease->aptID ."</td>
                                    <td>". $payment->username ."</td>
                                    <td>$". $payment->amount ."</td>
                                    <td>". substr($payment->paidOn, 0, 10) ."</td>
                                </tr>
                                ";
                            }
                        $index++;
                        }
                        echo"
                            </tbody>
                        </table>";
                        ?>
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
        function callPayment(aptID, username, amount){
            window.location.href = "paymentpage.php?aptID=" + aptID;
        }
    </script>
</body>
</html>