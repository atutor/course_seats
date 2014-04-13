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
admin_authenticate(AT_ADMIN_PRIV_COURSE_SEATS);


if(isset($_POST['seats_config'])){
		header("Location:".$_base_href."mods/course_seats/seats_config.php");
		exit;
}
if(isset($_POST['course_id'])){
    $course_id = intval($_POST['course_id']);

    $sql = "SELECT title from %scourses WHERE course_id = %d";
    $course_title = queryDB($sql, array(TABLE_PREFIX, $course_id), TRUE);
    
    if(isset($_POST['seats'])){
        if(preg_match('/^[0-9]{1,}$/', $_POST['seats'])){
            $seats = intval($_POST['seats']);
        }else if( $_POST['seats'] == ''){
            $msg->addError(array('JUST_NUMBERS', $course_title['title']));
        }else{
            $msg->addError(array('JUST_NUMBERS', $course_title['title']));
        }
    }
    if(!$_POST['course_id']){
            $msg->addError('NO_COURSE_SELECTED');
            header("Location:".$_base_href."mods/course_seats/index_admin.php");
            exit;
    }
}
    if(isset($seats) && $seats != 0){
    
        $sql = "REPLACE into %scourse_seats (`course_id`, `seats`) VALUES (%d, %d)";
        $result = queryDB($sql, array(TABLE_PREFIX, $course_id, $seats));
        
        if($result > 0){
            $msg->addFeedback(array('SEATS_UPDATED', $course_title['title']));
        }
    }

    if(isset($_POST['remove'])){

        $sql = "DELETE from %scourse_seats WHERE course_id=%d";
        $result = queryDB($sql, array(TABLE_PREFIX, $course_id));
        
        if($result > 0){
            $msg->addFeedback(array('SEATS_REMOVED', $course_title['title']));
        } else {
            $msg->addError('NO_ACTION_SELECTED');
        }
    }
	
require (AT_INCLUDE_PATH.'header.inc.php');

?>
<div class="input-form">

	<fieldset class="group_form">
	<legend class="group_form"><?php echo _AT('seats_course_seats'); ?></legend>
	<p><?php echo _AT('seats_howto'); ?></p><p><br /></p>
	<p>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
			<label for="course_name"><?php echo _AT('course'); ?></label>
			<select name="course_id" id="course_name">
			<?php

				$sql = "SELECT title, course_id from %scourses ORDER BY title ASC";
				$rows_courses = queryDB($sql, array(TABLE_PREFIX));

				foreach($rows_courses as $row){
					echo '<option value="'.$row['course_id'].'">'.$row['title'].'</option>'."\n";
				}
			?>
			</select>
			<label for="max_enroll"><?php echo _AT('seats_max_enrolment'); ?></label>
			<input type="text" size="4" maxlength="4" value="" name="seats" id="max_enroll"/>
			<input type="submit" value="<?php echo _AT('add'); ?>" name="add" class="button"><br /><br /> <?php echo _AT('or'); ?>
			<input type="submit" value="<?php echo _AT('seats_config_options'); ?>" name="seats_config" class="button">
		</form>
	</p>

	</fieldset>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
	<table class="data" rules="cols">
		<thead>
			<tr>
				<th></th>
				<th scope="col"><?php echo _AT('title'); ?></th>
				<th scope="col"><?php echo _AT('seats_limit'); ?></th>
			</tr>
		</thead>
	<?php

	$sql = "SELECT C.course_id, C.title, S.seats FROM %scourses as C, %scourse_seats as S WHERE C.course_id = S.course_id";
	$rows_course_seats = queryDB($sql, array(TABLE_PREFIX, TABLE_PREFIX));
	    if(count($rows_course_seats) > 0){
		    foreach($rows_course_seats as $row){
				$rowid++;
				echo '<tr>
						<td><input type="radio" name="course_id" value="'.$row['course_id'].'" id="seats'.$rowid.'"/></td>
						<td><label for="seats'.$rowid.'">'.$row['title'].'<label></td>
						<td>'.$row['seats'].'</td>
					</tr>';
			}
		}else{
			echo '<tr>
						<td colspan="3">'._AT('none_found').'</td>
				  </tr>';
		}
		?>
		<tfoot>
			<tr>
				<td colspan="8">
					<input type="submit" value="<?php echo _AT('remove'); ?>" name="remove">
				</td>
			</tr>
		</tfoot>
	</table>
</form>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>