<?php
include 'main.php';
// No need for the user to see the login form if they're logged-in, so redirect them to the home page
if (isset($_SESSION['loggedin'])) {
	// If the user is not logged in, redirect to the home page.
	header('Location: mainwbsitesigned.php');
	exit;
}
// Also check if they are "remembered"
if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme'])) {
	// If the remember me cookie matches one in the database then we can update the session variables.
	$stmt = $con->prepare('SELECT id, username, role FROM accounts WHERE rememberme = ?');
	$stmt->bind_param('s', $_COOKIE['rememberme']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		// Found a match
		$stmt->bind_result($id, $username, $role);
		$stmt->fetch();
		$stmt->close();
		// Authenticate the user
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $username;
		$_SESSION['id'] = $id;
		$_SESSION['role'] = $role;
		// Update last seen date
		$date = date('Y-m-d\TH:i:s');
		$stmt = $con->prepare('UPDATE accounts SET last_seen = ? WHERE id = ?');
		$stmt->bind_param('si', $date, $id);
		$stmt->execute();
		$stmt->close();
		// Redirect to the home page
		header('Location: home.php');
		exit;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="websitesigninStyle.css">
  </head>
  <body>

      <div class="navigation w3-highway-blue w3-container">
        <nav class="nav-container w3-padding-large">
          <div class="logo">
            <a href="#home" >Inner<span>View</span></a>
          </div>
          <div class="mobile-button">
            <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
          </div>
          <div class="links">
            <a href="#home" >Home</a>
          
           
            <a href="#Companies" >Companies</a>
            <a href="#faq" >FAQ</a>            
          </div>
          <div id="mobile-sidenav" class="mobile-links w3-highway-blue">
            <div class="mobile-logo" style="display: inline;">
              <a href="#home" class="logo">Inner<span>View</span></a>
              <span style="width: 100%;"></span>
              <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
            </div>
            <a href="#home" onclick="toggleMobileNavigation()">Home</a>
           
           
            <a href="#Companies" onclick="toggleMobileNavigation()">Companies</a>
            <a href="#faq" onclick="toggleMobileNavigation()">FAQ</a>
          </div>
        </nav>
		
      </div>

      <div class="hero" id="home">
        <div class="text container">
          <div class="containerr" id="containerr">

	<div class="form-container sign-up-container">
		<form action="">
		<h1>Create Account</h1>
		<div class="social-container">
			<a href="#" class="social"><i class="fa fa-facebook"></i></a>
			<a href="#" class="social"><i class="fa fa-google"></i></a>
			<a href="#" class="social"><i class="fa fa-linkedin"></i></a>
		</div>
		<span>or use your email for registration</span>
		<input type="text" firstname="firstname" placeholder="FirstName">
		<input type="text" lastname="lastname" placeholder="LastName">
		<input type="text" name="name" placeholder="UserName">
		<input type="email" name="email" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
		<button>SignUp</button>
		</form>
	</div>

	<div class="form-container sign-in-container">
		<form action="#">
			<h1>Sign In</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fa fa-facebook"></i></a>
				<a href="#" class="social"><i class="fa fa-google"></i></a>
				<a href="#" class="social"><i class="fa fa-linkedin"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" name="email" placeholder="Email">
			<input type="password" name="password" placeholder="Password">
			<label id="rememberme">
					<input type="checkbox" name="rememberme">Remember me
				</label>
			<a href="#">Forgot Your Password</a>
			<button>Sign In</button>
		</form>
	</div>

	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>InnerView</h1>
				<p>The best way to be prepared</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>

			<div class="overlay-panel overlay-right">
				<h1>Welcome Back!</h1>
				<p>Getting a job never been easier</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>


        </div>
		
      </div>

     

     

    

      

           

     <script src="websitesignincontroler.js"></script>      

      

    

<style>







<style>
  </body>
</html>