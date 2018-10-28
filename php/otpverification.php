<!doctype html>
<html lang='en'>
<head>
	<!-- metadata -->
    <meta charset='utf-8'>	<!-- Unicode characterset -->
    <meta http-equiv='X-UA-Compatible' content='IE=epdge'>	<!-- Internet Explorer compatibility -->
    <meta name='viewport' content='width=device-width, initial-scale=1'>	<!-- renders the page according to the device width -->
    <meta name='description' content='Rent a living space, in outer space.'>		<!-- description [shown on searchengine result] -->
    <meta name='keywords' content='Kidd, Living, space, rental, service, management, system, SpaceX, outer, Elon, Musk'>		<!-- keywords for searchengine optimization -->
    <meta name='author' content='IU SE G2'>		<!-- author name -->
    <link rel='icon' href='../images\Icon.ico'>		<!-- favicon -->
    <title>Lunar Living | OTP Verification</title>		<!-- title -->

	<!-- CSS -->
	<link rel='stylesheet' href='../css/reset.css'>		<!-- Reset CSS -->
    <link rel='stylesheet' href='../css/bootstrap.min.css'>		<!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/fontawesome.min.css'>		<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='../css/style.css'>		<!-- custom CSS -->
</head>
<body class='background background-moon-in-space'>
	<main>
		<div id='spacer-otpverification'></div>
		<div class='container container-form' id='container-otpverification'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='login-column'>
					<div class='text-centered five-padding-bottom'><img src='../images\Logo.png' class='logo'></div>
					<h5 class='medium-gray text-centered'>OTP Verification</h5>
					<form class='form' method = 'post'>
						<div class='form-group'>
							<input class='form-control' type='text' id='otpverification-otp' name='otpverificationOTP' placeholder='One-time password'>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Submit' type='submit' name='otpverificationButtonSubmit' id = 'otpverificationButtonSubmit'>
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
    function otpverificationButtonSubmitclick()
    {
        session_start();
        $otp = $_POST['otpverificationOTP'];
        $username = $_SESSION['username'];
        //setup the request, you can also use CURLOPT_URL
        $ch = curl_init('https://lunar-living.herokuapp.com/otpVerification');

        // Returns the data/output as a string instead of raw data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');

        //Set your auth headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            "username: $username",
            "otp: $otp"
        ));

        // get stringified data/output. See CURLOPT_RETURNTRANSFER
        $data = curl_exec($ch);
        echo $data;
        // get info about the request
        $info = curl_getinfo($ch);

        if ($data == 'false') {
            echo "OTP not same";
        } else if ($data != 'false' and $_SESSION['newuser'] == 1){
            header("Location: profile.php");
            session_destroy();
        } else{
            header("Location: ../signup.html");
        }

        // close curl resource to free up system resources
        curl_close($ch);
    }

    if(array_key_exists('otpverificationButtonSubmit',$_POST)){
        otpverificationButtonSubmitclick();
    }    ?>


</body>
</html>
