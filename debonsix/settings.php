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
 * @package   theme_debonsix
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingdebonsix', get_string('configtitle', 'theme_debonsix'));

    // Each page is a tab - the first is the "General" tab.
    $page = new admin_settingpage('theme_debonsix_general', get_string('generalsettings', 'theme_debonsix'));

    // Replicate the preset setting from boost.
    $name = 'theme_debonsix/preset';
    $title = get_string('preset', 'theme_debonsix');
    $description = get_string('preset_desc', 'theme_debonsix');
    $default = 'default.scss';

    // We list files in our own file area to add to the drop down. We will provide our own function to
    // load all the presets from the correct paths.
    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_debonsix', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets from Boost.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_debonsix/presetfiles';
    $title = get_string('presetfiles','theme_debonsix');
    $description = get_string('presetfiles_desc', 'theme_debonsix');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_debonsix/brandcolor';
    $title = get_string('brandcolor', 'theme_debonsix');
    $description = get_string('brandcolor_desc', 'theme_debonsix');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($page);

    // Each page is a tab - the second is the "Backgrounds" tab.
    $page = new admin_settingpage('theme_debonsix_backgrounds', get_string('backgrounds', 'theme_debonsix'));

    // Default background setting.
    // We use variables for readability.
    $name = 'theme_debonsix/defaultbackgroundimage';
    $title = get_string('defaultbackgroundimage', 'theme_debonsix');
    $description = get_string('defaultbackgroundimage_desc', 'theme_debonsix');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'defaultbackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_debonsix_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Login page background setting.
    // We use variables for readability.
    $name = 'theme_debonsix/loginbackgroundimage';
    $title = get_string('loginbackgroundimage', 'theme_debonsix');
    $description = get_string('loginbackgroundimage_desc', 'theme_debonsix');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_debonsix_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Frontpage page background setting.
    // We use variables for readability.
    $name = 'theme_debonsix/frontpagebackgroundimage';
    $title = get_string('frontpagebackgroundimage', 'theme_debonsix');
    $description = get_string('frontpagebackgroundimage_desc', 'theme_debonsix');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpagebackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_debonsix_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Dashboard page background setting.
    // We use variables for readability.
    $name = 'theme_debonsix/dashboardbackgroundimage';
    $title = get_string('dashboardbackgroundimage', 'theme_debonsix');
    $description = get_string('dashboardbackgroundimage_desc', 'theme_debonsix');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'dashboardbackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_debonsix_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // In course page background setting.
    // We use variables for readability.
    $name = 'theme_debonsix/incoursebackgroundimage';
    $title = get_string('incoursebackgroundimage', 'theme_debonsix');
    $description = get_string('incoursebackgroundimage_desc', 'theme_debonsix');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'incoursebackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_debonsix_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($page);

    //Slide show settings
    /* Slideshow Settings Start */
    $temp = new admin_settingpage('theme_debonsix_slideshow', get_string('slideshowheading', 'theme_debonsix'));
    $temp->add(new admin_setting_heading('theme_debonsix_slideshow', get_string('slideshowheadingsub', 'theme_debonsix'),
        format_text(get_string('slideshowdesc', 'theme_debonsix'), FORMAT_MARKDOWN)));

    // Display Slideshow.
    $name = 'theme_debonsix/toggleslideshow';
    $title = get_string('toggleslideshow', 'theme_debonsix');
    $description = get_string('toggleslideshowdesc', 'theme_debonsix');
    $yes = get_string('yes');
    $no = get_string('no');
    $default = 1;
    $choices = array(1 => $yes , 0 => $no);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    // Number of slides.
    $name = 'theme_debonsix/numberofslides';
    $title = get_string('numberofslides', 'theme_debonsix');
    $description = get_string('numberofslides_desc', 'theme_debonsix');
    $default = 3;
    $choices = array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
    );
    $temp->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    $numberofslides = get_config('theme_debonsix', 'numberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {

        // This is the descriptor for Slide One.
        $name = 'theme_debonsix/slide' . $i . 'info';
        $heading = get_string('slideno', 'theme_debonsix', array('slide' => $i));
        $information = get_string('slidenodesc', 'theme_debonsix', array('slide' => $i));
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);

        // Slide Image.
        $name = 'theme_debonsix/slide' . $i . 'image';
        $title = get_string('slideimage', 'theme_debonsix');
        $description = get_string('slideimagedesc', 'theme_debonsix');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide' . $i . 'image');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Caption.
        $name = 'theme_debonsix/slide' . $i . 'caption';
        $title = get_string('slidecaption', 'theme_debonsix');
        $description = get_string('slidecaptiondesc', 'theme_debonsix');
        $default = get_string('slidecaptiondefault', 'theme_debonsix', array('slideno' => sprintf('%02d', $i) ));
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
        $temp->add($setting);

        // Slider button.
        $name = 'theme_debonsix/slide' . $i . 'urltext';
        $title = get_string('slidebutton', 'theme_debonsix');
        $description = get_string('slidebuttondesc', 'theme_debonsix');
        $default = 'lang:knowmore';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
        $temp->add($setting);

        // Slide Description Text.
        $name = 'theme_debonsix/slide' . $i . 'url';
        $title = get_string('slideurl', 'theme_debonsix');
        $description = get_string('slideurldesc', 'theme_debonsix');
        $default = 'http://www.example.com/';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
        $temp->add($setting);

    }

    /* Slideshow Settings End*/

    $settings->add($temp);
    
    // Advanced settings.
    $page = new admin_settingpage('theme_debonsix_advanced', get_string('advancedsettings', 'theme_debonsix'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_configtextarea('theme_debonsix/scsspre',
        get_string('rawscsspre', 'theme_debonsix'), get_string('rawscsspre_desc', 'theme_debonsix'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_configtextarea('theme_debonsix/scss', get_string('rawscss', 'theme_debonsix'),
        get_string('rawscss_desc', 'theme_debonsix'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
