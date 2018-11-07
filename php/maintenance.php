<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-lunar-landed'>
	<main>
		<nav class='navbar navbar-expand-lg navbar-light bg-light'>
			<a class='navbar-brand' href='index.php'><img src='../images\Title.png' class='title'></a>

			<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
				<span class='navbar-toggler-icon'></span>
			</button>

			<div class='collapse navbar-collapse' id='navbarSupportedContent'>
				<ul class='navbar-nav mr-auto'>
					<li class='nav-item'>
						<a class='nav-link' href='index.php'>Home</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='newlease.php'>New Lease</a>
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