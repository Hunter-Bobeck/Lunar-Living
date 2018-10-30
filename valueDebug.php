<?php
/**
 * Created by PhpStorm.
 * User: nishc
 * Date: 10/28/2018
 * Time: 12:57 PM
 */

echo $_POST['newleaseApartmentID'];
echo "</br>";

//echo is_array($_POST['newleaseEmailID']);
echo "</br>";
//for($i = 0; $i < count($_POST['newleaseEmailID']); $i++){
//    echo $_POST['newleaseEmailID'][$i];
//}

print_r($_POST['newleaseEmailID']);

 $dates = explode(" ", $_POST['newleaseDateRange']);
    print_r($dates);

?>