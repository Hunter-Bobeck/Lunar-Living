<!doctype html>
<html lang='en'>
<?php include 'header.php'; ?>
<body class="background background-moon-in-space">
<main>
<?php include 'navbar.php'; ?>


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
    <br>
    <br>


    <footer class='footer'>
    <div class='container'>
    Copyright 2018 IU-SE-G2
    </div>
    </footer>
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
