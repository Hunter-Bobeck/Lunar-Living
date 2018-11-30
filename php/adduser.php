<?php
    if (isset($_POST["emailID"]) && isset($_POST["usertype"])) {
        $emailID = $_POST["emailID"];
        $usertype = (int)$_POST["usertype"];
        if($usertype == 0){
            echo "<script type='text/javascript'>alert(Select User type);
            window.location.href='allLogin.php';</script>";  
        }
        else{
            session_start();
            $username = $_SESSION['username'];
            //setup the request, you can also use CURLOPT_URL
            $ch = curl_init('https://lunar-living.herokuapp.com/createNewUser');

            // Returns the data/output as a string instead of raw data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
            curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
            //set JSON data
            $jsonData = array(
                'email_ID' => $emailID,
                'usertype' => $usertype
            );

            $jsonDataEncoded = json_encode($jsonData);

            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $result = curl_exec($ch);
            curl_close($ch);
            $message = "User Added";
            if($result == 'false'){
                $message = "Failed";
            }
            echo "<script type='text/javascript'>alert('$message');
            window.location.href='allLogin.php';</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>
            window.location.href='index.php';</script>";
    }
?>