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
                                <li class='active'><a href='#'>Payment</a></li>
                                <li><a href='ticketStatus.php'>Tickets</a></li>
                                <li><a href='laundry.php'>Laundry</a></li>
                                <li><a href='review.php'>Review</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="container">
                        <h2 class = 'lease_info'>Payments</h2>
                        <a href='paymenthistory.php'><h4 class = 'shift-right link-prop'>&lt;&nbspPayment History<h4></a><br>
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
                                <th scope='col'>Payment Due</th>
                                <th scope='col'>Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($leaseArray as $lease){
                            $ch = curl_init('https://lunar-living.herokuapp.com/paymentDue');
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
                            echo"
                            <tr>
                                <th scope='row'>". $index ."</th>
                                <td>". $lease->aptID ."</td>
                                <td>$". $paymentData->amount ."</td>";
                                if($paymentData->amount == 0){
                                    echo"<td><button class = 'btn btn-info btn-md' disabled>Pay</button></td>";
                                }else{
                                echo"
                                <td><button class = 'btn btn-info btn-md' onclick = \"callPayment('". $lease->aptID ."','" . $_SESSION['username'] ."'," . $paymentData->amount .")\">Pay</button></td>";
                                }
                                echo"
                            </tr>
                            ";
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
    </script>
</body>
</html>