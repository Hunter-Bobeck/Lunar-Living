<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<head>
	<link rel='stylesheet' href='../css/bootstrap-datepicker3.css'>		<!-- Bootstrap Datepicker 3 CSS -->
</head>
<body class='background background-chilling'>
	<main>
		
	<?php include 'signInNavbar.php'; ?>

		<div class='spacer-events'></div>

		<div id='events-background'>
			<br>
			<h1 id='events-header'>
				Events
			</h1>
			<br>
			<br>
			<div class='createevent-container'>
				<br>
				<h1 class='event-title'>Edit Event</h1>
				<div class='createevent-form-container'>
					<form action='createnewevent.php' method='post'>
						<div class='form-group text-centered'>
							<br>
							<h4>SHOW TITLE OF EVENT</h4>
							<br>
							<h4>SHOW DATE OF EVENT</h4>
							<br>
							<h4>Description</h4>
							<div class='form-group'>
								<textarea wrap='soft' id='createevent-description-input' name='createeventDescriptionInput' placeholder='Event description'></textarea>
							</div>
							<br>
							<button type='submit' class='btn btn-info btn-md'>Update Event</button>
							<button type='submit' class='btn btn-warning btn-md'>Cancel Update</button>
							<button type='submit' class='btn btn-danger btn-md'>Cancel Event</button>
						</div>
					</form>
				</div>
				<br>
			</div>
			<br>
			<br>
		</div>

		<div class='spacer-events'></div>
		
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS – disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
	<script type='text/javascript' src='../js/bootstrap-datepicker.min.js'></script>		<!-- Bootstrap Datepicker 3 JS -->
	<!-- Bootstrap Datepicker 3 JS - for initialization -->
	<script>
	    $(function()
		{
	        $('#datepicker').datepicker(
			{
	            format: 'mm/dd/yyyy',
	            autoclose: true,
	            todayHighlight: true,
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        autoclose: true,
		        changeMonth: true,
		        changeYear: true,
		        orientation: 'button'
	        });
	    });
	</script>

</body>
</html>