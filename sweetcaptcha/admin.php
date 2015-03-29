<?php

if(Params::getParam('plugin_action')=='post_form') {

    $id     = Params::getParam('appId');
    $key    = Params::getParam('appKey');
    $secret = Params::getParam('appSecret');
    osc_set_preference('app_id',     $id,     'sweetcaptcha');
    osc_set_preference('app_key',    $key,    'sweetcaptcha');
    osc_set_preference('app_secret', $secret, 'sweetcaptcha');
    osc_reset_preferences();

    osc_add_flash_ok_message(__('Saved SweetCaptcha settings', 'sweetcaptcha'), 'admin');
    osc_show_flash_message('admin');
}
?>

<div style="padding: 20px;">
    <h2 class="render-title"><?php _e('Sweetcaptcha settings', 'sweetcaptcha'); ?></h2>

    <form name="sweetcaptcha" action="<?php echo osc_admin_base_url(true);?>" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="page" value="plugins" />
        <input type="hidden" name="action" value="renderplugin" />
        <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__);?>admin.php" />
        <input type="hidden" name="plugin_action" value="post_form" />

        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <div class="form-label"><?php _e('Application Id', 'sweetcaptcha'); ?></div>
                    <div class="form-controls"><input type="text" class="xlarge" name="appId" value="<?php echo osc_get_preference('app_id', 'sweetcaptcha')?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label"><?php _e('Application Key', 'sweetcaptcha'); ?></div>
                    <div class="form-controls"><input type="text" class="xlarge" name="appKey" value="<?php echo osc_get_preference('app_key', 'sweetcaptcha')?>"></div>
                </div>
                <div class="form-row">
                    <div class="form-label"><?php _e('Application Secret', 'sweetcaptcha'); ?></div>
                    <div class="form-controls"><input type="text" class="large" name="appSecret" value="<?php echo osc_get_preference('app_secret', 'sweetcaptcha')?>"></div>
                </div>

                <div class="clear"></div>

                <div class="form-actions">
                    <button type="submit"><?php _e('Save', 'sweetcaptcha'); ?></button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

<div style="padding: 20px;">
    <h2 class="render-title"><?php _e('How it works', 'sweetcaptcha'); ?></h2>

    <p>You can add Sweetcaptcha at:</p>

    <ul style="line-height: 30px;">
        <li>- New listing page.</li>
        <li>- User registration page.</li>
        <li>- Web contact page.</li>
        <li>- Contact listing page.</li>
        <li>- 'Send to a friend' listing page.</li>
    </ul>

    <p>First, you need to fill and save SweetCaptcha credentials in this page,
        If you don't have an account, you can create a new one here <a target="blank" href="http://sweetcaptcha.com/">http://sweetcaptcha.com/</a></p>

    <p>Second, you will need to paste the following line of code before the submit form button.</p>
    <br>
    <code><?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> sweetcaptcha_print(); <?php echo htmlspecialchars("?>", ENT_QUOTES). PHP_EOL; ?></code>
    <br>

    <pre>
<?php echo htmlspecialchars("<form>", ENT_QUOTES); ?>

    ...

    <b><?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> sweetcaptcha_print(); <?php echo htmlspecialchars("?>", ENT_QUOTES). PHP_EOL; ?></b>
    <?php echo htmlspecialchars('<button type="submit" value="Save"/>') . PHP_EOL; ?>
<?php echo htmlspecialchars("</form>", ENT_QUOTES). PHP_EOL; ?>
    </pre>
    <br>
    <br>
    <p style="font-size: 18px;"><b>IMPORTANT NOTE:<br>Before install the plugin </b>This plugin needs to include code on some theme files. Be sure the plugin is installed and configured with application credetials before modify any theme file,if not application will crash.<br>
    <b>Before uninstall the plugin</b> Remove changes in modified files, if not application will crash</p>
    <br>
    <br>

    <h2 class="render-title"><?php _e('FAQ', 'sweetcaptcha'); ?></h2>

    <h3><?php _e('More SweetCaptcha information, change language, ...', 'sweetcaptcha'); ?></h3>
    <p><a href="http://sweetcaptcha.com/faq">http://sweetcaptcha.com/faq</a></p>

    <br>
    <hr/>

    <br>
    <h2 class="render-title"><?php _e('Change recaptcha by SweetCaptcha, Bender theme example', 'sweetcaptcha'); ?></h2>

    <h3>New listing (oc-content/bender/item-post.php) Bender theme</h3>

    Find and replace this code; (it not exist, simply add the replace part inside <?php echo htmlspecialchars("<form>", ENT_QUOTES); ?> element)

    <pre>
<?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> if( osc_recaptcha_items_enabled() ) { <?php echo htmlspecialchars("?>", ENT_QUOTES); ?>
<div class="controls">
    <?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> osc_show_recaptcha(); ?><?php echo htmlspecialchars("?>", ENT_QUOTES); ?>
</div>
<?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> } <?php echo htmlspecialchars("?>", ENT_QUOTES); ?>
    </pre>

    replace by

    <pre><?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> sweetcaptcha_print(); <?php echo htmlspecialchars("?>", ENT_QUOTES); ?></pre>

    <h3>User registration (oc-content/bender/user-register.php) Bender theme</h3>

    Find and replace this code; (it not exist, simply add the replace part inside <?php echo htmlspecialchars("<form>", ENT_QUOTES); ?> element)

    <pre>
<?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> if( osc_recaptcha_items_enabled() ) { <?php echo htmlspecialchars("?>", ENT_QUOTES); ?>
<div class="controls">
    <?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> osc_show_recaptcha(); ?><?php echo htmlspecialchars("?>", ENT_QUOTES); ?>
</div>
<?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> } <?php echo htmlspecialchars("?>", ENT_QUOTES); ?>
    </pre>

    replace by

    <pre><?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> sweetcaptcha_print(); <?php echo htmlspecialchars("?>", ENT_QUOTES); ?></pre>

    <h3><?php _e('Show SweetCaptcha to non registered users only (tip)', 'sweetcaptcha'); ?></h3>

    <p>You can show sweetCaptcha at New listing page only for non registered users.</p>
    <p>You only need to add the following code wrapping <code>sweetcaptcha_print()</code> function.</p>

    <pre>
<b><?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> if(!osc_is_web_user_logged_in()) { <?php echo htmlspecialchars("?>", ENT_QUOTES);?></b>
<div class="controls">
    <?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> sweetcaptcha_print(); <?php echo htmlspecialchars("?>", ENT_QUOTES). PHP_EOL; ?>
</div>
<b><?php echo htmlspecialchars("<?php", ENT_QUOTES); ?> } <?php echo htmlspecialchars("?>", ENT_QUOTES). PHP_EOL; ?></pre></b>
    </pre>

    <h3><?php _e('All theme files', 'sweetcaptcha'); ?></h3>
    <ul style="line-height: 30px;">
        <li>New listing                     (oc-content/bender/item-post.php)        Bender theme</li>
        <li>User registration               (oc-content/bender/user-register.php)    Bender theme</li>
        <li>Web contact page                (oc-content/bender/contact.php)          Bender theme</li>
        <li>Contact listing page            (oc-content/bender/item-sidebar.php)     Bender theme</li>
        <li>'Send to a friend' listing page (oc-content/bender/item-send-friend.php) Bender theme</li>
    </ul>
</div>