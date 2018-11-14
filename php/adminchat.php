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
							<li><a href='profile.php'>Profile</a></li>
							<li><a href='user_lease.php'>Lease</a></li>
							<li><a href='payment.php'>Payment</a></li>
							<li><a href='#'>Tickets</a></li>
							<li><a href='laundry.php'>Laundry</a></li>
                            <li><a href='review.php'>Review</a></li>
                            <li class='active'><a href='#'>Chat</a></li>
						</ul>
					</aside>
				</div>
			</div>
			<div class='col-sm-9'>
            <div class="container">
                        <h2 class = 'lease_info'>Pending Chats</h2>
                        <div class='row table-wrapper-scroll-y'>
                        <?php
                        
                        $ch = curl_init('https://lunar-living.herokuapp.com/fetchAllAdminMsg');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json'
                            ));
                        $data = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $allMsgs = json_decode($data);
                        curl_close($ch);
                        $index = 1;
                        echo"
                        <table class='table table-dark table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Chat</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($allMsgs as $msg){
                            echo"
                            <tr>
                                <th scope='row'>". $index ."</th>
                                <td>". $msg->username ."</td>
                                <td><button class = 'btn btn-info btn-md' onclick = \"chatWith('" . $msg->username ."')\">Chat</button></td>";
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
        <div class='chat-body'>
            <?php
            if(isset($_SESSION['chatuser'])){
                echo "<button class='open-button' onclick='openForm()'>Chat</button>";
            }
            else{
                echo "<button class='open-button' onclick='openForm()' disabled>Chat</button>";
            }
            ?>
			<div class="chat-popup" id="myForm">
			<div class="form-container">
				<?php include 'chatAdmin.php'; ?>
				<input class="btn cancel" onclick="closeForm()" value='Close' />
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
        function chatWith(username){
            window.location.href = "setotheruser.php?otheruser=" + username;
        }
        function openForm() {
			document.getElementById("myForm").style.display = "block";
		}
		function closeForm() {
			document.getElementById("myForm").style.display = "none";
		}
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script src='../js/chatAdmin.js'></script>
</body>
</html>