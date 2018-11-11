<?php
	session_start();
	if (isset($_GET['aptID'])) {
		$_SESSION['aptID'] = $_GET["aptID"];
    }
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class="background background-dark">
	<?php
		$username = $_SESSION['username'];
		//setup the request, you can also use CURLOPT_URL
		$ch = curl_init('https://lunar-living.herokuapp.com/getUserDetails');

		// Returns the data/output as a string instead of raw data
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
		echo "User Not Found";
		}
		else {
			$userInfoData = json_decode($data);
		}

		// close curl resource to free up system resources
		curl_close($ch);
	?>
	<main class = 'content_body'>
	<div class='container-fluid padding-zero'>
		<?php include 'signInNavbar.php'; ?>
	</div>
	<div class='container-fluid userlease_container'>
		<div class='row'>
			<div class='col-sm-3'>
				<div class='wrapper'>
					<aside class='main_sidebar'>
						<ul>
							<li><a href='profile.php'>Profile</a></li>
							<li><a href='user_lease.php'>Lease</a></li>
							<li class='active'><a href='payment.php'>Payment</a></li>
							<li><a href='#'>Tickets</a></li>
							<li><a href='laundry.php'>Laundry</a></li>
							<li><a href='review.php'>Review</a></li>
						</ul>
					</aside>
				</div>
			</div>
			<div class='col-sm-9'>
				<?php
				$aptID = $_SESSION['aptID'];
				$ch = curl_init('https://lunar-living.herokuapp.com/paymentDue');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					"apt_name: $aptID"
					));
				$data = curl_exec($ch);
				$info = curl_getinfo($ch);
				$paymentData = json_decode($data);
				$_SESSION['amount'] = $paymentData->amount;
				?>
				<div class="creditCardForm">
					<div class="heading">
						<h1>Confirm Payment</h1>
					</div>
					<div class="payment">
						<form>
							<div class="form-group owner">
								<label for="owner">Owner Name</label>
								<input type="text" class="form-control" id="owner">
							</div>
							<div class="form-group CVV">
								<label for="cvv">CVV</label>
								<input type="text" class="form-control" id="cvv">
							</div>
							<div class="form-group" id="card-number-field">
								<label for="cardNumber">Card Number</label>
								<input type="text" class="form-control" id="cardNumber">
							</div>
							<div class="form-group" id="expiration-date">
								<label>Expiration Date</label>
								<select>
									<option value="01">January</option>
									<option value="02">February </option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>
								<select>
									<option value="16"> 2018</option>
									<option value="17"> 2019</option>
									<option value="18"> 2020</option>
									<option value="19"> 2021</option>
									<option value="20"> 2022</option>
									<option value="21"> 2023</option>
								</select>
							</div>
							<div class="form-group" id="credit_cards">
								<img src="../images/visa.jpg" id="visa">
								<img src="../images/mastercard.jpg" id="mastercard">
								<img src="../images/amex.jpg" id="amex">
							</div>
							<div class="form-group" id="pay-now">
								<button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
	<!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
	<script src="../js/jquery.payform.min.js" charset="utf-8"></script>
	<script>
		$(function() {
			var owner = $('#owner');
			var cardNumber = $('#cardNumber');
			var cardNumberField = $('#card-number-field');
			var CVV = $("#cvv");
			var mastercard = $("#mastercard");
			var confirmButton = $('#confirm-purchase');
			var visa = $("#visa");
			var amex = $("#amex");

			// Use the payform library to format and validate
			// the payment fields.

			cardNumber.payform('formatCardNumber');
			CVV.payform('formatCardCVC');


			cardNumber.keyup(function() {

				amex.removeClass('transparent');
				visa.removeClass('transparent');
				mastercard.removeClass('transparent');

				if ($.payform.validateCardNumber(cardNumber.val()) == false) {
					cardNumberField.addClass('has-error');
				} else {
					cardNumberField.removeClass('has-error');
					cardNumberField.addClass('has-success');
				}

				if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
					mastercard.addClass('transparent');
					amex.addClass('transparent');
				} else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
					mastercard.addClass('transparent');
					visa.addClass('transparent');
				} else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
					amex.addClass('transparent');
					visa.addClass('transparent');
				}
			});

			confirmButton.click(function(e) {

				e.preventDefault();

				var isCardValid = $.payform.validateCardNumber(cardNumber.val());
				var isCvvValid = $.payform.validateCardCVC(CVV.val());

				if(owner.val().length < 5){
					alert("Wrong owner name");
				} else if (!isCardValid) {
					alert("Wrong card number");
				} else if (!isCvvValid) {
					alert("Wrong CVV");
				} else {
					window.location.href = "paymentDone.php";
				}
			});
		});
	</script>
</body>
</html>