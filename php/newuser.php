<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-moon-in-space'>
	<main>
		<div id='spacer-newuser'></div>
		<div class='container container-form' id='container-newuser'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='newuser-column'>
					<div class='text-centered five-padding-bottom'><img src='../images\Logo - New User.png' class='logo'></div>
					<br>
					<form class='form', method = 'post'>
						<div class='form-group'>
							<input class='form-control' type='text' id='newuser-email-id' name='username' placeholder='Email ID'>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Submit' type='submit' name='newuserButtonSubmit' id = "newuserButtonSubmit">
						</div>
					</form>
				</div>
			</div>
		</div>
		<br>
		<br>
	</main>

	<!-- postJS -->
    <script src='../js/bootstrap.min.js'></script>		<!-- Bootstrap JS -->
    <?php
    function newuserButtonSubmitClick(){
        $username = $_POST['username'];
        session_start();
        $_SESSION['username'] = $username;
    //setup the request, you can also use CURLOPT_URL
        $ch = curl_init('https://lunar-living.herokuapp.com/signup');

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

        $dataArray = json_decode($data, true);
        $_SESSION["newuser"] = $dataArray["newuser"];

        echo "<h1>". $data . "</h1>";
        if($data == 'false'){
            echo "User Not Found";
        }else {
            header("Location: otpverification.php");
        }

    // close curl resource to free up system resources
        curl_close($ch);
    }
    if(array_key_exists('newuserButtonSubmit',$_POST)){
        newuserButtonSubmitClick();
    }

    ?>


</body>
</html>
