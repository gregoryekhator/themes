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

$page = new admin_settingpage('theme_university_colours', get_string('colours_settings', 'theme_university'));
$page->add(new admin_setting_heading('theme_university_colours', get_string('colours_headingsub', 'theme_university'), format_text(get_string('colours_desc' , 'theme_university'), FORMAT_MARKDOWN)));



    // Variable $brandprimary.
    $name = 'theme_university/brandcolor';
    $title = get_string('brandcolor', 'theme_university');
    $description = get_string('brandcolor_desc', 'theme_university');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // @bodyBackground setting.
    $name = 'theme_university/bodybackground';
    $title = get_string('bodybackground', 'theme_university');
    $description = get_string('bodybackground_desc', 'theme_university');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Top navbar background setting.
    $name = 'theme_university/topnavbarbg';
    $title = get_string('topnavbarbg', 'theme_university');
    $description = get_string('topnavbarbg_desc', 'theme_university');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer drawer background
    $name = 'theme_university/footerbkg';
    $title = get_string('footerbkg', 'theme_university');
    $description = get_string('footerbkg_desc', 'theme_university');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


// Must add the page after definiting all the settings!
$settings->add($page);
