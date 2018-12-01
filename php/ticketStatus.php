<?php
session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php';?>
<link rel='stylesheet' href='../css/user_lease.css'>

<style>
li:hover:not(.active) {
    background-color: #111;
}

.active-filter {
background-color:steelblue;
}
}
</style>
<?php
echo "
<body class='background background-dark'>";
$username = $_SESSION['username'];
$first_name = $_SESSION['firstName'];
?>
	<main class = "content_body">
        <div class='container-fluid padding-zero'>
            <?php include 'signInNavbar.php';?>
        </div>
        <div class="container-fluid userlease_container">
            <div class="row">
                <div class="col-sm-3">
                    <div class='wrapper'>
                        <aside class='main_sidebar'>
                            <ul>
                                <li><a href='profile.php'>Profile</a></li>
                                <?php
                                if ($_SESSION["usertype"] == 1) {
                                    echo "<li><a href='user_lease.php'>Lease</a></li>
                                                                    <li><a href='payment.php'>Payment</a></li>";
                                }
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li><a href='newlease.php'>New Lease</a></li>";
                                    echo "<li><a href='allLogin.php'>All Users</a></li>";
                                    echo "<li><a href='allLease.php'>All Leases</a></li>";
                                    echo "<li><a href='appointments.php'>All Appointments</a></li>";
                                    echo "<li><a href='allpromocodes.php'>All Promo Codes</a></li>";
                                }
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li><a href='adminchat.php'>Chats</a></li>";
                                }
                                ?>
                                                                <li class='active'><a href='ticketStatus.php'>Tickets</a></li>
                                                                <?php
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li><a href='map.php'>Ticket Map</a></li>";
                                }
                                ?>
                                <li><a href='events.php'>Events</a></li>
                                <li><a href='laundry.php'>Laundry</a></li>
                                <li><a href='review.php'>Review</a></li>
                                <?php
                                if ($_SESSION["usertype"] == 2) {
                                    echo "<li>
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
                <div class="col-sm-9 side-col">
                <div class="container">
                <span class = 'user_lease_info'>Ticket Management</span>
                        <?php
                        if ($_SESSION["usertype"] == 1) {
                            echo "<div><button class = 'btn' style = 'background-color:red; color:white; align-content:right;' onclick=\"newticket()\">Add New Ticket</button></div>";
                        }
                        ?>
                        <br/>
                        <div>
                        <?php
                        if ($_SESSION["usertype"] == 2) {
                            include 'TicketFilterBars/adminFilterBar.php';
                            if(isset($_GET['flag']) == 1){
                                $query = $_SESSION['query'];
                                $ch = curl_init('https://lunar-living.herokuapp.com/hitQuery');
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    "query: $query",
                                ));
                                $data = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                $ticketArray = json_decode($data);
                                curl_close($ch);
                            }
                            else{
                                $ch = curl_init('https://lunar-living.herokuapp.com/getAllTickets');
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    "username: $username",
                                ));
                                $data = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                $ticketArray = json_decode($data);
                                curl_close($ch);
                            }
                        } else {
                            include 'TicketFilterBars/userFilterBar.php';
                            if(isset($_GET['flag']) == 1){
                                $query = $_SESSION['query'];
                                $ch = curl_init('https://lunar-living.herokuapp.com/hitQuery');
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    "query: $query",
                                ));
                                $data = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                $ticketArray = json_decode($data);
                                curl_close($ch);
                            }
                            else{
                                $ch = curl_init('https://lunar-living.herokuapp.com/getUserTickets');
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    "username: $username",
                                ));
                                $data = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                $ticketArray = json_decode($data);
                                curl_close($ch);
                            }
                        }
                        ?>
                        </div>
                        <br/>
                        <div style = "text-align: center">
                        <?php
                        $index = 1;
                        echo "
                        <table class ='table table-bordered table_flat' id='clickable'>
                            <thead class = 'head_table'>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>AptID</th>
                                <th scope='col'>Title</th>
                                <th scope='col'>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach ($ticketArray as $ticket) {
                            echo "
                                <tr class = 'row_table_lease' data-href=\"maintenance.php?ticketID=" . $ticket->ticketID . "\">
                                    <th scope='row'>" . $ticket->ticketID . "</th>
                                    <td>" . $ticket->aptID . "</td>
                                    <td>" . $ticket->title . "</td>
                                    <td>" . $ticket->ticketStatus . "</td>
                                </tr>
                                </a>
                                ";
                            $index++;
                        }
                        echo "
                            </tbody>
                        </table>";
                        ?>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php';?>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
    <script>
        $(document).ready(function($) {
            $("#clickable tr").click(function() {
                window.document.location = $(this).data("href");
            });
        });
        function displayStats(){
			var statsChilds = document.getElementById("statsChilds");
			if(statsChilds.style.display == "none"){
				statsChilds.style.display = "block";
			}
			else{
				statsChilds.style.display = "none";
			}
		}
        function newticket(){
            window.location.href = 'newticket.php';
        }
        
	</script>
</body>
</html>