<?php
/*******
 * doesn't allow this file to be loaded with a browser.
 */
if (!defined('AT_INCLUDE_PATH')) { exit; }

/******
 * this file must only be included within a Module obj
 */
if (!isset($this) || (isset($this) && (strtolower(get_class($this)) != 'module'))) { exit(__FILE__ . ' is not a Module'); }

/*******
 * assign the instructor and admin privileges to the constants.
 */
define('AT_PRIV_COURSE_SEATS',       $this->getPrivilege());
define('AT_ADMIN_PRIV_COURSE_SEATS', $this->getAdminPrivilege());


/*******
 * add the admin pages when needed.
 */
if (admin_authenticate(AT_ADMIN_PRIV_COURSE_SEATS, TRUE) || admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
	global $_config;
	// replace the create course tab for admin, removed by "disable_create" config setting
	// remove the following lines if installed on atsp
	if($_config['disable_create'] == "1"){
	
	$sql = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name ='_core/services' && status ='2'";
	$result = mysql_query($sql, $db);
	if(mysql_num_rows($result) != 0 ){
	    //This is a Service site 
		$service_site = 1;
	}
	}
	if($service_site){
		//$this->_pages['mods/_core/services/admin/create_course.php']['title_var'] = '';
		//$this->_pages['mods/_core/services/admin/create_course.php']['parent']    = 'mods/_core/courses/admin/courses.php';
		//$this->_pages['mods/_core/services/admin/create_course.php']['guide']     = 'admin/?p=creating_courses.php';	
		//$this->_pages['mods/_core/courses/admin/courses.php']['children']  = array('mods/_core/services/admin/create_course.php');
		$this->_pages['mods/_core/courses/admin/create_course.php']['title_var'] = '';
	} else{
		$this->_pages['mods/_core/courses/admin/create_course.php']['title_var'] = 'create_course';
		$this->_pages['mods/_core/courses/admin/create_course.php']['parent']    = 'mods/_core/courses/admin/courses.php';
		$this->_pages['mods/_core/courses/admin/create_course.php']['guide']     = 'admin/?p=creating_courses.php';	
	//	$this->_pages['mods/_core/courses/admin/courses.php']['children']  = array('mods/_core/services/admin/create_course.php');
	} 
	

	//If Payments is installed, add tab to payment manager
	if($_config['ec_uri']){
		$this->_pages['mods/payments/payments_admin.php']['children'] = array_merge(array('mods/course_seats/index_admin.php'), isset($this->_pages['mods/payments/payments_admin.php']['children']) ? $this->_pages['mods/payments/payments_admin.php']['children'] : array());;
	}
	$this->_pages['mods/_core/courses/admin/courses.php']['children']  = array_merge(array('mods/course_seats/index_admin.php'), isset($this->_pages['mods/_core/courses/admin/courses.php']['children']) ? $this->_pages['mods/_core/courses/admin/courses.php']['children'] : array());
	$this->_pages['mods/course_seats/index_admin.php']['title_var'] = 'seats_course_seats';
	//$this->_pages['mods/course_seats/index_admin.php']['parent']    = 'mods/_core/courses/admin/courses.php';
	
	$this->_pages['mods/course_seats/seats_config.php']['title_var'] = 'seats_config';
	$this->_pages['mods/course_seats/seats_config.php']['parent']    = 'mods/course_seats/index_admin.php';

}

$this->_pages['mods/course_seats/disabled.php']['title_var'] = 'enrolment';
$this->_pages['mods/course_seats/disabled.php']['parent']    = 'mods/_core/enrolment/index.php';


/*******
* instructor Manage section added if course seats is set for a course:
*/
global $db, $_config;
$sql = "SELECT * FROM ".TABLE_PREFIX."course_seats WHERE course_id = '$_SESSION[course_id]'";
$result = @mysql_query($sql,$db);
$row = @mysql_fetch_assoc($result);

if($row['seats'] >= "1" && isset($_config['seats_allow']) && $_config['seats_allow'] != 0){
	$this->_pages['mods/course_seats/index_instructor.php']['title_var'] = 'course_seats';
	$this->_pages['mods/course_seats/index_instructor.php']['parent'] = 'mods/_core/enrolment/index.php';
	$this->_pages['mods/_core/enrolment/index.php']['children']  = array_merge(array('mods/course_seats/index_instructor.php'), isset($this->_pages['mods/_core/enrolment/index.php']['children']) ? $this->_pages['mods/_core/enrolment/index.php']['children'] : array());
}

// If a new course is being created and default seat limit is set
// Set the max seats for that course to the default_seats value
if($_config['default_seats'] && $_SESSION['course_id'] > 0){
	$sql = "SELECT seats from ".TABLE_PREFIX."course_seats WHERE course_id ='$_SESSION[course_id]'";
	$result = mysql_query($sql, $db);
	if(mysql_num_rows($result) == 0){
		$sql = "INSERT into ".TABLE_PREFIX."course_seats (`course_id`,`seats`) VALUES('$_SESSION[course_id]','$_config[default_seats]')";
		$result = mysql_query($sql,$db);
	}
}

require(AT_INCLUDE_PATH.'../mods/course_seats/course_seats.php');
?>