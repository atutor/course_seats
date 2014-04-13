<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2002 - 2013                                            */
/* ATutorSpaces                                                         */
/* https://atutorspaces.com                                             */
/* This program is free software. You can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation.                        */
/************************************************************************/

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_COURSE_SEATS);
require (AT_INCLUDE_PATH.'header.inc.php');
?>

<div class="input-form">
	<fieldset class="group_form">
	<legend class="group_form"><?php echo _AT('seats_course_seats'); ?></legend>
	<?php

	$sql = "SELECT * from %scourse_seats WHERE course_id=%d";
	$row = queryDB($sql, array(TABLE_PREFIX, $_SESSION['course_id']), TRUE);
	$seats_available = $row['seats'];
	
	$sql = "SELECT member_id, COUNT(member_id) FROM %scourse_enrollment WHERE course_id = %d GROUP BY member_id";
	$row = queryDB($sql, array(TABLE_PREFIX, $_SESSION['course_id']), TRUE);

	if(count($row['COUNT(member_id)']) > 0){
	    $seats_used = ($row['COUNT(member_id)']-1);
	} else {
	    $seats_used = "0";
	}

	?>
	<p><?php echo _AT(array('seats_used_remaining',$seats_used, $seats_available)); ?>
	<p><?php echo _AT('seats_howto_instructor'); ?></p><p><br /></p>
	
	<form action="<?php echo $_base_href; ?>mods/payments/payment.php" method="post" name="form">
		<input type="hidden"  value="<?php echo $_SESSION['course_id']; ?>" name="course_id"/>
		<label for="seats"><?php echo _AT('seats_add_enrolment'); ?></label>
		<input type="text" size="4" maxlength="4" value="" name="seats_requested" id="seats"/>
		<input type="submit" value="<?php echo _AT('add'); ?>" name="add" class="button">
	</form>
	</fieldset>
</div>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>