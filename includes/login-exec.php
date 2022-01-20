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
	$password = $_POST['password'];
	
	
	if($username == '') {
		$errmsg_arr[] = 'Please provide a username.';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Please enter the password.';
		$errflag = true;
	}
	
	
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../login.php");
		exit();
	}
	
	
	$qry="SELECT * FROM tbl_user WHERE user_name='$username' AND password='".md5($_POST['password'])."'";
	$result=mysqli_query($link,$qry);


	if($result) {
		if(mysqli_num_rows($result) == 1) {
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_USER_ID'] = $member['user_id'];
			$_SESSION['SESS_USERNAME'] = $member['user_name'];
			$_SESSION['SESS_IS_ADMIN'] = $member['user_is_admin'];
			session_write_close();
			header("location: ../index.php");
			exit();
		}else {
			$_SESSION['ERRMSG_ARR'] = array('<b>Oh no!</b> Incorrect username or password. Please try again.');
			session_write_close();
			header("location: ../login.php");
			exit();
		}
	}else {
		die("Query failed: ".mysqli_error($link));
	}
?>