<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-moon-in-space'>
	<main>
		<div id='spacer-otpverification'></div>
		<div class='container container-form' id='container-otpverification'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='login-column'>
					<div class='text-centered five-padding-bottom'><img src='../images\Logo.png' class='logo'></div>
					<h5 class='medium-gray text-centered'>OTP Verification</h5>
					<form class='form' action = 'otpverify.php' method = 'post'>
						<div class='form-group'>
							<input class='form-control' type='text' id='otpverification-otp' name='otpverificationOTP' placeholder='One-time password'>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Submit' type='submit' name='otpverificationButtonSubmit' id = 'otpverificationButtonSubmit'>
						</div>
					</form>
				</div>
			</div>
		</div>
		<br>
		<br>
	</main>

	<!-- postJS -->
    <script src='../js/bootstrap.min.js'></script>		<!-- Bootstrap JS -->




</body>
</html>
