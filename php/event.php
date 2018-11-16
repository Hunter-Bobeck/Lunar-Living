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
			<div class='event-container'>
				<h1 class='event-title'>Moon Golf</h1>
				<img class='event-banner' src='../images/Moon Golf - Banner.jpg'/>
				<p class='event-date'>12/20/2018</p>
				<div class='event-description-holder'>
					<p class='event-description'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In egestas purus a tortor cursus, in aliquam velit pulvinar. Donec sit amet erat commodo, mollis magna a, maximus mauris.<br>&nbsp;&nbsp;- Interdum!<br>&nbsp;&nbsp;- Phasellus!<br>&nbsp;&nbsp;- Aenean!<br>Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam pellentesque arcu non pulvinar finibus. Morbi eu placerat nibh, eget consequat erat. Phasellus non ornare purus. Praesent elementum enim ac nunc tincidunt iaculis. Integer quis ligula magna. Praesent elementum tortor a ipsum fermentum pharetra. Aenean pharetra risus enim, sit amet porttitor metus dignissim eget.</p>
				</div>
				<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-check-o fa-2x event-icon' aria-hidden='true'></i></a>
				<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-question-circle fa-2x event-icon' aria-hidden='true'></i></a>
				<a class='event-link' href='#attendance-link-placeholder'><i class='fa fa-calendar-times-o fa-2x event-icon' aria-hidden='true'></i></a>
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

</body>
</html>