<?php
/*******
 * this function named [module_name]_delete is called whenever a course content is deleted
 * which includes when restoring a backup with override set, or when deleting an entire course.
 * the function must delete all module-specific material associated with this course.
 * $course is the ID of the course to delete.
 */

function course_seats_delete($course) {
	global $db;
	$sql = "DELETE FROM %scourse_seats WHERE course_id=%d";
	queryDB($sql, array(TABLE_PREFIX, $course));
}

?>