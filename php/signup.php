<?php
session_start();
?>

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
    <title>Lunar Living | Signup</title>		<!-- title -->

	<!-- CSS -->
	<link rel='stylesheet' href='../css/reset.css'>		<!-- Reset CSS -->
    <link rel='stylesheet' href='../css/bootstrap.min.css'>		<!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/fontawesome.min.css'>		<!-- Font Awesome CSS -->
	<link rel='stylesheet' href='../css/style.css'>		<!-- custom CSS -->
</head>
<body class='background background-moon-in-space'>
	<main>
		<div id='spacer-signup'></div>
		<div class='container container-form' id='container-signup'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='signup-column'>
					<div class='text-centered five-padding-bottom'><img src='../images\Logo - Signup.png' class='logo'></div>
					<br>
					<form class='form' method = 'post'>
						<div class='form-group'>
							<input class='form-control' type='text' id='signup-first-name' name='signupFirstName' placeholder='First name'>
						</div>
						<div class='form-group'>
							<input class='form-control' type='text' id='signup-last-name' name='signupLastName' placeholder='Last name'>
						</div>
						<div class='form-group'>
							<div class='dropdown text-centered'>
								<select class='btn btn-secondary dropdown-toggle' type='button' id='signup-gender' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' name='signupGender'>
                                    <option class='dropdown-item' value="Gender">Gender </option>
                                    <option class='dropdown-item' value="Male">Male </option>
									<option class='dropdown-item' value = "Female">Female </option>
									<option class='dropdown-item' value = "other">Other</option>
									<option class='dropdown-item' value = "Prefer not to say">Prefer not to say</option>
                                </select>
							</div>
						</div>
						<div class='form-group'>
							<input class='form-control' type='password' id='signup-password' name='signupPassword' placeholder='Password'>
						</div>
						<div class='form-group'>
							<input class='form-control' type='password' id='signup-password-confirmation' name='signupPasswordConfirmation' placeholder='Confirm password'>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Submit' type='submit' name='signupButtonSubmit'>
						</div>
					</form>
				</div>
			</div>
		</div>
		<br>
		<br>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->

	<?php
    function signupButtonSubmitClick(){

        $ch = curl_init('https://lunar-living.herokuapp.com/signupDetails');

        $jsonData = array(
            'username' => $_SESSION['username'],
            'firstName'   => $_POST['signupFirstName'] ,
            'lastName' => $_POST['signupLastName'],
            'gender' => $_POST['signupGender']
        );
        $jsonDataEncoded = json_encode($jsonData);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

    // close the connection, release resources used
        curl_close($ch);

        if ($response == true){

            $ch = curl_init('https://lunar-living.herokuapp.com/updatePassword');


            $jsonData1 = array(
                'username' => $_SESSION['username'],
                'password' => $_POST['signupPassword']
            );
            $jsonDataEncoded1 = json_encode($jsonData1);

            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded1);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

               // execute!
            $response1 = curl_exec($ch);

    // close the connection, release resources used
            curl_close($ch);

            if($response1 == true){
                $username = $_SESSION['username'];
                $ch = curl_init('https://lunar-living.herokuapp.com/updateNewUser');
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

                if($data == 'false'){
                    echo "User Not Found";
                }
                else {
                    header("Location: php/profile.php");
                }
            }

        }

        }





    if(array_key_exists('signupButtonSubmit', $_POST)){
        signupButtonSubmitClick();
    }








	?>
</body>
</html>