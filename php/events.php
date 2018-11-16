<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-chilling'>
	<main>
		
	<?php include 'navbar.php'; ?>

		<div class='spacer-events'></div>

		<div id='events-background'>
			<br>
			<h1 id='events-header'>
				Events
			</h1>
			<br>
			<br>
			<div class='events-grid-container'>
				<div class='events-grid-item'>
					<a class='event-link' href='event.php'>
						<p class='events-event-title'>Moon Golf</p>
						<img class='event-thumbnail' src='../images/Moon Golf.jpg'/>
						<p class='events-event-date'>12/20/2018</p>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>
					</a>
				</div>
				<div class='events-grid-item'>
					<a class='event-link' href='event.php'>
						<p class='events-event-title'>Space Lounge: Grand Opening</p>
						<img class='event-thumbnail' src='../images/Space Lounge.jpg'/>
						<p class='events-event-date'>12/31/2018</p>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>
					</a>
				</div>
				<div class='events-grid-item'>
					<a class='event-link' href='event.php'>
						<p class='events-event-title'>Gravity Dance</p>
						<img class='event-thumbnail' src='../images/Gravity Dance.jpg'/>
						<p class='events-event-date'>2/4/2019</p>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>
					</a>
				</div>
				<div class='events-grid-item'>
					<a class='event-link' href='event.php'>
						<p class='events-event-title'>Moon Buggy Ride</p>
						<img class='event-thumbnail' src='../images/Moon Buggy Ride.jpg'/>
						<p class='events-event-date'>4/2/2019</p>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>
					</a>
				</div>
				<div class='events-grid-item'>
					<a class='event-link' href='event.php'>
						<p class='events-event-title'>Planet Painting</p>
						<img class='event-thumbnail' src='../images/Planet Painting.jpg'/>
						<p class='events-event-date'>9/8/2019</p>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>
					</a>
				</div>
				<div class='events-grid-item'>
					<a class='event-link' href='event.php'>
						<p class='events-event-title'>Jetpack Racing</p>
						<img class='event-thumbnail' src='../images/Jetpack Racing.png'/>
						<p class='events-event-date'>8/15/2020</p>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
						<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>
					</a>
				</div>
				<div class='events-grid-item'>
					<a class='event-link' href='event.php'>
						<p class='events-event-title'>Create New</p>
						<br>
						<img class='event-thumbnail' src='../images/New Event.png'/>
					</a>
				</div>
			</div>
			<br>
		</div>

		<div class='spacer-events'></div>
		
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS – disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
	<!-- change color

</body>
</html>