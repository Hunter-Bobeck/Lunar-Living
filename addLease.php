<?php

session_start();
$apartment_ID = $_POST['newleaseApartmentID'];
$email_ID = $_POST['newleaseEmailID'];
// $username = $_SESSION['username'];
//setup the request, you can also use CURLOPT_URL
$ch = curl_init('https://lunar-living.herokuapp.com/signLease');

// Returns the data/output as a string instead of raw data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');


//set JSON data
$jsonData = array(
    'email_ID' => [$email_ID],
    'apt_ID' => $apartment_ID,
    'start_date' => "10/01/2018",
    'end_date' => "09/01/2019"
);

$jsonDataEncoded = json_encode($jsonData);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);
echo $result;


// //Set your auth headers
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     "email_ID: $email_ID",
//     "apt_ID: $apartment_ID",
//     "start_date: 10/01/2018",
// 	  "end_date: 09/01/2019"
//     ));

// get stringified data/output. See CURLOPT_RETURNTRANSFER
// $data = curl_exec($ch);
// echo $data;
// get info about the request
// $info = curl_getinfo($ch);

// echo "$data";

// close curl resource to free up system resources
// curl_close($ch);


 ?>
