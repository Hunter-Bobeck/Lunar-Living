<?php
    if(isset($_POST['aptSelect']) && isset($_POST['newticketTicketTitle']) && isset($_POST['newticketTicketDescription'])){
        session_start();
        $createdBy = $_SESSION['username'];
        $aptID = $_POST['aptSelect'];
        $title = $_POST['newticketTicketTitle'];
        $about = $_POST['newticketTicketDescription'];
        //setup the request, you can also use CURLOPT_URL
        $ch = curl_init('https://lunar-living.herokuapp.com/createTicket');

        // Returns the data/output as a string instead of raw data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
        //set JSON data
        $jsonData = array(
            'createdBy' => $createdBy,
            'aptID' => $aptID,
            'about' => $about,
            'title' => $title
        );

        $jsonDataEncoded = json_encode($jsonData);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        $message = "Ticket Created";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='newticket.php';</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Failed');
        window.location.href='newticket.php';</script>";
    }
?>