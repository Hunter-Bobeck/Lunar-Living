<nav class='navbar navbar-expand-lg navbar-light bg-light'>
			<a class='navbar-brand' href='index.php'><img src='../images/Title.png' class='title'></a>
			<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
				<span class='navbar-toggler-icon'></span>
			</button>

			<div class='collapse navbar-collapse' id='navbarSupportedContent'>
				<ul class='navbar-nav mr-auto'>
					<li class='nav-item active'>
						<a class='nav-link current-lunar-living-nav-link' href='index.php'>Home <span class='sr-only'>(current)</span></a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='newlease.php'>New Lease</a>
					</li>
				</ul>
			</div>

			<?php
            if(isset($_SESSION['username'])){
			    echo"<ul class='navbar-nav ml-auto'>";
                    echo "<li>
					<div class='dropdown'>
						<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Hello, ". $userInfoData->first_name ."</button>
						<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
							<a class='dropdown-item' href='#'>Signout</a>
						</div>
					</div>
                    </li>";
                echo "</ul>";
            }
            else{
                echo"<a class='login-link' href = 'login.php'>Login</a>";
            }
            ?>
		</nav>