<?php
	include 'header.php';
	if (isset($_SESSION['username'])) {
		echo "Hello ".$_SESSION['username']."!";
	}
	else{
		#echo "How the fuck did you get in here dude?";
		header("Location: index.php?error=you_are_illegal");
	}
	
	