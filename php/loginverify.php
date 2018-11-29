<?php
    session_start();
    $username = $_POST['loginUsername'];
    $password = md5($_POST['loginPassword']);
    $_SESSION['username'] = $username;
    //setup the request, you can also use CURLOPT_URL
    $ch = curl_init('https://lunar-living.herokuapp.com/login');

    // Returns the data/output as a string instead of raw data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Good practice to let people know who's accessing their servers. See https://en.wikipedia.org/wiki/User_agent
    curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');

    //Set your auth headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "username: $username",
        "password: $password"
    ));

    // get stringified data/output. See CURLOPT_RETURNTRANSFER
    $data = curl_exec($ch);
    // get info about the request
    $info = curl_getinfo($ch);
    curl_close($ch);
    if($data == 'false'){
        echo "<script>alert('Can not find the user');
             window.location.href = 'login.php';
        </script>";
    }else {
        $dataArray = json_decode($data, true);
        $_SESSION["newuser"] = $dataArray["newuser"];
        $_SESSION["usertype"] = $dataArray["usertype"];
        $usertype = $_SESSION["usertype"];
        echo "<script>
             window.location.href = 'otpverification.php';
        </script>";
    }
    // close curl resource to free up system resources
?>

