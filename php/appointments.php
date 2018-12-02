<?php
session_start();
?>


<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class="background background-dark">
    <?php

        $username = $_SESSION['username'];
        $first_name = $_SESSION['firstName'];
        //setup the request, you can also use CURLOPT_URL
        $ch = curl_init('https://lunar-living.herokuapp.com/getAllAppointment');
        // Returns the data/output as a string instead of raw data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');

        //Set your auth headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
            ));

        // get stringified data/output. See CURLOPT_RETURNTRANSFER
        $data = curl_exec($ch);
        // get info about the request
        $info = curl_getinfo($ch);
        $allAppointments = json_decode($data);
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
                                <?php
                                if($_SESSION["usertype"] == 1){
                                    echo"<li><a href='user_lease.php'>Lease</a></li>
                                    <li><a href='payment.php'>Payment</a></li>";
                                }
                                if($_SESSION["usertype"] == 2){
                                    echo"<li><a href='newlease.php'>New Lease</a></li>";
                                    echo"<li><a href='allLogin.php'>All Users</a></li>";
                                    echo"<li><a href='allLease.php'>All Leases</a></li>";
                                    echo"<li class='active'><a href='#'>All Appointments</a></li>";
                                    echo"<li><a href='allpromocodes.php'>All Promo Codes</a></li>";
                                }
                                if($_SESSION["usertype"] == 2){
                                    echo"<li><a href='adminchat.php'>Chats</a></li>";
                                }
                                ?>
                                <li><a href='ticketStatus.php'>Tickets</a></li>
                                <?php
                                if($_SESSION["usertype"] != 1){
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
                <div class="col-sm-9">
                    <div class="container">
                        <h2 class = 'lease_info'>Coming Appointments</h2>
                        <div class='row table-wrapper-scroll-y'>
                        <?php
                        echo"
                        <table class='table table-dark table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>Appointment ID</th>
                                <th scope='col'>UserInfo</th>
                                <th scope='col'>Date</th>
                                <th scope='col'>Time</th>
                                <th scope='col'>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($allAppointments as $appointment){
                            echo"
                            <tr>
                                <th scope='row'>". $appointment->appointmentID ."</th>
                                <td>". $appointment->userInfo ."</td>
                                <td>". substr($appointment->visitDate, 0, 10) ."</td>
                                <td>". $appointment->visitTime ."</td>";
                                if($appointment->status == 0){
                                    echo"<td><button class = 'btn btn-info btn-md' onclick=\"updateAppointment('". $appointment->appointmentID ."', '". $appointment->userInfo ."', 1)\">Accept</button></td>";
                                }else{
                                    echo"<td><button class = 'btn btn-info btn-md btn-danger' onclick=\"updateAppointment('". $appointment->appointmentID ."', '". $appointment->userInfo ."', 0)\">Reject</button></td>";
                                }
                                echo"
                            </tr>
                            ";
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
        <?php include 'footer.php'; ?>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
    <script>
        function callPayment(aptID, username, amount){
            window.location.href = "paymentpage.php?aptID=" + aptID;
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
        function updateAppointment(appointmentID, userinfo, status){
			window.location.href = "updateAppointment.php?userinfo=" + userinfo + "&appointmentID=" + appointmentID + "&status=" + status;
		}
    </script>
</body>
</html>