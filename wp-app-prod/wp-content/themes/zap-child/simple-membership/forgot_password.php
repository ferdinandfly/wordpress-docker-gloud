<div class="FormulairePassword">
    <form id="swpm-pw-reset-form" name="swpm-reset-form" method="post" action="">
        <div class="swpm-pw-reset-widget-inside">
            <div class="swpm-pw-reset-email swpm-margin-top-10">
                <label for="swpm_reset_email"><?php echo SwpmUtils::_('Email Address') ?></label>
            </div>
            <div class="swpm-pw-reset-email-input swpm-margin-top-10">
                <input type="text" name="swpm_reset_email" id="swpm_reset_email"  value="" maxlength="45" size="25" />
            </div>
            <div class="swpm-before-login-submit-section swpm-margin-top-10"><?php echo apply_filters('swpm_before_pass_reset_form_submit_button', ''); ?></div>
            <div class="swpm-pw-reset-submit-button swpm-margin-top-10">
                <input type="submit" name="swpm-reset" class="swpm-pw-reset-submit" value="<?php echo SwpmUtils::_('Reset Password'); ?>" />
            </div>
        </div>
    </form>
</div>
