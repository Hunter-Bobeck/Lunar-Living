<?php
    if (isset($_GET["aptID"])) {
        $aptID = $_GET["aptID"];
        session_start();
        $username = $_SESSION['username'];
        //setup the request, you can also use CURLOPT_URL
        $ch = curl_init('https://lunar-living.herokuapp.com/cancelAllRequest');

        // Returns the data/output as a string instead of raw data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');


        //set JSON data
        $jsonData = array(
            'aptID' => $aptID
        );

        $jsonDataEncoded = json_encode($jsonData);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        $message = "Updated";
        if($result == 'false'){
            $message = "Failed";
        }
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='profile.php';</script>";
    }
?>