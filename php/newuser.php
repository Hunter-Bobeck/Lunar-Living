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
    <title>Lunar Living | New User</title>		<!-- title -->

	<!-- CSS -->
	<link rel='stylesheet' href='../css/reset.css'>		<!-- Reset CSS -->
    <link rel='stylesheet' href='../css/bootstrap.min.css'>		<!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/fontawesome.min.css'>		<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='../css/style.css'>		<!-- custom CSS -->
</head>
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
        session_destroy();
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
