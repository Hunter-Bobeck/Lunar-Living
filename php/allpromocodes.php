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
        $ch = curl_init('https://lunar-living.herokuapp.com/getAllPromos');
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
        $allPromos = json_decode($data);
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
                                    echo"<li><a href='appointments.php'>All Appointments</a></li>";
								    echo"<li class='active'><a href='#'>All Promo Codes</a></li>";
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
                        <h2 class = 'lease_info'>All Promo Codes</h2>
                        <form action = 'newpromocode.php' method ='post'>
                            <p class='promotitle'>Add New Promo Code</p>
                            <input type='text' placeholder = 'Promo ID' class='promocodeInput' name='promoid'>
                            <input type='text' placeholder = 'Max Use' class='promocodeInput'name='maxuse'>
                            <input type='text' placeholder = 'Percentage Off' class='promocodeInput'name='off'>
                            <input class = 'btn btn-info btn-md margin-left' type='submit' value='Add Promo'>
                        </form>
                        <div class='row table-wrapper-scroll-y'>
                        <?php
                        echo"
                        <table class='table table-dark table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>Promo ID</th>
                                <th scope='col'>Max use</th>
                                <th scope='col'>Off Percentage</th>
                                <th scope='col'>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($allPromos as $promo){
                            echo"
                            <tr>
                                <th scope='row'>". $promo->promoID ."</th>
                                <td>". $promo->maxuse ."</td>
                                <td>". $promo->offBy ."</td>";
                                if($promo->promoStatus == 0){
                                    echo"<td><button class = 'btn btn-info btn-md' onclick=\"updateStatus('". $promo->promoID ."', 1)\">Enable</button></td>";
                                }else{
                                    echo"<td><button class = 'btn btn-info btn-md btn-danger' onclick=\"updateStatus('". $promo->promoID ."', 0)\">Disable</button></td>";
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
        function updateStatus(promocode, status){
			window.location.href = "updatepromo.php?promocode=" + promocode + "&status=" + status;
		}
    </script>
</body>
</html>