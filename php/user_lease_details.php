<?php
    session_start();
    if (isset($_GET['aptID']) && isset($_GET['groupNo']) && isset($_GET['startDate']) && isset($_GET['endDate'])) {
        $aptID = $_GET["aptID"];
        $groupNo = $_GET["groupNo"];
        $start_date = $_GET["startDate"];
        $end_date = $_GET["endDate"];
    }
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
        <div class="container userlease_container">
            <div class="row">
                <div class="col-sm-4">
                    <div class='wrapper'>
                        <aside class='main_sidebar'>
                            <ul>
                                <li><a href='profile.php'>Profile</a></li>
                                <li class='active'><a href='user_lease.php'>Lease</a></li>
                                <li><a href='payment.php'>Payment</a></li>
                                <li><a href='#'>Tickets</a></li>
                                <li><a href='laundry.php'>Laundry</a></li>
                                <li><a href='review.php'>Review</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="container">
                        <h2 class = 'lease_info'>Signed Lease</h2>
                        <div class='row'>
                        <?php
                        echo"
                            <div class='col-sm-4'>
                                <div class='tour'>
                                    <a href='#' class='tour-img' style='background-image: url(../images/apt.jpg);'>
                                        <p class='price'><span id='lease'>Apt " . $aptID ."</span></p>
                                    </a>
                                </div>
                            </div>
                            <div class='col-sm-4 date'>
                                <p>Start Date: ". substr($start_date, 0, 10) ."</p>
                                <p>End Date: ". substr($end_date, 0, 10) ."</p>    
                                <div class='panel-body'>
                                    <h4>Lease Members</h4>";
                                    $ch = curl_init('https://lunar-living.herokuapp.com/getMembers');
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                        'Content-Type: application/json',
                                        "group_number: $groupNo"
                                        ));
                                    $groupMembers = curl_exec($ch);
                                    if($groupMembers == 'false'){
                                        echo "User Not Found";
                                    }
                                    else {
                                        $apiMembers = json_decode($groupMembers);
                                    }
                                    curl_close($ch);
                                    echo"
                                    <table class='table table-bordered'>
                                        <thead>
                                        <tr>
                                            <th>FirstName</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
                                        foreach($apiMembers as $member){
                                            $ch = curl_init('https://lunar-living.herokuapp.com/getUserDetails');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                                'Content-Type: application/json',
                                                "username: $member->username"
                                                ));
                                            $userDetails = curl_exec($ch);
                                            if($userDetails == 'false'){
                                                //echo "User Not Found";
                                            }
                                            else {
                                                $userInfo = json_decode($userDetails);
                                            }
                                            curl_close($ch);
                                            echo"
                                                <tr>
                                                    <td>". $userInfo->first_name ."</td>
                                                    <td>". $userInfo->last_name ."</td>
                                                    <td>". $member->username ."</td>
                                                </tr>";
                                        };
                                        echo"
                                        </tbody>
                                    </table>
                                </div>
                            </div>";
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
</body>
</html>