<?php
    session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<?php
echo"
<body class='background background-dark'>";
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
                                <li class='active'><a href='#'>Laundry</a></li>
                                <li><a href='review.php'>Review</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-9">
                <div class="container">
                        <h2 class = 'lease_info'>Laundry Service</h2>
                        <div class='shift-right'><button class='btn btn-info btn-md' id = 'bookLaundry'>Book a Machine</button></div>
                        <div class='row'>
                            <?php
                            $ch = curl_init('https://lunar-living.herokuapp.com/getAllLaundryTimes');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                'Content-Type: application/json',
                                ));
                            $laundryTimings = curl_exec($ch);
                            $info = curl_getinfo($ch);
                            $laundryTime = json_decode($laundryTimings);
                            curl_close($ch);
                            $machine1 = "empty";
                            $machine2 = "empty";
                            $machine3 = "empty";
                            $machine4 = "empty";
                            foreach($laundryTime as $machine){
                                switch($machine->machineID){
                                    case 1:
                                        $machine1 = $machine->timings;
                                        break;
                                    case 2:
                                        $machine2 = $machine->timings;
                                        break;
                                    case 3:
                                        $machine3 = $machine->timings;
                                        break;
                                    case 4:
                                        $machine4 = $machine->timings;
                                        break;
                                }
                            }
                            echo"<div class='col-sm-3 margin-zero'>
                                <div class='tour'>";
                                    if(count($machine1) == 24){
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Sorry</span></p>
                                        </a>";
                                    }
                                    else{
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Available</span></p>
                                        </a>";
                                    }
                                    echo"
                                </div>
                            </div>
                            <div class='col-sm-3 margin-zero'>
                                <div class='tour'>";
                                    if(count($machine2) == 24){
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Sorry</span></p>
                                        </a>";
                                    }
                                    else{
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Available</span></p>
                                        </a>";
                                    }
                                    echo"
                                </div>
                            </div>
                            <div class='col-sm-3 margin-zero'>
                                <div class='tour'>";
                                    if(count($machine3) == 24){
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Sorry</span></p>
                                        </a>";
                                    }
                                    else{
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Available</span></p>
                                        </a>";
                                    }
                                    echo"
                                </div>
                            </div>
                            <div class='col-sm-3 margin-zero'>
                                <div class='tour'>";
                                    if(count($machine4) == 24){
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Sorry</span></p>
                                        </a>";
                                    }
                                    else{
                                        echo"<a class='tour-img' style='background-image: url(../images/laundry.png);'>
                                            <p class='price'><span id=lease>Available</span></p>
                                        </a>";
                                    }
                                    echo"
                                </div>
                            </div>";
                            ?>
                            <div id='bookLaundryModal' class='modal'>
                                <!-- Modal content -->
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h2>Book Laundry</h2>
                                        <span class='close'>&times;</span>	
                                    </div>
                                    <div class='modal-body'>
                                        <?php
                                            echo "</br><span>Select Machine:&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <select id='machineSelect' onChange=\"changeTime(this,'". $machine1 ."', '" . $machine2  . "', '" . $machine3 . "', '" . $machine4 . "')\">
                                            <option value='0'>Select Machine</option>";
                                                if(count($machine1) < 24){
                                                    echo"<option value='1'>Machine 1</option>";
                                                }
                                                if(count($machine2) < 24){
                                                    echo"<option value='2'>Machine 2</option>";
                                                }
                                                if(count($machine3) < 24){
                                                    echo"<option value='3'>Machine 3</option>";
                                                }
                                                if(count($machine4) < 24){
                                                    echo"<option value='4'>Machine 4</option>";
                                                }
                                                echo"   
                                            </select>
                                            </br></br>
                                            <span>Select Time:&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <select id='time'>
                                            <option>Select Time</option>
                                            </select>
                                            </br></br>
                                            ";
                                        ?>
                                    </div>
                                    <div class='modal-footer'>
                                        <button class = 'update' onclick = 'bookLaundry()'>Book</button>
                                    </div>
                                </div>
                            </div>
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
        
	</script>
</body>
</html>