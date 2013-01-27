<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2013                                                   */
/* ATutorSpaces Inc.                                                    */
/* https://atutorspaces.com												*/
/*																		*/
/* This program is free software. You can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation.                        */
/************************************************************************/
// $Id$
if (!defined('AT_INCLUDE_PATH')) { exit; }

if(isset($_SESSION['course_id']) && isset($_SESSION['is_admin'])){
	///////
	// Get current course seat limit
	$sql = "SELECT seats from ".TABLE_PREFIX."course_seats WHERE course_id ='$_SESSION[course_id]'";
	global $db, $msg, $_base_href ;
	$result = mysql_query($sql,$db);
	$seatlimit = mysql_fetch_assoc($result);

	///////
	// If a seat limit is set, then do something, otherwise ignore this module	
	if(isset($seatlimit) && $seatlimit > 0){
	
		//////
		// Disable "not enrolled" tab if seat limit is set
		if($_GET['tab'] =='4'){
			$msg->addFeedback('TAB_DISABLED');
			$disable_enroll = 1;
		}
		
		//////
		// Get current course number enrolled and calculate remaining seats
		$sql ="SELECT course_id from ".TABLE_PREFIX."course_enrollment WHERE course_id = '$_SESSION[course_id]'";
		$result = mysql_query($sql, $db);
		$enrollcount = mysql_num_rows($result);
		$enrollcount = ($enrollcount-1); // remove instructor form the enrollment count
		$row = mysql_fetch_array($result);
		$seats_remaining = ($seatlimit['seats']- $enrollcount);
	
	
	
		/////
		// If seat limit is on, display how many seats remain.
		if(preg_match('/enrolment\/index.php/',$_SERVER['PHP_SELF'])){
			if($seats_remaining > 0){
				$msg->addFeedback(array('SEATS_AVAILABLE', $seats_remaining));
			}
		}
		///////
		// Disable features and present messages
		if($enrollcount >= $seatlimit['seats']){
			if(preg_match('/enrolment\/index.php/',$_SERVER['PHP_SELF'])){
				$msg->addFeedback('ENROLL_LIMIT');
			}

			if(preg_match('/import_course_list.php/',$_SERVER['PHP_SELF'])){
				$msg->addFeedback('IMPORT_DISABLED');
				$disable_enroll = 1;

			}
			if(preg_match('/create_course_list.php/',$_SERVER['PHP_SELF'])){
				$msg->addFeedback('CREATE_LIST_DISABLED');
			$disable_enroll = 1;
			}

		}	
		
		///////
		// if uploading a course list check the number of lines
		// and test against seats remaining.
		if($_FILES['file']['size'] > 1 && preg_match('/verify_list.php/',$_SERVER['PHP_SELF'])){
			$lines = COUNT(FILE($_FILES['file']['tmp_name']));
			if($lines > $seats_remaining){
				$msg->addError(array('ENROLL_TOO_MANY', $seats_remaining));
				$disable_enroll = 1;
			}	
		}
		
		///////	
		// If creating course list check the number of usernames being
		// added and test against seats remaining
		if(isset($_POST) && preg_match('/verify_list.php/',$_SERVER['PHP_SELF'])){
			foreach($_POST as $key=>$value){
				if($value != ''){
				$new[$key] = $value;
				}
			}
			$_POST = $new;
			$serial_post = serialize($_POST);
			$new_post = unserialize($serial_post);
			$post_count = count($new_post);
			$post_count = (($post_count/3) -1);
		}
		if(isset($_POST['count']) && preg_match('/verify_list.php/',$_SERVER['PHP_SELF'])){
			$post_count = $_POST['count'];
		}

		if($post_count > $seats_remaining && preg_match('/verify_list.php/',$_SERVER['PHP_SELF'])){
				$msg->addError(array('ENROLL_TOO_MANY', $seats_remaining));
				$disable_enroll = 2;
		}
	
		///////
		// Redirect to appropriate page if upload/create course list fails
		if($disable_enroll == 1){
				header("Location: ".$_base_href."mods/course_seats/disabled.php");
				exit;
		} else if($disable_enroll == 2){
				$serial_post = serialize($_POST); 
				header("Location: ".$_base_href."mods/_core/enrolment/create_course_list.php?serial_post=".$serial_post);
				exit;
		}	
		
	}			
}
?>