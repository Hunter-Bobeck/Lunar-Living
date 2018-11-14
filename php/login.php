<?php
    if(isset($_SESSION['username'])){
        session_destroy();
    }
    session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-moon-in-space'>
    
	<main>
		<div id='spacer-login'></div>
		<div class='container container-form' id='container-login'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='login-column'>
					<div class='text-centered five-padding-bottom'><img src='../images\Logo - Login.png' class='logo'></div>
					<br>
					<form class='form' action = 'loginverify.php' method = 'post'>
						<div class='form-group'>
							<input class='form-control' type='text' id='login-username' name='loginUsername' placeholder='Username'>
						</div>
						<div class='form-group'>
							<input class='form-control' type='password' id='login-password' name='loginPassword' placeholder='Password'>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Login' type='submit' name='loginButtonLogin' id="loginButtonLogin">
						</div>
          </form>
            <form class="" action="newuser.php">
              <div class='form-group text-centered'>
                <input class='btn btn-info btn-md' value='Signup' type='submit' name='loginButtonSignup'>
              </div>
            </form>

				</div>
			</div>
		</div>
		<br>
		<br>
		<?php include 'footer.php'; ?>
	</main>

<!-- postJS -->
    <script src='../js/bootstrap.min.js'></script>		<!-- Bootstrap JS -->


</body>

</html>
