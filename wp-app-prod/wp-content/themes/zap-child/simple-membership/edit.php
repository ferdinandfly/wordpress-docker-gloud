<?php
$auth = SwpmAuth::get_instance();
$user_data = (array) $auth->userData;
$user_data['membership_level_alias'] = $auth->get('alias');
extract($user_data, EXTR_SKIP);
//The admin ajax causes an issue with the JS validation if done on form submission. The edit profile doesn't need JS validation on email. There is PHP validation which will catch any email error.
//SimpleWpMembership::enqueue_validation_scripts(array('ajaxEmailCall' => array('extraData'=>'&action=swpm_validate_email&member_id='.SwpmAuth::get_instance()->get('member_id'))));
?>
<div class="ProfileMember">
        <form id="swpm-editprofile-form" name="swpm-editprofile-form" method="post" action="">
        <?php wp_nonce_field('swpm_profile_edit_nonce_action', 'swpm_profile_edit_nonce_val') ?>
            <div class="ProfileMember">
                <label for="username"><?php echo SwpmUtils::_('Username'); ?></label>
                <input type="text" id="username" value="<?php echo $user_name ?>" size="25" name="username" disabled />
            </div>
            <div class="ProfileMember">
                <label for="email"><?php echo SwpmUtils::_('Email'); ?></label>
                <input type="text" id="email" class="validate[required,custom[email],ajax[ajaxEmailCall]]" value="<?php echo $email; ?>" size="25" maxlength="45" name="email" />
            </div>
            <div class="ProfileMember">
                <label for="password"><?php echo SwpmUtils::_('Password'); ?></label>
                <input type="password" id="password" value="" size="25" maxlength="25" name="password" placeholder="<?php echo SwpmUtils::_('Leave empty to keep the current password'); ?>" />
            </div>
            <div class="ProfileMember">
                <label for="password_re"><?php echo SwpmUtils::_('Repeat Password'); ?></label>
                <input type="password" id="password_re" value="" size="25" maxlength="25" name="password_re" placeholder="<?php echo SwpmUtils::_('Leave empty to keep the current password'); ?>" />
            </div>
            <div class="ProfileMember">
                <label for="last_name"><?php echo SwpmUtils::_('Last Name'); ?></label>
                <input type="text" id="last_name" value="<?php echo $last_name; ?>" size="25" maxlength="25" name="last_name" />
            </div>
            <div class="ProfileMember">
                <label for="first_name"><?php echo SwpmUtils::_('First Name'); ?></label>
                <input type="text" id="first_name" value="<?php echo $first_name; ?>" size="25" maxlength="25" name="first_name" />
            </div>
            <div class="ProfileMember">
                <label for="company_name"><?php echo SwpmUtils::_('Company Name'); ?></label>
                <input type="text" id="last_name" value="<?php echo $company_name; ?>" size="25" maxlength="45" name="company_name" />
            </div>
            <div class="ProfileMember">
                <label for="phone"><?php echo SwpmUtils::_('Phone'); ?></label>
                <input type="text" id="phone" value="<?php echo $phone; ?>" size="25" maxlength="25" name="phone" />
            </div>
            <div class="ProfileMember">
                <label for="address_street"><?php echo SwpmUtils::_('Street'); ?></label>
                <input type="text" id="address_street" value="<?php echo $address_street; ?>" size="25" maxlength="45" name="address_street" />
            </div>

            <div class="ProfileMember">
                <label for="address_city"><?php echo SwpmUtils::_('City'); ?></label>
                <input type="text" id="address_city" value="<?php echo $address_city; ?>" size="25" maxlength="45" name="address_city"/>
            </div>
            <div class="ProfileMember">
                <label for="address_zipcode"><?php echo SwpmUtils::_('Zipcode'); ?></label>
                <input type="text" id="address_zipcode" value="<?php echo $address_zipcode; ?>" size="25" maxlength="25" name="address_zipcode" />
            </div>

            <div class="ProfileMember">
                <label for="country"><?php echo SwpmUtils::_('Country'); ?></label>
                <input type="text" id="country" value="<?php echo $country; ?>" size="25" maxlength="25" name="country" />
            </div>
        <p class="swpm-edit-profile-submit-section">
            <input type="submit" value="<?php echo SwpmUtils::_('Update') ?>" class="swpm-edit-profile-submit" name="swpm_editprofile_submit" />
        </p>
        <?php echo SwpmUtils::delete_account_button(); ?>

        <input type="hidden" name="action" value="custom_posts" />
      </form>

</div>