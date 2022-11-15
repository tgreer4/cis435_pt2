<?php
include 'main.php';
// Check logged-in
check_loggedin($con);
// output message (errors, etc)
$msg = '';
// Retrieve additional account info from the database because we don't have them stored in sessions
$stmt = $con->prepare('SELECT firstname, lastname,password, email, activation_code, role, registered FROM accounts WHERE id = ?');
// In this case, we can use the account ID to retrieve the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($firstname, $lastname,$password, $email, $activation_code, $role, $registered_date);
$stmt->fetch();
$stmt->close();
// Handle edit profile post data
if (isset($_POST['firstname'],$_POST['lastname'],$_POST['username'], $_POST['password'], $_POST['cpassword'], $_POST['email'])) {
	// Make sure the submitted registration values are not empty.
	if (empty($_POST['firstname']) ||empty($_POST['lastname']) ||empty($_POST['username']) || empty($_POST['email'])) {
		$msg = 'The input fields must not be empty!';
	} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$msg = 'Please provide a valid email address!';
	} else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
	    $msg = 'Username must contain only letters and numbers!';
	} else if (!empty($_POST['password']) && (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8)) {
		$msg = 'Password must be between 8 and 20 characters long!';
	} else if ($_POST['cpassword'] != $_POST['password']) {
		$msg = 'Passwords do not match!';
	}
	// No validation errors... Process update
	if (empty($msg)) {
		// Check if new username or email already exists in the database
		$stmt = $con->prepare('SELECT * FROM accounts WHERE (username = ? OR email = ?) AND username != ? AND email != ?');
		$stmt->bind_param('ssss', $_POST['username'], $_POST['email'], $_SESSION['name'], $email);
		$stmt->execute();
		$stmt->store_result();
		// Account exists? Output error...
		if ($stmt->num_rows > 0) {
			$msg = 'Account already exists with that username and/or email!';
		} else {
			// No errors occured, update the account...
			$stmt->close();
			// If email has changed, generate a new activation code
			$uniqid = account_activation && $email != $_POST['email'] ? uniqid() : $activation_code;
			$stmt = $con->prepare('UPDATE accounts SET firstname= ?,  lastname= ?, username = ?, password = ?, email = ?, activation_code = ? WHERE id = ?');
			// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $password;
			$stmt->bind_param('ssssssi',$_POST['firstname'],$_POST['lastname'], $_POST['username'], $password, $_POST['email'], $uniqid, $_SESSION['id']);
			$stmt->execute();
			$stmt->close();
			// Update the session variables
			$_SESSION['name'] = $_POST['username'];
			if (account_activation && $email != $_POST['email']) {
				// Account activation required, send the user the activation email with the "send_activation_email" function from the "main.php" file
				send_activation_email($_POST['email'], $uniqid);
				// Logout the user
				unset($_SESSION['loggedin']);
				$msg = 'You have changed your email address! You need to re-activate your account!';
			} else {
				// Profile updated successfully, redirect the user back to the profile page
				header('Location: userprofile.php');
				exit;
			}
		}
	}
}
?>













<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Business website</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-highway.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="userprofilestyle.css">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>

      <div class="navigation w3-highway-blue w3-container">
        <nav class="nav-container w3-padding-large">
          <div class="logo">
            <a href="mainwbsitesigned.php" >Inner<span>View</span></a>
          </div>
          <div class="mobile-button">
            <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
          </div>
          <div class="links">
            <a href="mainwbsitesigned.php" >Home</a>
            <a href="faqsignedpage.php" >FAQ</a>
          
             
		
		
		
		
		
		 <div class="actionpro">
        <div class="profile" onclick="menuToggle();">
            <img src="user.png" alt="">
        </div>

        <div class="menu">
            <h3>
                User Account
                <div class="usernameid" >
							<?=$_SESSION['name']?>
				</div>
            </h3>
            <ul>
                <li>
                    <span class="material-icons icons-size">person</span>
                    <a href="userprofile.php">My Profile</a>
                </li>
                <li>
                    <span class="material-icons icons-size">mode</span>
                    <a href="userprofile.php?action=edit">Edit Account</a>
                </li>
               
                <li>
                    <span class="material-icons icons-size">account_balance_wallet</span>
                    <a href="logout.php">Log out</a>
                </li>
				
            </ul>
        </div>
    </div>
		
		
		
		
		
		
		
		
          </div>
		  
          <div id="mobile-sidenav" class="mobile-links w3-highway-blue">
            <div class="mobile-logo" style="display: inline;">
              <a href="#home" class="logo">Inner<span>View</span></a>
              <span style="width: 100%;"></span>
              <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
            </div>
            <a href="mainwbsitesigned.php" onclick="toggleMobileNavigation()">Home</a>
            <a href="#faq" onclick="toggleMobileNavigation()">FAQ</a>
            
          
          </div>
        </nav>
      </div>

      <div class="hero" id="home">
        <div class="crumbs">
		
		<ul>
			<li><a href="mainwbsitesigned.php"><i class="fa fa-home"></i></a></li>
			<?php if (!isset($_GET['action'])): ?>
			<li><a href="userprofile.php"><i class="fa fa-company"></i> User Profile</a></li>
			<?php elseif ($_GET['action'] == 'edit'): ?>
			<li><a href="userprofile.php?action=edit"><i class="fa fa-company"></i> User Profile edit</a></li>
			<?php endif; ?>
		</ul>
	</div>
	
	<div class="containeruserpro">
    <div class="main-body">
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?=$firstname?>  <?=$lastname?></h4>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                    <span class="text-secondary">https://bootdey.com</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">@bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                </ul>
              </div>
            </div>
			
			
			
			<?php if (!isset($_GET['action'])): ?>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-bodytwo">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?=$firstname?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
				  
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?=$lastname?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">User Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?=$_SESSION['name']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?=$email?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Role</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?=$role?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="profile-btn" href="userprofile.php?action=edit">Edit Details</a>
                    </div>
                  </div>
                </div>
              </div>

              



            </div>
			
			<?php elseif ($_GET['action'] == 'edit'): ?>
			<div class="col-lg-8">
					<div class="card">
						<div class="card-bodytwo">
							<form action="userprofile.php?action=edit" method="post">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">First Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?=$firstname?>" name="firstname" id="firstname" placeholder="Firstname">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Last Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?=$lastname?>" name="lastname" id="lastname" placeholder="Lastname">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">User Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?=$_SESSION['name']?>" name="username" id="username" placeholder="Username">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?=$email?>" name="email" id="email" placeholder="Email">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control"  name="password" id="password" placeholder="New Password">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Confirm Password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control"  name="cpassword" id="cpassword" placeholder="Confirm Password">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input class="profile-btn" type="submit" value="Save"> 
								</div>
							</div>
							<p><?=$msg?></p>
							
							</form>
						</div>
					</div>
					
				</div>
			<?php endif; ?>
			
			
			
			
          </div>

        </div>
    </div>
	
	
	
	
		
      </div>
	  
    </div>

		
	

     <div class=" w3-highway-blue w3-padding-large" id="footer">
        <p class="w3-center logo">© 2022 - Inner<span>View</span> - All rights reserved</p>
	
      </div>
	  
	
      
<script>
 


 function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active')
        }

 
 
 
 
 
 
 
 
 
 

//pop up form review



$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})







//pop up form review
 /*$(document).ready(function(){
           $('.addbutton').click(function(){
             $('.modal-boxtwo').toggleClass("show-modal");
             $('.addbutton').toggleClass("show-modal");
           });
           $('.fa-times').click(function(){
             $('.modal-boxtwo').toggleClass("show-modal");
             $('.addbutton').toggleClass("show-modal");
           });
         });*/


 
 
 //pop up form review
 /*$(document).ready(function(){
           $('.addbutton').click(function(){
             $('.modal-box').toggleClass("show-modal");
             $('.addbutton').toggleClass("show-modal");
           });
           $('.fa-times').click(function(){
             $('.modal-box').toggleClass("show-modal");
             $('.addbutton').toggleClass("show-modal");
           });
         });*/
		 
		 
		 
 </script>
 

  </body>
</html>