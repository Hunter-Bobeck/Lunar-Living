<?php
    session_start();
    $year = true;
    if (isset($_GET['year']) && $_GET['year'] == 0){
        $year = false;
    }
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<?php
echo"
<body class='background background-dark'>";
		$username = $_SESSION['username'];
		$first_name = $_SESSION['firstName'];
	?>
	<main class = "content_body">
        <div class='container-fluid padding-zero'>
            <?php include 'signInNavbar.php'; ?>
        </div>
        <div class="container-fluid userlease_container">
            <div class="row">
                <div class="col-sm-3">
                    <div class='wrapper'>
                        <aside class='main_sidebar'>
                            <ul>
                                <li><a href='profile.php'>Profile</a></li>
                                <li><a href='user_lease.php'>Lease</a></li>
                                <li><a href='payment.php'>Payment</a></li>
                                <li><a href='ticketStatus.php'>Tickets</a></li>
                                <li class='active'><a href='#'>Stats</a></li>
                                <li><a href='review.php'>Review</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-9">
                    <h2 class = 'lease_info'>Payment Stats</h2>
                    <?php
                    if($year){
                        echo"<div class='margin-bottom'><button class='btn btn-success' onclick='toggleOnByYear()'>Yearly Stats</button>
                        <input id='toggle-triggerYear' type='checkbox' checked data-toggle='toggle'>
                        <button class='btn btn-danger' onclick='toggleOffByMonth()'>Montly Stats</button>
                        <input id='toggle-triggerMonth' type='checkbox' data-toggle='toggle'></div>";
                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentYearStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "year: 2018"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $year2018 = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentYearStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "year: 2017"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $year2017 = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentYearStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "year: 2016"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $year2016 = json_decode($statsData);
                        curl_close($ch);
                        
                        if($year2016 == null){
                            $year2016 = 0;
                        }
                        else{
                            $year2016 = $year2016->total;
                        }
                        if($year2017 == null){
                            $year2017 = 0;
                        }
                        else{
                            $year2017 = $year2017->total;
                        }
                        if($year2018 == null){
                            $year2018 = 0;
                        }
                        else{
                            $year2018 = $year2018->total;
                        }
                        $dataPoints = array(
                            array("x"=> 2016, "y"=> $year2016),
                            array("x"=> 2017, "y"=> $year2017),
                            array("x"=> 2018, "y"=> $year2018)
                            //array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
                        );  
                    }
                    else{
                        echo"<div class='margin-bottom'><button class='btn btn-success' onclick='toggleOnByYear()'>Yearly Stats</button>
                        <input id='toggle-triggerYear' type='checkbox' data-toggle='toggle'>
                        <button class='btn btn-danger' onclick='toggleOffByMonth()'>Montly Stats</button>
                        <input id='toggle-triggerMonth' type='checkbox' checked data-toggle='toggle'></div>";
                        
                        /*$ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 1"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $jan = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 2"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $feb = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 3"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $mar = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 4"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $apr = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 5"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $may = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 6"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $jun = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 7"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $jul = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 8"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $aug = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 9"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $sep = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 10"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $oct = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 11"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $nov = json_decode($statsData);
                        curl_close($ch);

                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            "month: 12"
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $dec = json_decode($statsData);
                        curl_close($ch);*/
                        
                        $ch = curl_init('https://lunar-living.herokuapp.com/paymentAllMonthStats');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'YourScript/0.1 (contact@email)');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            ));
                        $statsData = curl_exec($ch);
                        $info = curl_getinfo($ch);
                        $allMonths = json_decode($statsData);
                        curl_close($ch);
                        $jan = 0;
                        $feb = 0;
                        $mar = 0;
                        $apr = 0;
                        $may = 0;
                        $jun = 0;
                        $jul = 0;
                        $aug = 0;
                        $sep = 0;
                        $oct = 0;
                        $nov = 0;
                        $dec = 0;
                        foreach($allMonths as $currMonth){
                            switch($currMonth->month){
                                case 1:
                                    $jan = $currMonth->total;
                                    break;
                                case 2:
                                    $feb = $currMonth->total;
                                    break;
                                case 3:
                                    $mar = $currMonth->total;
                                    break;
                                case 4:
                                    $apr = $currMonth->total;
                                    break;
                                case 5:
                                    $may = $currMonth->total;
                                    break;
                                case 6:
                                    $jun = $currMonth->total;
                                    break;
                                case 7:
                                    $jul = $currMonth->total;
                                    break;
                                case 8:
                                    $aug = $currMonth->total;
                                    break;
                                case 9:
                                    $sep = $currMonth->total;
                                    break;
                                case 10:
                                    $oct = $currMonth->total;
                                    break;
                                case 11:
                                    $nov = $currMonth->total;
                                    break;
                                case 12:
                                    $dec = $currMonth->total;
                                    break;
                            }
                        }
                        $dataPoints = array(
                            array("x"=> 1, "y"=> $jan),
                            array("x"=> 2, "y"=> $feb),
                            array("x"=> 3, "y"=> $mar),
                            array("x"=> 4, "y"=> $apr),
                            array("x"=> 5, "y"=> $may),
                            array("x"=> 6, "y"=> $jun),
                            array("x"=> 7, "y"=> $jul),
                            array("x"=> 8, "y"=> $aug),
                            array("x"=> 9, "y"=> $sep),
                            array("x"=> 10, "y"=> $oct),
                            array("x"=> 11, "y"=> $nov),
                            array("x"=> 12, "y"=> $dec)
                            //array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
                        );
                    }
                    ?>
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
	</main>

	<!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS � disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Simple Column Chart with Index Labels"
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",   
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        
        }
    </script>
    <script>
        function toggleOnByYear() {
            $('#toggle-triggerYear').prop('checked', true).change()
            $('#toggle-triggerMonth').prop('checked', false).change()
            window.location.href='paymentstats.php'
        }
        function toggleOffByMonth() {
            $('#toggle-triggerMonth').prop('checked', true).change()
            $('#toggle-triggerYear').prop('checked', false).change()
            window.location.href='paymentstats.php?year=0'
        }
    </script>
</body>
</html>