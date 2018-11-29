<?php
	session_start();
?>
<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class="background background-moon-in-space">

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
                                <?php
                                if($_SESSION["usertype"] == 1){
                                    echo"<li><a href='user_lease.php'>Lease</a></li>
                                    <li><a href='payment.php'>Payment</a></li>";
                                }
                                if($_SESSION["usertype"] == 2){
                                    echo"<li class='active'><a href='newlease.php'>New Lease</a></li>";
                                    echo"<li><a href='allLogin.php'>All Users</a></li>";
                                    echo"<li><a href='allLease.php'>All Leases</a></li>";
                                    echo"<li><a href='appointments.php'>All Appointments</a></li>";
                                    echo"<li><a href='allpromocodes.php'>All Promo Codes</a></li>";
                                }
                                if($_SESSION["usertype"] == 2){
                                    echo"<li><a href='adminchat.php'>Chats</a></li>";
                                }
                                ?>
                                <li><a href='ticketStatus.php'>Tickets</a></li>
                                <?php
                                if($_SESSION["usertype"] == 2){
                                    echo"<li><a href='map.php'>Ticket Map</a></li>";
                                }
                                ?>
                                <li><a href='events.php'>Events</a></li>
                                <li><a href='laundry.php'>Laundry</a></li>
                                <li><a href='review.php'>Review</a></li>
                                <?php
                                if($_SESSION["usertype"] == 2){
                                    echo"<li>
                                        <a onclick='displayStats()' href='#'>Stats</a>
                                        <ul id='statsChilds' class= 'statsChilds'>
                                            <li><a href='paymentstats.php'>Payment Stats</a></li>
                                            <li><a href='ticketstats.php'>Ticket Area Stats</a></li>
                                            <li><a href='ticketstatsstatus.php'>Ticket Status Stats</a></li>
                                        </ul>
                                    </li>";
                                }
                                ?>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="container">
                        <div id='spacer-newlease'></div>
                        <div class='container container-form' id='container-newlease'>
                            <div class='row justify-content-center align-items-center'>
                                <div class='col-md-7' id='newlease-column'>
                                    <br>
                                    <h5 class='text-centered'>New Lease Agreement</h5>
                                    <br>
                                    <form class='form' id = 'form-data' action='addLease.php' method = 'post'>
                                        <div class='form-group'>
                                            <input class='form-control' type='text' id='newlease-start-date' name='newleaseDateRange' placeholder='Apartment ID'>
                                        </div>
                                        <div class='form-group text-centered'>
                                            <input class='form-control' type='text' id='newlease-apartment-id' name='newleaseApartmentID' placeholder='Apartment ID'>
                                            <table class = 'text-centered' id="dynamic_field">
                                                <tr>
                    <!--                                <td><input type="text" name="newleaseEmailID" placeholder="Email ID #1" class="form-control email_list" /></td>-->
                                                    <td><a class = 'btn btn-info btn-md' type="button" name="add" id="add" class="btn btn-success">Add Email</a></td>
                                                </tr>
                                            </table>
                                            <div class='form-group text-centered'>
                                                <input class='btn btn-info btn-md' value='Create Lease' type='submit' name='newleaseButtonCreateLease'>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
	</main>

    <!-- postJS -->
    <script src='../js/jquery-3.3.1.js'></script>		<!-- Jquery JS (necessary for dropdowns) -->
    <script src='../js/bootstrap.bundle.min.js'></script>		<!-- Bootstrap Bundle JS (necessary for dropdowns) -->
    <!-- <script src='js/bootstrap.min.js'></script> -->		<!-- Bootstrap JS ? disabled because when enabled it has a conflict with Bootstrap Bundle JS that makes dropdowns require two clicks to dropdown; it doesn't seem that any needed functionality is lacking when this is disabled -->
    <script src='../js/moment.min.js'></script>		<!-- Moment JS (necessary for Date Range Picker) -->
    <script src='../js/daterangepicker.min.js'></script>		<!-- Date Range Picker JS (http://www.daterangepicker.com/#usage) -->
    <script type='text/javascript'>
        $('input[name="newleaseDateRange"]').daterangepicker();
    </script>

    <script>
        $(document).ready(function(){
            var i=0;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="newleaseEmailID[]" placeholder="EmailID #'+i+'" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
        });
    </script>
</body>
</html>
