<?php
	session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
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
			<div class='events-grid-container'>
			<div class='events-grid-item'>
					<a class='event-link' href='createevent.php'>
						<p class='events-event-title'>Create New</p>
						<br>
						<img class='event-thumbnail' src='../images/New Event.png'/>
					</a>
				</div>
				<?php
				$username = $_SESSION['username'];
				$ch = curl_init('https://lunar-living.herokuapp.com/getAllEvents');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json'
					));
				$data = curl_exec($ch);
				$info = curl_getinfo($ch);
				$eventAllData = json_decode($data);
				curl_close($ch);
				foreach($eventAllData as $event){
					echo "<div class='events-grid-item'>
						<a class='event-link' href='event.php?eventID=". $event->eventId ."'>
							<p class='events-event-title'>". $event->title ."</p>
							<img class='event-thumbnail' src='../images/event1.jpg'/>
							<p class='events-event-date'>". substr($event->eventDate, 0, 10) ."</p>";
							if(strpos($event->intrested, $username) !== false || strpos($event->maybe, $username) !== false || strpos($event->notIntrested, $username) !== false){
								if(strpos($event->intrested, $username) !== false){
									echo"<a class='event-link-selected' href='#'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
									<a class='event-link' href=''><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
									<a class='event-link' href='#'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
								}
								else if(strpos($event->maybe, $username) !== false){
									echo"<a class='event-link' href='#'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
									<a class='event-link-selected' href=''><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
									<a class='event-link' href='#'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
								}
								else{
									echo"<a class='event-link' href='#'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
									<a class='event-link' href=''><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
									<a class='event-link-selected' href='#'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
								}	
							}
							else{
								echo"<a class='event-link' href='updateIntrested.php?eventID=". $event->eventId ."'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
								<a class='event-link' href='updatemaybe.php?eventID=". $event->eventId ."'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
								<a class='event-link' href='updatenotintrested.php?eventID=". $event->eventId ."'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
							}
							echo"
						</a>
					</div>";
				}
				?>
			</div>
			<br>
		</div>

		<div class='spacer-events'></div>
		
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->

</body>
</html>