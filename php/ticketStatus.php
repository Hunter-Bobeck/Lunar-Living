<?php
    session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
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
echo"
<body class='background background-dark'>";
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
                                <li class='active'><a href='ticketStatus.php'>Tickets</a></li>
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
                <div class="col-sm-9">
                <div class="container">
                        <h2 class = 'lease_info'>Ticket Management</h2>
                        <div class='shift-right'><button class='btn btn-info btn-md' id = 'bookLaundry'>Add New Ticket</button></div>
                        <br/>
                        <div>
                        <?php
                        if($_SESSION["usertype"] == 2){ 
                            include 'TicketFilterBars/adminFilterBar.php';
                        } else {
                            include 'TicketFilterBars/userFilterBar.php';
                        } 
                        ?>
                        </div>
                        <br/>
                        <div style = "background-color: rgba(255,255,255,0.3); text-align: center">
                        <h1 style = "color:white; ">Ticket Management</h1>
                        <?php
                        $index = 1;
                        echo"
                        <table class='table table-dark table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>ID</th>
                                <th scope='col'>Title</th>
                                <th scope='col'>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
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
		// Get the modal
		var modal = document.getElementById('bookLaundryModal');
		// Get the button that opens the modal
		var btn = document.getElementById("bookLaundry");
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
		function bookLaundry(){
			var machineID = document.getElementById("machineSelect").value;
			var time = document.getElementById("time").value;
			window.location.href = 'booklaundry.php?machineSelect=' + machineID +"&time=" + time;
		}
        function changeTime(current, machine1, machine2, machine3, machine4) {
            // Set selected value as variable
            var selectValue = parseInt(current.options[current.selectedIndex].value)
            // Empty the time select field
            $('#time').empty();
            
            if(selectValue != 0){
                switch(selectValue){
                    case 1:
                        var currArray = machine1.split(',');
                        break;
                    case 2:
                        var currArray = machine2.split(',');
                        break;
                    case 3:
                        var currArray = machine3.split(',');
                        break;
                    case 4:
                        var currArray = machine4.split(',');
                        break;
                }
                if(currArray[0] == 'empty'){
                    currArray = []
                }
                // For each hour in the selected machine
                for (i = 1; i < 25; i++) {
                    var flag = currArray.includes(i.toString());
                    if(!flag){
                        $('#time').append("<option value='" + i + "'>" + i + "</option>");
                    }
                }
            }
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
</body>
</html>