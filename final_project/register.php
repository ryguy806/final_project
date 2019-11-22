<?php # This is the registration portion for the Guest book.

$page_title = 'Guest Book Signing';
include('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	require('mysqli_connect.php'); // Connects to the db

	$errors = []; // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));;
	}
	
	
	if (empty($errors)) { // If everything's OK.

		// Register the user in the database...

		require('mysqli_connect.php'); // Connect to the db.

		// Make the query:
		$q = "INSERT INTO guest_book (first_name, last_name, email, date) VALUES ('$fn', '$ln', '$e', NOW() )";
		$r = @mysqli_query($dbc, $q); // Run the query.
		if ($r) { //No errors

			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You have signed the guest book. The next page will show you who else has signed in.</p><p><br></p>';

		} else { //Errors

			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

			echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

		}

		mysqli_close($dbc);

		include('includes/footer.html');
		exit();

	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p><p><br></p>';

	}
	
	mysqli_close($dbc);

}
?>
<h1>Register</h1>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>
	<p>Email Address: <input type="email" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>
	<p><input type="submit" name="submit" value="Register"></p>
	
	<?php
	echo $dbc;
	echo $q;

	?>
</form>
<?php include('includes/footer.html'); ?>