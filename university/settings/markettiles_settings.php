<?php

defined('MOODLE_INTERNAL') || die();

/* Marketing Spot Settings temp*/
$page = new admin_settingpage('theme_university_marketing', get_string('marketingheading', 'theme_university'));

// // Toggle FP Textbox Spots.
// $name = 'theme_university/togglemarketing';
// $title = get_string('togglemarketing' , 'theme_university');
// $description = get_string('togglemarketing_desc', 'theme_university');
// $displaytop = get_string('displaytop', 'theme_university');
// $displaybottom = get_string('displaybottom', 'theme_university');
// $default = '2';
// $choices = array('1'=>$displaytop, '2'=>$displaybottom);
// $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
// $setting->set_updatedcallback('theme_reset_all_caches');
// $page->add($setting);

// This is the descriptor for Marketing Spot One
$name = 'theme_university/marketing1info';
$heading = get_string('marketing1', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

//title
$name = 'theme_university/marketing1';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing1image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//content
$name = 'theme_university/marketing1content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//button
$name = 'theme_university/marketing1buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//button url
$name = 'theme_university/marketing1buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//button target
$name = 'theme_university/marketing1target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot Two
$name = 'theme_university/marketing2info';
$heading = get_string('marketing2', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// title
$name = 'theme_university/marketing2';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing2image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//content
$name = 'theme_university/marketing2content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//buttons
$name = 'theme_university/marketing2buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//button url
$name = 'theme_university/marketing2buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//button target
$name = 'theme_university/marketing2target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot Three
$name = 'theme_university/marketing3info';
$heading = get_string('marketing3', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// title
$name = 'theme_university/marketing3';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing3image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// content
$name = 'theme_university/marketing3content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button
$name = 'theme_university/marketing3buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button url
$name = 'theme_university/marketing3buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//button target
$name = 'theme_university/marketing3target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot Four
$name = 'theme_university/marketing4info';
$heading = get_string('marketing4', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// title
$name = 'theme_university/marketing4';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing4image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing4image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// content
$name = 'theme_university/marketing4content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button
$name = 'theme_university/marketing4buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button url
$name = 'theme_university/marketing4buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button target
$name = 'theme_university/marketing4target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot five
$name = 'theme_university/marketing5info';
$heading = get_string('marketing5', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// title
$name = 'theme_university/marketing5';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing5image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing5image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// content
$name = 'theme_university/marketing5content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button
$name = 'theme_university/marketing5buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button url
$name = 'theme_university/marketing5buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button target
$name = 'theme_university/marketing5target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot Six
$name = 'theme_university/marketing6info';
$heading = get_string('marketing6', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// title
$name = 'theme_university/marketing6';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing6image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing6image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// content
$name = 'theme_university/marketing6content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button
$name = 'theme_university/marketing6buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button url
$name = 'theme_university/marketing6buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button target
$name = 'theme_university/marketing6target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot Seven
$name = 'theme_university/marketing7info';
$heading = get_string('marketing7', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// title
$name = 'theme_university/marketing7';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing7image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing7image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// content
$name = 'theme_university/marketing7content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button
$name = 'theme_university/marketing7buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button url
$name = 'theme_university/marketing7buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button target
$name = 'theme_university/marketing7target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot Eight
$name = 'theme_university/marketing8info';
$heading = get_string('marketing8', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Title
$name = 'theme_university/marketing8';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing8image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing8image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// content
$name = 'theme_university/marketing8content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button
$name = 'theme_university/marketing8buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button url
$name = 'theme_university/marketing8buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button target
$name = 'theme_university/marketing8target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for Marketing Spot Nine
$name = 'theme_university/marketing9info';
$heading = get_string('marketing9', 'theme_university');
$information = get_string('marketinginfodesc', 'theme_university');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Title
$name = 'theme_university/marketing9';
$title = get_string('marketingtitle', 'theme_university');
$description = get_string('marketingtitledesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Background image setting.
$name = 'theme_university/marketing9image';
$title = get_string('marketingimage', 'theme_university');
$description = get_string('marketingimage_desc', 'theme_university');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing9image');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Content
$name = 'theme_university/marketing9content';
$title = get_string('marketingcontent', 'theme_university');
$description = get_string('marketingcontentdesc', 'theme_university');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button
$name = 'theme_university/marketing9buttontext';
$title = get_string('marketingbuttontext', 'theme_university');
$description = get_string('marketingbuttontextdesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button url
$name = 'theme_university/marketing9buttonurl';
$title = get_string('marketingbuttonurl', 'theme_university');
$description = get_string('marketingbuttonurldesc', 'theme_university');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// button target
$name = 'theme_university/marketing9target';
$title = get_string('marketingurltarget' , 'theme_university');
$description = get_string('marketingurltargetdesc', 'theme_university');
$target1 = get_string('marketingurltargetself', 'theme_university');
$target2 = get_string('marketingurltargetnew', 'theme_university');
$target3 = get_string('marketingurltargetparent', 'theme_university');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
