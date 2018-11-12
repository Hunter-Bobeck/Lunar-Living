<?php
    session_start();
    $username = $_SESSION['chatuser'];
    $ch = curl_init('https://lunar-living.herokuapp.com/fetchAdminMsg');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "username: $username"
        ));
    $data = curl_exec($ch);
    $info = curl_getinfo($ch);
    $apiData = json_decode($data);
    curl_close($ch);
    echo "a" .$username;
    if($apiData != null){
        $allmsgs = explode ("~", $apiData->msg);
        foreach($allmsgs as $msg){
            $currmsg = explode ("^", $msg);
            $name = explode ("-", $currmsg[1]);
            echo "<p><span>".$currmsg[0]."</span>
            <span><strong>". $name[0] ."</strong></span>
            <span>". $name[1] ."</span>
            </p>";
        }
    }
?>