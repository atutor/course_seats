# sql file for course seats module

CREATE TABLE `course_seats` (
  `course_id` mediumint(8) unsigned NOT NULL,
  `seats` mediumint(4) unsigned NOT NULL,
  UNIQUE KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Disable Create courses when course limits mod is installed
INSERT INTO `config` VALUES ('disable_create','1');

# module UI language
INSERT INTO `language_text` VALUES ('en', '_module','course_seats','Course Seats',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_course_seats','Course Seats',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_howto','Select a course and enter a number to add or modify the maximum number of students who can enroll in that course.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_max_enrolment','Maximum Enrolment',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_limit','Seat Limit',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_howto_instructor','Enter the number of seats you would like to add to this course.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_used_remaining','This course has used %s of %s available seats.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_add_enrolment','Seats to add:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_howto_config','If the Payments module is installed and enabled, you may allow instructors to purchase more seats for a course and automatically add them when payment is received. Check the box below and enter an amount for each seat. Or, leave unset to have the ATutor administrator manage the addition of course seats.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_allow','Allow instructors to purchase more seats: ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_price','Price for each new seat: ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_config','Configure Course Seats',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_config_options','Configure Course Seat Options ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_howto_config_create','By default "Create Course" is disabled for instructors when the "Course Seats" module is installed. You may enable course creation for instructors and set the default number of seats available in a newly created course. Uncheck "Disable Create Course" then set the "Default number of seats for new courses." ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_disable_create','Disable Create Course ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_default_seats','Default number of seats for new courses ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_payments_install','Course Seats configuration options are set here when the Payments module is installed, setting options to allow instructors to purchase additional seats for a course, and setting the default number of seats when new courses are created.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','seats_howto_config_create','By default "Create Course" is disabled for instructors when the "Course Seats" module is installed. You may enable course creation for instructors and set the default number of seats available in a newly created course. Uncheck "Disable Create Course" then set the "Default number of seats for new courses."
',NOW(),'');

# module feedback
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_ENROLL_LIMIT','Enrollment limit for this course has been reached. Contact the site administrator to have that limit increased.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_IMPORT_DISABLED','Import course list is disabled. Seat limit reached.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_CREATE_LIST_DISABLED','Create course list is disabled. Seat limit reached.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_TAB_DISABLED','The Tab you have selected is disabled.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_ENROLL_TOO_MANY','Too many being enrolled. You have %s seats available.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SEATS_UPDATED','Course seat limit updated for <strong>%s</strong>.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SEATS_REMOVED','Course seat limit removed for <strong>%s</strong>.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_JUST_NUMBERS','Maximum enrolment must be a number. Try again.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SEATS_AVAILABLE','Seats available for this course (<strong>%s</strong>).',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_SEATS_MUST_ENABLE_ALLOW','You must check <strong>Allow instructors to purchase more seats</strong>',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_SEATS_MUST_BE_NUMBER','You must specify the number of seats.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_NO_COURSE_SELECTED','No course was selected.',NOW(),'');


