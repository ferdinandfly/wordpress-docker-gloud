<?php SimpleWpMembership::enqueue_validation_scripts(array('ajaxEmailCall' => array('extraData'=>'&action=swpm_validate_email&member_id='.filter_input(INPUT_GET, 'member_id')))); ?>
<div class="FormulaireMembre">
    <form id="swpm-registration-form" name="swpm-registration-form" method="post" action="">
            <input type ="hidden" name="level_identifier" value="<?php echo $level_identifier ?>" />
            <div class="FormulaireMembre">
                <div>
                <label style="margin-left:0px;"><FONT color="red">*&nbsp;&nbsp;<?php echo SwpmUtils::_('Fields required') ?></FONT></label>
                </div>   
                <label for="user_name"><?php echo SwpmUtils::_('Username') ?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="text" id="user_name" value="<?php echo esc_attr($user_name); ?>"  maxlength="8" size="25" name="user_name" />
            </div>
            <div class="FormulaireMembre">
                <label for="email"><?php echo SwpmUtils::_('Email') ?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="text" id="email" value="<?php echo esc_attr($email); ?>" maxlength="45" size="25" name="email" />
            </div>
            <div class="FormulaireMembre">
                <label for="password"><?php echo SwpmUtils::_('Password') ?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="password" autocomplete="off" id="password" value="" maxlength="25" size="25" name="password" />
            </div>
            <div class="FormulaireMembre">
                <label for="password_re"><?php echo SwpmUtils::_('Repeat Password') ?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="password" autocomplete="off" id="password_re" value="" maxlength="25" size="25" name="password_re" />
            </div>
            <div class="FormulaireMembre">
                <label for="last_name"><?php echo SwpmUtils::_('Last Name');?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="text" id="last_name"  value="<?php echo esc_attr($last_name); ?>" maxlength="25" size="25" name="last_name" />
            </div>
            <div class="FormulaireMembre">
                <label for="first_name"><?php echo SwpmUtils::_('First Name');?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="text" id="first_name"  value="<?php echo esc_attr($first_name); ?>" maxlength="25" size="25" name="first_name" />
            </div>
            <div class="FormulaireMembre">
                <label for="company_name"><?php echo SwpmUtils::_('Company Name') ?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="text" id="company_name"  value="<?php echo esc_attr($company_name); ?>" maxlength="45" size="25" name="company_name" />
            </div>
            <div class="FormulaireMembre">
                <label for="phone"><?php echo SwpmUtils::_('Phone') ?></label>
                <input type="text" id="phone"  value="<?php echo esc_attr($phone); ?>" maxlength="25" size="25" name="phone" />
            </div>
            <div class="FormulaireMembre">
                <label for="address_street"><?php echo SwpmUtils::_('Street'); ?></label>
                <input type="text" id="address_street"  value="<?php echo $address_street; ?>" maxlength="45" size="25" name="address_street" />
            </div>
            <div class="FormulaireMembre">
                <label for="address_zipcode"><?php echo SwpmUtils::_('Zipcode'); ?></label>
                <input type="text" id="address_zipcode"  value="<?php echo $address_zipcode; ?>" maxlength="25" size="25" name="address_zipcode" />
            </div>
            <div class="FormulaireMembre">
                <label for="address_city"><?php echo SwpmUtils::_('City'); ?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="text" id="address_city"  value="<?php echo $address_city; ?>" maxlength="45" size="25" name="address_city" />
            </div>
            <div class="FormulaireMembre">
                <label for="country"><?php echo SwpmUtils::_('Country'); ?>&nbsp;&nbsp;<FONT color="red">*</FONT></label>
                <input type="text" id="country"  value="<?php echo $country; ?>" maxlength="25" size="25" name="country" />
            </div>
            <div class="FormulaireMembre">
                <!--<div><label for="membership_level"><?php echo SwpmUtils::_('Membership Level') ?></label></div>-->
                <div>
                    <?php 
                    //echo $membership_level_alias;//Show the level name in the form.
                    //Add the input fields for the level data.
                    echo '<input type="hidden" value="'.$membership_level.'" maxlength="25" size="25" name="membership_level" id="membership_level" />';
                    //Add the level input verification data.
                    $swpm_p_key = get_option('swpm_private_key_one');
                    if(empty($swpm_p_key)){
                        $swpm_p_key = uniqid('', true);
                        update_option('swpm_private_key_one',$swpm_p_key);
                    }
                    $swpm_level_hash = md5($swpm_p_key.'|'.$membership_level);//level hash
                    echo '<input type="hidden" name="swpm_level_hash" value="' . $swpm_level_hash . '" />';
                    ?>
                </div>
            </div>           
        
        <div class="swpm-before-registration-submit-section" align="center"><?php echo apply_filters('swpm_before_registration_submit_button', ''); ?></div>
        
        <div class="FormulaireMembre" align="center">
            <input type="submit" value="<?php echo SwpmUtils::_('Register') ?>" class="FormulaireMembre" name="swpm_registration_submit" />
        </div>
        
        <input type="hidden" name="action" value="custom_posts" />
        
    </form>
</div>
