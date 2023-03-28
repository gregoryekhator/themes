<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Heading and course images settings page file.
 *
 * @package    theme_university
 * @Copyright   2022 Debonair Training <http://debonairtraining.com>
 * @credits  2016 Chris Kenniburg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_university_menusettings', get_string('menusettings', 'theme_university'));

// This is the descriptor for Course Management Panel
$name = 'theme_university/coursemanagementinfo';
$heading = get_string('coursemanagementinfo', 'theme_university');
$information = get_string('coursemanagementinfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Show/hide coursemanagement slider toggle.
$name = 'theme_university/coursemanagementtoggle';
$title = get_string('coursemanagementtoggle', 'theme_university');
$description = get_string('coursemanagementtoggle_desc', 'theme_university');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Dashboard Teacher Textbox.
$name = 'theme_university/coursemanagementtextbox';
$title = get_string('coursemanagementtextbox', 'theme_university');
$description = get_string('coursemanagementtextbox_desc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Dashboard Student Textbox.
$name = 'theme_university/studentdashboardtextbox';
$title = get_string('studentdashboardtextbox', 'theme_university');
$description = get_string('studentdashboardtextbox_desc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Navbar Color switch toggle based on role
$name = 'theme_university/navbarcolorswitch';
$title = get_string('navbarcolorswitch','theme_university');
$description = get_string('navbarcolorswitch_desc', 'theme_university');
$default = '2';
$choices = array(
	'1' => get_string('navbarcolorswitch_on', 'theme_university'),
	'2' => get_string('navbarcolorswitch_off', 'theme_university'),
	);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide course editing cog.
$name = 'theme_university/showactivitynav';
$title = get_string('showactivitynav', 'theme_university');
$description = get_string('showactivitynav_desc', 'theme_university');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide course editing cog.
$name = 'theme_university/courseeditingcog';
$title = get_string('courseeditingcog', 'theme_university');
$description = get_string('courseeditingcog_desc', 'theme_university');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide student grades.
$name = 'theme_university/showstudentgrades';
$title = get_string('showstudentgrades', 'theme_university');
$description = get_string('showstudentgrades_desc', 'theme_university');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide student completion.
$name = 'theme_university/showstudentcompletion';
$title = get_string('showstudentcompletion', 'theme_university');
$description = get_string('showstudentcompletion_desc', 'theme_university');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Toggle show only your Group teachers in student course management panel.
$name = 'theme_university/showonlygroupteachers';
$title = get_string('showonlygroupteachers', 'theme_university');
$description = get_string('showonlygroupteachers_desc', 'theme_university');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide course settings for students.
$name = 'theme_university/showcourseadminstudents';
$title = get_string('showcourseadminstudents', 'theme_university');
$description = get_string('showcourseadminstudents_desc', 'theme_university');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for course menu
$name = 'theme_university/mycoursesmenuinfo';
$heading = get_string('mycoursesinfo', 'theme_university');
$information = get_string('mycoursesinfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Toggle courses display in custommenu.
$name = 'theme_university/displaymycourses';
$title = get_string('displaymycourses', 'theme_university');
$description = get_string('displaymycoursesdesc', 'theme_university');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Toggle courses display in custommenu.
$name = 'theme_university/displaythiscourse';
$title = get_string('displaythiscourse', 'theme_university');
$description = get_string('displaythiscoursedesc', 'theme_university');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Set terminology for dropdown course list
$name = 'theme_university/mycoursetitle';
$title = get_string('mycoursetitle','theme_university');
$description = get_string('mycoursetitledesc', 'theme_university');
$default = 'course';
$choices = array(
	'course' => get_string('mycourses', 'theme_university'),
	'module' => get_string('mymodules', 'theme_university'),
	'unit' => get_string('myunits', 'theme_university'),
	'class' => get_string('myclasses', 'theme_university'),
	'training' => get_string('mytraining', 'theme_university'),
	'pd' => get_string('myprofessionaldevelopment', 'theme_university'),
	'cred' => get_string('mycred', 'theme_university'),
	'plan' => get_string('myplans', 'theme_university'),
	'comp' => get_string('mycomp', 'theme_university'),
	'program' => get_string('myprograms', 'theme_university'),
	'lecture' => get_string('mylectures', 'theme_university'),
	'lesson' => get_string('mylessons', 'theme_university'),
	);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//Drawer Menu
// This is the descriptor for nav drawer
$name = 'theme_university/drawermenuinfo';
$heading = get_string('setting_navdrawersettings', 'theme_university');
$information = get_string('setting_navdrawersettings_desc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_university/shownavdrawer';
$title = get_string('shownavdrawer', 'theme_university');
$description = get_string('shownavdrawer_desc', 'theme_university');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_university/shownavclosed';
$title = get_string('shownavclosed', 'theme_university');
$description = get_string('shownavclosed_desc', 'theme_university');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);



// Must add the page after definiting all the settings!
$settings->add($page);
