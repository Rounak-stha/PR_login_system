<?php
	if (isset($_POST['login-submit'])) {

		require 'dbh.php';   // database connection

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (empty($email) || empty($username) || empty($password)) {
			header("location: ../index.php?error=emptyfields");
			exit();
		}
		else{
			$query = "SELECT * FROM users WHERE username = ? OR email = ?;";
			$prep_statement = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($prep_statement, $query)) {
				header("Location: ../index.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($prep_statement, "ss", $username, $email);
				mysqli_stmt_execute($prep_statement);
				$result = mysqli_stmt_get_result($prep_statement); // get_result returns a resource or result object so we can use the fetch functions, store result returns ture on success and false and wecant use the fetch functions
				if ($row = mysqli_fetch_assoc($result)) { // Fetch a result row as an associative array
					$pass_check = password_verify($password, $row['password']); // check the user supplied password with the hashed password in the databse
					// password_verify() returns boolean value
					if ($pass_check == false){
						header("Location: ../index.php?error=wrong_password");
						exit();

					}
					elseif ($pass_check == true) {
						session_start();
						$_SESSION['username'] = $row['username'];
						$_session['email'] = $row['email'];
						header("Location: ../user_page.php");
						exit();
					}
					else{
						header("Location: ../index.php?error=wrong_password");
						exit();
					}
				}

			}
		}
	}
	else{
		header("location: ../index.php?error=idontknow");
		exit();
	}