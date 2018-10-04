<?php

require 'connection.php';
echo"connection done!";


// if (isset($_POST['registrationFirstName']) and isset($_POST['registrationLastName']) and
// isset($_POST['registrationUsername']) and isset($_POST['registrationPassword']) and
// isset($_POST['registrationPasswordConfirmation']) and isset($_POST['registrationEmail']) and
// !empty($_POST['registrationFirstName']) and !empty($_POST['registrationLastName']) and
// !empty($_POST['registrationUsername']) and !empty($_POST['registrationPassword']) and
// !empty($_POST['registrationPasswordConfirmation']) and !empty(['registrationEmail'])) {
// echo"inside module";
$fname = mysqli_real_escape_string($conn, $_POST['registrationFirstName']);
$lname = mysqli_real_escape_string($conn, $_POST['registrationLastName']);
$username = mysqli_real_escape_string($conn, $_POST['registrationUsername']);
$password1 = $_POST['registrationPassword'];
$password2 = $_POST['registrationPasswordConfirmation'];
$email = mysqli_real_escape_string($conn, $_POST['registrationEmail']);

if ($password1 == $password2) {
  $getInfo = "SELECT * from login where username = '$username'";
  $res = mysqli_query($conn, $getInfo);
  $row = mysqli_fetch_assoc($res);

  if(mysqli_num_rows($res) > 0){
    echo "The username is already taken";
  }
  else{
    $password1 = PASSWORD_HASH($password1, PASSWORD_BCRYPT, array('cost' => 5));
    $sql = "INSERT INTO login(first_name, last_name, Username
    , password, email) VALUES('$fname', '$lname', '$username', '$password1', '$email')";
    if(!mysqli_query($conn, $sql)){
      echo "There was a problem";
    }else{
      header("Location: errorpage.html");
    }
  }

}else{
  echo "The passwords you entered are not the same. Please Enter the same passwords";
}
// }
?>
