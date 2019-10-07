<?php
$auth = SwpmAuth::get_instance();
$setting = SwpmSettings::get_instance();
$password_reset_url = $setting->get_value('reset-page-url');
$join_url = $setting->get_value('join-us-page-url');
$currentLang = qtranxf_getLanguage();
?>
<div class="FormulaireLogin">
    <form id="swpm-login-form" name="swpm-login-form" method="post" action="">
        <div class="swpm-login-form-inner">
            <div>
            <label style="text-align:left;color:#fff;background-color:#50a160;width:100%;font-weight:400;">&nbsp;&nbsp;<?php echo SwpmUtils::_('Login') ?>
            </div>
            <div>
            <BR/>
            </div>
            <div class="swpm-username-input">
                <label for="swpm_user_name" class="swpm-label"><?php echo SwpmUtils::_('Username or Email') ?> : </label>
                <input type="text" class="swpm-text-field swpm-username-field" id="swpm_user_name" value="" size="25" maxlength="45" name="swpm_user_name"/>
            </div>
            <div>
                <BR/>
            </div>
            <div class="swpm-password-input">
                <label for="swpm_password" class="swpm-label"><?php echo SwpmUtils::_('Password') ?> : </label>
                <input type="password" class="swpm-text-field swpm-password-field" id="swpm_password" value="" size="25" maxlength="25" name="swpm_password"/>
            </div>
            <div class="swpm-remember-me">

                <input type="checkbox" name="rememberme" value="checked='checked'">
                <span class="swpm-rember-label"> <?php echo SwpmUtils::_('Remember Me') ?></span>
                <input type="submit" class="swpm-login-form-submit" name="swpm-login" value="<?php echo SwpmUtils::_('Login') ?>"/>
            </div>
            <div class="swpm-before-login-submit-section"><?php echo apply_filters('swpm_before_login_form_submit_button', ''); ?></div>
            <div class="swpm-login-submit">
            </div>
            <div class="swpm-forgot-pass-link">
                <a id="forgot_pass" class="swpm-login-form-pw-reset-link"  href="<?php echo $password_reset_url; ?>"><b><?php echo SwpmUtils::_('Forgot Password') ?>?</b></a>
            </div>
            <div class="swpm-login-widget-action-msg">
                <?php echo $auth->get_message(); ?>
            </div>
        </div>
    </form>
</div>
