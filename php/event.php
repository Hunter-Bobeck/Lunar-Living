<?php
	session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class='background background-chilling'>
	<main>
		
	<?php include 'signInNavbar.php'; ?>
		<?php
			if (isset($_GET["eventID"])) {
				$eventID = $_GET["eventID"];
				$username = $_SESSION['username'];
				$ch = curl_init('https://lunar-living.herokuapp.com/getEventInfo');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					"event_id: $eventID"
					));
				$data = curl_exec($ch);
				$info = curl_getinfo($ch);
				$eventInfo = json_decode($data);
				curl_close($ch);
				
				echo"<div class='spacer-events'>
					<a href='events.php' class='backLink'>Back</a>
				</div>

				<div id='events-background'>
					<br>
					<h1 id='events-header'>
						Events
					</h1>
					<br>
					<br>
					<div class='event-container'>
						<h1 class='event-title'>". $eventInfo->title ."</h1>
						<img class='event-banner' src='../images/Moon Golf - Banner.jpg'/>
						<p class='event-date'>". substr($eventInfo->eventDate, 0, 10) ."</p>
						<div class='event-description-holder'>
							<p class='event-description'>". $eventInfo->describtion ."</p>
						</div>";
						if(strpos($eventInfo->intrested, $username) !== false || strpos($eventInfo->maybe, $username) !== false || strpos($eventInfo->notIntrested, $username) !== false){
							if(strpos($eventInfo->intrested, $username) !== false){
								echo"<a class='event-link-selected' href='#'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
								<a class='event-link' href='updatemaybe.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
								<a class='event-link' href='updatenotintrested.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
							}
							else if(strpos($eventInfo->maybe, $username) !== false){
								echo"<a class='event-link' href='updateIntrested.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
								<a class='event-link-selected' href='#'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
								<a class='event-link' href='updatenotintrested.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
							}
							else{
								echo"<a class='event-link' href='updateIntrested.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
								<a class='event-link' href='updatemaybe.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
								<a class='event-link-selected' href='#'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
							}	
						}
						else{
							echo"<a class='event-link' href='updateIntrested.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-calendar-check-o fa-2x fa-pull-left' aria-hidden='true'></i></a>
							<a class='event-link' href='updatemaybe.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-question-circle fa-2x' aria-hidden='true'></i></a>
							<a class='event-link' href='updatenotintrested.php?eventID=". $eventInfo->eventId ."'><i class='fa fa-calendar-times-o fa-2x fa-pull-right' aria-hidden='true'></i></a>";
						}
						echo"
					</div>
					<br>
					<br>
				</div>
		
				<div class='spacer-events'></div>";		
			}
		?>
		
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->

</body>
</html>