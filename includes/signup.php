<?php
	if(isset($_POST['signup-submit'])){
		require 'dbh.php';           // database connection

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// error-handlers

		if (empty($username) || empty($email) || empty($password)) {
			header("location: ../imdex.php?error=emptyfield&username=".$username." &email=.".$email); // sends http header to the btowser and also sends a 302 redirect status code to the location we specified
			exit(); // the code exits, code below doesnot run.
		}

		/*elseif (!preg_match("/^[a-zA_Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("location: ../index.php?error=invalidusernameandemail");
			exit(); // the code exits, code below doesnot run.
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // checks if the valid email type
			header("location: ../index.php?error=invalidemail&username=".$username);
			exit(); // the code exits, code below doesnot run.
		} */

		elseif (!preg_match("/^[a-zA_Z0-9]*$/", $username)) {
			header("location: ../index.php?error=invalidusername&email=.".$email);
			exit(); // the code exits, code below doesnot run.
		}

		else{
			$query = "SELECT username FROM users where username = ?";  // ? is the place holder for the username the user supplies
			$prep_statement = mysqli_stmt_init($conn);  // database connection to make a prepared statemnt
			if (!mysqli_stmt_prepare($prep_statement, $query)){ //the query is parsed by the database server as a temlplate and stors it without executing for later use
				header("location: ../index.php?error=sqlerror");
			 	exit();
			}
			else{
				mysqli_stmt_bind_param($prep_statement, "s", $username); // the "s" specifies that the $username must be a string and the value is placed where the placeholder is
				mysqli_stmt_execute($prep_statement); // after bindind we execute the prep_statement
				mysqli_stmt_store_result($prep_statement); // as the anme suggests; results is stored in the prep_statement object
				$resultcheck = mysqli_stmt_num_rows($prep_statement);
				if ($resultcheck > 0) {
					header("location: ../index.php?error=usertaken&email=.".$email);
					exit();
				}

			// saving user credentials into the database
			else{
				$query = "INSERT INTO users (email, username, password) VALUES (?,?,?)";
				$prep_statement = mysqli_stmt_init($conn);
			}
			if (!mysqli_stmt_prepare($prep_statement, $query)){
				header("location: ../index.php?error=sqlerror");
			 	exit();
			}
			else{
				$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($prep_statement, "sss", $email, $username, $hashed_pwd);  
				mysqli_stmt_execute($prep_statement);
				header("location: ../index.php?signup=success");  
				}


				
		}
		

		}
		mysqli_stmt_close($prep_statement);
		mysqli_close($conn);
	}
	else{
		header("location: ../index.php");
		exit();
	}
?>