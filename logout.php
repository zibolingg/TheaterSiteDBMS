<?php   	 
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: loginsignup.php");
		exit;
	}
	unset($_SESSION['user_id']);
	if(isset($_SESSION['screening_id'])){
		unset($_SESSION['screening_id']);
	}
	if(isset($_SESSION['reservation_id'])){
		unset($_SESSION['reservation_id']);
	}
	if(isset($_SESSION['screening_id'])){
		unset($_SESSION['screening_id']);
	}
	if(isset($_SESSION['email'])){
		unset($_SESSION['email']);
	}
	if(isset($_SESSION['username'])){
		unset($_SESSION['username']);
	}
	if(isset($_SESSION['flag'])){
		unset($_SESSION['flag']);
	}

	if(isset($_SESSION['membership'])){
		unset($_SESSION['membership']);
	}

	session_unset();
	session_destroy();
	header("Location: index_entry.php"); 
	exit;
?>