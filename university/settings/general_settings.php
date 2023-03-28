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
 * Colours settings page file.
 *
 * @package    theme_university
 * @Copyright   2022 Debonair Training <http://debonairtraining.com>
 * @credits  2016 Chris Kenniburg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/* General Settings */

$temp = new admin_settingpage('theme_university_general', get_string('themegeneralsettings', 'theme_university'));

// Banner Image setting.
$name = 'theme_university/logo';
$title = get_string('logo', 'theme_university');
$description = get_string('logodesc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


// Custom CSS file.
$name = 'theme_university/customcss';
$title = get_string('customcss', 'theme_university');
$description = get_string('customcssdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtextarea($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);




// Promoted Courses Start.
// Promoted Courses Heading.
$name = 'theme_university_promotedcoursesheading';
$heading = get_string('promotedcoursesheading', 'theme_university');
$information = '';
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Enable / Disable Promoted Courses.
$name = 'theme_university/pcourseenable';
$title = get_string('pcourseenable', 'theme_university');
$description = '';
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Promoted courses Block title.
$name = 'theme_university/promotedtitle';
$title = get_string('pcourses', 'theme_university').' '.get_string('title', 'theme_university');
$description = get_string('promotedtitledesc', 'theme_university');
$default = 'lang:promotedtitledefault';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

$name = 'theme_university/promotedcourses';
$title = get_string('pcourses', 'theme_university');
$description = get_string('pcoursesdesc', 'theme_university');
$default = array();

$courses[0] = '';
$cnt = 0;
if ($ccc = get_courses('all', 'c.sortorder ASC', 'c.id,c.shortname,c.visible,c.category')) {
    foreach ($ccc as $cc) {
        if ($cc->visible == "0" || $cc->id == "1") {
            continue;
        }
        $cnt++;
        $courses[$cc->id] = $cc->shortname;
        // Set some courses for default option.
        if ($cnt < 8) {
            $default[] = $cc->id;
        }
    }
}
$coursedefault = implode(",", $default);
$setting = new admin_setting_configtextarea($name, $title, $description, $coursedefault);
$temp->add($setting);
$settings->add($temp);
// Promoted Courses End.
