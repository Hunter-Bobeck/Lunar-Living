<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-lunar-landed'>
	<main>
		<nav class='navbar navbar-expand-lg navbar-light bg-light'>
			<a class='navbar-brand' href='index.php'><img src='../images/Title.png' class='title'></a>
			<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
				<span class='navbar-toggler-icon'></span>
			</button>

			<div class='collapse navbar-collapse' id='navbarSupportedContent'>
				<ul class='navbar-nav mr-auto'>
					<li class='nav-item'>
						<a class='nav-link' href='index.php'>Home</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='newticket.php'>New Lease</a>
					</li>
					<li class='nav-item active'>
						<a class='nav-link current-lunar-living-nav-link' href='maintenance.php'>Maintenance <span class='sr-only'>(current)</span></a>
					</li>
				</ul>
			</div>

			<ul class='navbar-nav ml-auto'>
				<li>
					<div class='dropdown'>
						<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Hello, Name </button>
						<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
							<a class='dropdown-item' href='#'>Profile</a>
							<a class='dropdown-item' href='#'>Signout</a>
						</div>
					</div>
				</li>
			</ul>
		</nav>


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
	</main>

	<!-- postJS -->
    <script src='js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
</body>
</html>