<?php
    session_start();
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

        $password = md5($_POST['signupPassword']);
        $jsonData1 = array(
            'username' => $_SESSION['username'],
            'password' => $password
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
                echo "<script>alert('Failed to update');
                    window.location.href = 'login.php';
                </script>";
            }
            else {
                echo "<script>
                    window.location.href = 'profile.php';
                </script>";
            }
        }

    }
?>