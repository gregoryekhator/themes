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
* Social networking settings page file.
*
* @package    theme_university
* @copyright  2016 Chris Kenniburg
* @credits    theme_boost - MoodleHQ
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

/* Social Network Settings */
$page = new admin_settingpage('theme_university_footer', get_string('footerheading', 'theme_university'));
$page->add(new admin_setting_heading('theme_university_footer', get_string('footerheadingsub', 'theme_university'), format_text(get_string('footerdesc' , 'theme_university'), FORMAT_MARKDOWN)));

// footer branding
$name = 'theme_university/brandorganization';
$title = get_string('brandorganization', 'theme_university');
$description = get_string('brandorganizationdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// footer branding
$name = 'theme_university/brandwebsite';
$title = get_string('brandwebsite', 'theme_university');
$description = get_string('brandwebsitedesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// footer branding
$name = 'theme_university/brandphone';
$title = get_string('brandphone', 'theme_university');
$description = get_string('brandphonedesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// footer branding
$name = 'theme_university/brandemail';
$title = get_string('brandemail', 'theme_university');
$description = get_string('brandemaildesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Footnote setting.
$name = 'theme_university/footnote';
$title = get_string('footnote', 'theme_university');
$description = get_string('footnotedesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);


// This is the descriptor for socialicons
$name = 'theme_university/socialiconsinfo';
$heading = get_string('footerheadingsocial', 'theme_university');
$information = get_string('footerdesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Website url setting.
$name = 'theme_university/website';
$title = get_string('website', 'theme_university');
$description = get_string('websitedesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Blog url setting.
$name = 'theme_university/blog';
$title = get_string('blog', 'theme_university');
$description = get_string('blogdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Facebook url setting.
$name = 'theme_university/facebook';
$title = get_string(        'facebook', 'theme_university');
$description = get_string(      'facebookdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Flickr url setting.
$name = 'theme_university/flickr';
$title = get_string('flickr', 'theme_university');
$description = get_string('flickrdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Twitter url setting.
$name = 'theme_university/twitter';
$title = get_string('twitter', 'theme_university');
$description = get_string('twitterdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Google+ url setting.
$name = 'theme_university/googleplus';
$title = get_string('googleplus', 'theme_university');
$description = get_string('googleplusdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// LinkedIn url setting.
$name = 'theme_university/linkedin';
$title = get_string('linkedin', 'theme_university');
$description = get_string('linkedindesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Tumblr url setting.
$name = 'theme_university/tumblr';
$title = get_string('tumblr', 'theme_university');
$description = get_string('tumblrdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Pinterest url setting.
$name = 'theme_university/pinterest';
$title = get_string('pinterest', 'theme_university');
$description = get_string('pinterestdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Instagram url setting.
$name = 'theme_university/instagram';
$title = get_string('instagram', 'theme_university');
$description = get_string('instagramdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// YouTube url setting.
$name = 'theme_university/youtube';
$title = get_string('youtube', 'theme_university');
$description = get_string('youtubedesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Vimeo url setting.
$name = 'theme_university/vimeo';
$title = get_string('vimeo', 'theme_university');
$description = get_string('vimeodesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Skype url setting.
$name = 'theme_university/skype';
$title = get_string('skype', 'theme_university');
$description = get_string('skypedesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// General social url setting 1.
$name = 'theme_university/social1';
$title = get_string('sociallink', 'theme_university');
$description = get_string('sociallinkdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Social icon setting 1.
$name = 'theme_university/socialicon1';
$title = get_string('sociallinkicon', 'theme_university');
$description = get_string('sociallinkicondesc', 'theme_university');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// General social url setting 2.
$name = 'theme_university/social2';
$title = get_string('sociallink', 'theme_university');
$description = get_string('sociallinkdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Social icon setting 2.
$name = 'theme_university/socialicon2';
$title = get_string('sociallinkicon', 'theme_university');
$description = get_string('sociallinkicondesc', 'theme_university');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// General social url setting 3.
$name = 'theme_university/social3';
$title = get_string('sociallink', 'theme_university');
$description = get_string('sociallinkdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Social icon setting 3.
$name = 'theme_university/socialicon3';
$title = get_string('sociallinkicon', 'theme_university');
$description = get_string('sociallinkicondesc', 'theme_university');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
