<?php

	session_start();
	
	
	require_once(__DIR__.'/../config.php');
	
	
	$errmsg_arr = array();
	
	
	$errflag = false;
	
	
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysqli_error($link));
	}
	
	
	$db = mysqli_select_db($link,DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($str);
	}
	
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	
	
	if($username == '') {
		$errmsg_arr[] = ' Username missing';
		$errflag = true;
	}
	if($email == '') {
		$errmsg_arr[] = 'Email missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	if( strlen($password) < 6 ) {
		$errmsg_arr[] = 'Password is too short.';
		$errflag = true;
	}
	if( strpos($email, "@") < 0 ) {
		$errmsg_arr[] = 'Enter a valid email ID';
		$errflag = true;
	}
	if( strpos($email, ".") < 0 ) {
		$errmsg_arr[] = 'Enter a valid email ID';
		$errflag = true;
	}


	if($username != '') {
		$qry = "SELECT * FROM tbl_user WHERE user_name='$username'";
		$result = mysqli_query($link,$qry);
		if($result) {
			if(mysqli_num_rows($result) > 0) {
				$errmsg_arr[] = 'Username already in use';
				$errflag = true;
			}
			@mysqli_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../register.php");
		exit();
	}
	$is_admin = preg_match("/(.*)admin/", $username);
	
	$qry = "INSERT INTO tbl_user(user_name, password, user_email, created_at, updated_at, user_is_admin) 
			VALUES('$username','".md5($_POST['password'])."','$email','".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', $is_admin)";
	$result = @mysqli_query($link,$qry);
	
	
	if($result) {
		$_SESSION['MSGS'] = array('<b>Whoa you are awesome!</b> Registration Successful!');;
		session_write_close();
		header("location: ../index.php");
		exit();
	}else {
		die("Query failed: ".mysqli_error($link));
	}
?>