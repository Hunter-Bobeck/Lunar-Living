<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-moon-in-space'>
	<main>
	<?php include 'signInNavbar.php'; ?>
		<div id='spacer-newuser'></div>
		<div class='container container-form' id='container-newuser'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='newuser-column'>
					<div class='text-centered five-padding-bottom'><img src='../images\Logo - New User.png' class='logo'></div>
					<br>
					<strong>Sign Up requires to hold a lease.</strong>
					<br>
					<br>
					<form class='form' method = 'post' action='checksignupuser.php'>
						<div class='form-group'>
							<input class='form-control' type='text' id='newuser-email-id' name='username' placeholder='Email ID'>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Submit' type='submit' name='newuserButtonSubmit' id = "newuserButtonSubmit">
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
