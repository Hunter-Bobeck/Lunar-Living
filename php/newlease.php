<!doctype html>
<html lang='en'>
<head>
    <!-- metadata -->
    <meta charset='utf-8'>
    <!-- Unicode characterset -->
    <meta http-equiv='X-UA-Compatible' content='IE=epdge'>
    <!-- Internet Explorer compatibility -->
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- renders the page according to the device width -->
    <meta name='description' content='Rent a living space, in outer space.'>
    <!-- description [shown on searchengine result] -->
    <meta name='keywords' content='Kidd, Living, space, rental, service, management, system, SpaceX, outer, Elon, Musk'>
    <!-- keywords for searchengine optimization -->
    <meta name='author' content='IU SE G2'>
    <!-- author name -->
    <link rel='icon' href='../images\Icon.ico'>
    <!-- favicon -->
    <title>Lunar Living | New Lease</title>
    <!-- title -->

    <!-- CSS -->
    <link rel='stylesheet' href='../css/reset.css'>		<!-- Reset CSS -->
    <link rel='stylesheet' href='../css/bootstrap.min.css'>		<!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/fontawesome.min.css'>		<!-- Font Awesome CSS -->
    <link rel='stylesheet' href='../css/daterangepicker.css'>		<!-- Date Range Picker CSS -->
    <link rel='stylesheet' href='../css/style.css'>		<!-- custom CSS -->
</head>
<<<<<<< HEAD
<body>
<main>
    <nav class='navbar navbar-expand-lg navbar-light bg-light' style='overflow: hidden'>
        <a class='navbar-brand' href='index.html'><img src='images\Title.png' class='title'></a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
=======
<body class="background background-moon-in-space">
	<main>
		<nav class='navbar navbar-expand-lg navbar-light bg-light' style='overflow: hidden'>
			<a class='navbar-brand' href='index.php'><img src='../images/Title.png' class='title'></a>
			<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
				<span class='navbar-toggler-icon'></span>
			</button>
>>>>>>> c033624aa87261698242cd65d969637a9724e1ce

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'>
                    <a class='nav-link' href='index.html'>Home</a>
                </li>
                <li class='nav-item active'>
                    <a class='nav-link current-lunar-living-nav-link' href='newlease.html'>New Lease <span class='sr-only'>(current)</span></a>
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


<<<<<<< HEAD
    <div id='spacer-newlease'></div>
    <div class='container container-form' id='container-newlease'>
        <div class='row justify-content-center align-items-center'>
            <div class='col-md-7' id='newlease-column'>
                <br>
                <h5 class='text-centered'>New Lease Agreement</h5>
                <br>
                <form class='form' action=''>
                    <div class='form-group'>
                        <input class='form-control' type='text' id='newlease-start-date' name='newleaseDateRange' placeholder='Apartment ID'>
                    </div>
                    <div class='form-group'>
                        <input class='form-control' type='text' id='newlease-apartment-id' name='newleaseApartmentID' placeholder='Apartment ID'>
                        <!-- <div class='form-group' id = 'email-list'>
                            <input class='form-control' type='text' name='newleaseEmailID1' placeholder='Email ID #1'>
                        </div>
                        <div class='form-group text-centered'>
                            <!-- <button class='btn btn-primary'>
                                <span id='newlease-remove-email-button' class='button-add-or-remove-text'>-</span>
                            </button> -->
                        <table  id="dynamic_field">
                            <tr>
                                <td><input type="text" name="newleaseEmailID[]" placeholder="Email ID #1" class="form-control email_list" /></td>
                                <td><a type="button" name="add" id="add" class="btn btn-success">Add More</a></td>
                            </tr>
                        </table>
                        <div class='form-group text-centered'>
                            <input class='btn btn-info btn-md' value='Create Lease' type='submit' name='newleaseButtonCreateLease'>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>


    <!-- <footer class='footer'>
    <div class='container'>
    Copyright 2018 IU-SE-G2
    </div>
    </footer>
    </main> -->
=======
		<div id='spacer-newlease'></div>
		<div class='container container-form' id='container-newlease'>
			<div class='row justify-content-center align-items-center'>
				<div class='col-md-7' id='newlease-column'>
					<br>
					<h5 class='text-centered'>New Lease Agreement</h5>
					<br>
					<form class='form' action=''>
						<div class='form-group'>
							<input class='form-control' type='text' id='newlease-start-date' name='newleaseDateRange' placeholder='Apartment ID'>
						</div>
						<div class='form-group'>
							<input class='form-control' type='text' id='newlease-apartment-id' name='newleaseApartmentID' placeholder='Apartment ID'>
						</div>
						<div class='form-group'>
							<input class='form-control' type='text' id='newlease-apartment-id' name='newleaseApartmentID' placeholder='Apartment ID'>
						</div>
						<div class='form-group'>
							<input class='form-control' type='text' name='newleaseEmailID1' placeholder='Email ID #1'>
						</div>
						<div class='form-group text-centered'>
							<button class='btn btn-primary'>
								<span id='newlease-remove-email-button' class='button-add-or-remove-text'>-</span>
							</button>
							<button class='btn btn-primary'>
								<span id='newlease-add-email-button' class='button-add-or-remove-text'>+</span>
							</button>
						</div>
						<div class='form-group text-centered'>
							<input class='btn btn-info btn-md' value='Create Lease' type='submit' name='newleaseButtonCreateLease'>
						</div>
					</form>
				</div>
			</div>
		</div>
		<br>
		<br>
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
            var i=1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="newleaseEmailID[]" placeholder="EmailID #'+i+'" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#submit').click(function(){
                $.ajax({
                    url:"addLease.php",
                    method:"POST",
                    data:$('#add_name').serialize(),
                    success:function(data)
                    {
                        alert(data);
                        $('#add_name')[0].reset();
                    }
                });
            });

        });
    </script>

</body>
</html>
