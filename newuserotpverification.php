<?php

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

if($data == 'false'){
  echo "OTP not same";
}else
 {
  header("Location: signup.html");
}

// close curl resource to free up system resources
curl_close($ch);


 ?>
