<?php
/*
Plugin Name: Sweetcaptcha
Plugin URI:
Description: Replace reCaptcha for Sweetcaptcha
Version: 0.1
Author: Osclass
Author URI: http://www.osclass.org/
Short Name: sweetcaptcha
Plugin update URI: sweetcaptcha
*/

osc_add_hook('before_user_register', 'sweetcaptcha_user_register_check');
function sweetcaptcha_user_register_check()
{
    sweetcaptcha_check(array(), osc_register_account_url());
}

osc_add_hook('pre_item_add',  'sweetcaptcha_item_add_check');
function sweetcaptcha_item_add_check()
{
    sweetcaptcha_check(array(), osc_item_post_url());
}

osc_add_hook('init', 'sweetcaptcha_contact_check');
function sweetcaptcha_contact_check()
{
    if(Params::getParam('page')=='contact' && Params::getParam('action')=='contact_post'){
        sweetcaptcha_check(array(), osc_contact_url());
    }
}

osc_add_hook('pre_item_contact_post', 'sweetcaptcha_item_contact_check');
function sweetcaptcha_item_contact_check($item)
{
    View::newInstance()->_exportVariableToView('item', $item);
    sweetcaptcha_check(array(), osc_item_url());
}

osc_add_hook('pre_item_send_friend_post', 'sweetcaptcha_item_send_friend_check');
function sweetcaptcha_item_send_friend_check($item)
{
    View::newInstance()->_exportVariableToView('item', $item);
    sweetcaptcha_check(array(), osc_item_send_friend_url());
}

function sweetcaptcha_check($item, $url)
{
    if(Params::getParam('sweetcaptcha_on')=='1') {
        require_once('sweetcaptcha.php');
        if (isset($_POST['sckey']) and isset($_POST['scvalue']) and $sweetcaptcha->check(array('sckey' => $_POST['sckey'], 'scvalue' => $_POST['scvalue'])) == "true") {
            // success! your form was validated
        } else {
            $fm = __("Wrong captcha, please try it again.", "sweetcaptcha");
            osc_add_flash_error_message($fm);
            osc_redirect_to($url);
        }
    }
}

function sweetcaptcha_print()
{
    if((Params::getParam('page')=='item' && Params::getParam('action') == 'item_add') ||   // new listing
        Params::getParam('page')=='register' && Params::getParam('action')=='register' ||  // user registration
        Params::getParam('page')=='contact' ||   // webmaster contact
        Params::getParam('page')=='item'  ||     // item contact
        Params::getParam('page')=='send_friend'  // send friend
    ) {
        require_once('sweetcaptcha.php');
        echo "<input type='hidden' name='sweetcaptcha_on' value='1'/>";
        echo $sweetcaptcha->get_html();
    }
}

osc_add_hook('ajax_sweetcaptcha', 'sweetcaptcha_ajax');
function sweetcaptcha_ajax()
{
    require_once('sweetcaptcha.php');
}

// admin menu

osc_add_hook('admin_header','sweetcaptcha_admin_menu');
function sweetcaptcha_admin_menu() {

    osc_add_admin_submenu_page(
        'plugins',
        __('SweetCaptcha', 'sweetcaptcha'),
        osc_admin_render_plugin_url(osc_plugin_folder(__FILE__)."admin.php"),
        'sweetcaptcha',
        'moderator'
    );
}

osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'sweetcaptcha_uninstall');
function sweetcaptcha_uninstall()
{
    osc_delete_preference('app_id',     'sweetcaptcha');
    osc_delete_preference('app_key',    'sweetcaptcha');
    osc_delete_preference('app_secret', 'sweetcaptcha');
}