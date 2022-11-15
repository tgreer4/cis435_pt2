<?php
include 'main.php';
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['firstname'], $_POST['lastname'],$_POST['username'], $_POST['email'], $_POST['password'], $_POST['cpassword'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['firstname']) ||empty($_POST['lastname']) ||empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('Please complete the registration form!');
}
// Check to see if the email is valid.
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Please provide a valid email address!');
}
// Username must contain only characters and numbers.
if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
    exit('Username must contain only letters and numbers!');
}
// Password must be between 8 and 20 characters long.
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8) {
	exit('Password must be between 8 and 20 characters long!');
}
// Check if both the password and confirm password fields match
if ($_POST['cpassword'] != $_POST['password']) {
	exit('Passwords do not match!');
}
// We need to check if the account with that username exists.
$stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ? OR email = ?');
// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
$stmt->bind_param('ss', $_POST['username'], $_POST['email']);
$stmt->execute();
$stmt->store_result();
// Store the result so we can check if the account exists in the database.
if ($stmt->num_rows > 0) {
	// Username already exists
	echo 'Username and/or email exists!';
} else {
	$stmt->close();
	// Username doesnt exists, insert new account
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	// Generate unique activation code
	$uniqid = account_activation ? uniqid() : 'activated';
	// Default role
	$role = 'Member';
	// Current date
	$date = date('Y-m-d\TH:i:s');
	// Prepare query; prevents SQL injection
	$stmt = $con->prepare('INSERT INTO accounts (firstname, lastname ,username, password, email, activation_code, role, registered, last_seen) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)');
	// Bind our variables to the query
	$stmt->bind_param('sssssssss',$_POST['firstname'], $_POST['lastname'], $_POST['username'], $password, $_POST['email'], $uniqid, $role, $date, $date);
	$stmt->execute();
	$stmt->close();
	// If account activation is required, send activation email
	if (account_activation) {
		// Account activation required, send the user the activation email with the "send_activation_email" function from the "main.php" file
		send_activation_email($_POST['email'], $uniqid);
		echo 'Please check your email to activate your account!';
	} else {
		// Automatically authenticate the user if the option is enabled
		if (auto_login_after_register) {
			// Regenerate session ID
			session_regenerate_id();
			// Declare session variables
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $con->insert_id;
			$_SESSION['role'] = $role;		
			echo 'autologin';
		} else {
			echo 'You have successfully registered! You can now login!';
		}
	}
}
?>