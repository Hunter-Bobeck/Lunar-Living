<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-lunar-landed'>
	<main>
		
	<?php include 'navbar.php'; ?>

		<div id='spacer-maintenance'></div>


		<div class='container container-maintenance-ticket'>
			<h5 class='maintenance-ticket-title'>Patch up oxygen leak</h5>
			<h5 class='maintenance-ticket-subtitle'>You created this ticket on: <span class='maintenance-ticket-date'>10/20/2018</span></h5>
			<div class='container container-maintenance-ticket-content'>
				<h6>
					There is a hole in the oxygen supply, please apply some moon tape!<br>This particular task is an example task for the tenant's view. Also the 'Create Ticket' button down below is for the tenant's view.
				</h6>
			</div>
			<input class='btn btn-info btn-md button-maintenance-ticket' value='Cancel Request' type='submit'>
		</div>
		<div class='container container-maintenance-ticket'>
			<h5 class='maintenance-ticket-title'>
				Patch up oxygen leak
			</h5>
			<h5 class='maintenance-ticket-subtitle'>
				<span class='maintenance-ticket-user'>Joe Smith</span> created on: <span class='maintenance-ticket-date'>10/20/2018</span>
			</h5>
			<div class='container container-maintenance-ticket-content'>
				<h6>
					There is a hole in the oxygen supply, please apply some moon tape!<br>This particular task is an example task for the maintainer's view. 
				</h6>
			</div>
			<input class='btn btn-info btn-md button-maintenance-ticket' value='Complete Task' type='submit'>
		</div>
		<div class='container container-maintenance-ticket'>
			<h5 class='maintenance-ticket-title'>
				Patch up oxygen leak
			</h5>
			<h5 class='maintenance-ticket-subtitle'>
				<span class='maintenance-ticket-user'>Joe Smith</span> created on: <span class='maintenance-ticket-date'>10/20/2018</span>
			</h5>
			<h5 class='maintenance-ticket-subtitle'>
				You assigned this job to <span class='maintenance-ticket-user'>Bob Worker</span>.
			</h5>
			<div class='container container-maintenance-ticket-content'>
				<h6>
					There is a hole in the oxygen supply, please apply some moon tape!<br>This particular task is an example task for the manager's view. 
				</h6>
			</div>
			<input class='btn btn-info btn-md button-maintenance-ticket' value='Remove Ticket' type='submit'>
		</div>
		<div class='text-centered'>
			<a href='newticket.php'>
				<input class='btn btn-info btn-md button-maintenance-ticket' value='New Ticket' type='submit'>
			</a>
		</div>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->

</body>
</html>