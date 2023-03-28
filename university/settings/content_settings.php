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

$page = new admin_settingpage('theme_university_content', get_string('contentsettings', 'theme_university'));
// Content Info
$name = 'theme_university/textcontentinfo';
$heading = get_string('textcontentinfo', 'theme_university');
$information = get_string('textcontentinfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Frontpage Textbox.
$name = 'theme_university/fptextbox';
$title = get_string('fptextbox', 'theme_university');
$description = get_string('fptextbox_desc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Frontpage Textbox Logged Out.
$name = 'theme_university/fptextboxlogout';
$title = get_string('fptextboxlogout', 'theme_university');
$description = get_string('fptextboxlogout_desc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Alert setting.
$name = 'theme_university/alertbox';
$title = get_string('alert', 'theme_university');
$description = get_string('alert_desc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
