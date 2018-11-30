<?php

session_start();

$apartment_id = $_POST['newleaseApartmentID'];
$email_id = $_POST['newleaseEmailID'];
$dates = explode(' ', $_POST['newleaseDateRange']);

//for($i = 0; $i < count($_POST['newleaseEmailID']); $i++) {
//    echo $_POST['newleaseEmailID'][$i];
//}

//setup the request, you can also use CURLOPT_URL
$ch = curl_init('https://lunar-living.herokuapp.com/signLease');

// Returns the data/output as a string instead of raw data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');


//set JSON data
$jsonData = array(
    'email_ID' => $email_id,
    'apt_ID' => $apartment_id,
    'start_date' => $dates[0],
    'end_date' => $dates[2]
);

$jsonDataEncoded = json_encode($jsonData);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);

 ?>
