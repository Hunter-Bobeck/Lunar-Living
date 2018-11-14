<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-lunar-landed'>
	<main>
	<?php include 'navbar.php'; ?>


		<div id='spacer-newticket'></div>
		<div class='container container-form' id='container-newticket'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='newticket-column'>
					<br>
					<h5 class='text-centered' id='newticket-header'>New Ticket</h5>
					<br>
					<form class='form' action=''>
						<div class='form-group'>
							<input class='form-control' type='text' id='newticket-ticket-title' name='newticketTicketTitle' placeholder='Ticket title'>
						</div>
						<div class='form-group'>
							<textarea wrap='soft' id='newticket-ticket-description' name='newticketTicketDescription' placeholder='Ticket description'>
								
							</textarea>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Submit Ticket' type='submit' name='newticketButtonSubmitTicket'>
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
    <script src='js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
</body>
</html>