<?php
if (!defined('ABSPATH')) exit();

$objPosts = (new \oneTermsPolicy\csQuery())->get_published_TermsPolicy_Post();

$validate_option_db = get_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate');
if (!\oneTermsPolicy\csPresentation::Cheak_empty_isset($validate_option_db)) {
    $validate_option_db = array();
}
?>

<div class="wrap">
    <div class="onetermOptionHeader">
        <h2 class="nav-tab-wrapper">
            <a href="?post_type=one-termspolicy_page&page=oneTermsPolicy_option"
               class="nav-tab "><?php _e('اطلاعات عمومی', ONETERMPOLICY_TD); ?></a>
            <a href="?post_type=one-termspolicy_page&page=oneTermsPolicy_Validate_option"
               class="nav-tab nav-tab-active"><?php _e('تنظیمات پیشرفته', ONETERMPOLICY_TD); ?></a>
        </h2>
        <h1><?php _e('تنظیمات اعتبار سنجی', ONETERMPOLICY_TD); ?></h1>
    </div>
    <div class="onetermoptionPage">
        <form action="" id="frmValidateOption">
            <table>
                <tbody>
                <tr>
                    <th><?php esc_html_e('نمایش و الزام در فرم ورود وب سایت ؟', ONETERMPOLICY_TD) ?></th>
                    <td>
                        <input type="checkbox" name="showSignIn" id="showSignIn" <?php echo
                        esc_html($validate_option_db['SignIn']['IsCheck']) == true ? 'checked' : '' ?>>
                    </td>
                </tr>
                <tr <?php echo esc_html($validate_option_db['SignIn']['IsCheck']) == true ? '' : 'style="display: none"' ?>
                        id="rowSignInSelectPrivacy">
                    <th>
                        <label for=""><?php esc_html_e('انتخاب قانون', ONETERMPOLICY_TD); ?></label>
                    </th>
                    <td>
                        <select name="selectSignInPrivacy" id="">
                            <option value=""><?php esc_html_e('لطفاً انتخاب نمایید', ONETERMPOLICY_TD); ?></option>
                            <?php if (\oneTermsPolicy\csPresentation::Cheak_empty_isset($objPosts)) : ?>
                                <?php foreach ($objPosts as $object) : ?>
                                    <option value="<?php esc_attr_e($object->ID); ?>" <?php
                                    echo esc_attr($validate_option_db['SignIn']['IdPage']) == $object->ID ? 'selected' : '' ?>><?php
                                        echo
                                        esc_attr_e
                                        ($object->post_title);
                                        ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php esc_html_e('نمایش و الزام در فرم ثبت نام وب سایت ؟', ONETERMPOLICY_TD) ?></th>
                    <td>
                        <input type="checkbox" name="showSignUp" id="showSignUp" <?php echo
                        esc_html($validate_option_db['SignUp']['IsCheck']) == true ? 'checked' : '' ?>>
                    </td>
                </tr>
                <tr <?php echo esc_html($validate_option_db['SignUp']['IsCheck']) == true ? '' : 'style="display: none"' ?>
                        id="rowSignUpSelectPrivacy">
                    <th>
                        <label for="selectSignUpPrivacy"><?php esc_html_e('انتخاب قانون', ONETERMPOLICY_TD); ?></label>
                    </th>
                    <td>
                        <select name="selectSignUpPrivacy" id="">
                            <option value=""><?php esc_html_e('لطفاً انتخاب نمایید', ONETERMPOLICY_TD); ?></option>
                            <?php if (\oneTermsPolicy\csPresentation::Cheak_empty_isset($objPosts)) : ?>
                                <?php foreach ($objPosts as $object) : ?>
                                    <option value="<?php esc_attr_e($object->ID); ?>" <?php
                                    echo esc_attr($validate_option_db['SignUp']['IdPage']) == $object->ID ? 'selected' : '' ?>><?php
                                        echo
                                        esc_attr_e
                                        ($object->post_title);
                                        ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <p>
                <input type="submit" class="button-primary option_sub"
                       value="<?php esc_attr_e('ثبت اطلاعات', ONETERMPOLICY_TD); ?>">
                <img src="<?php echo esc_url(admin_url('/images/wpspin_light.gif')); ?>" class="waiting"
                     id='one-loading' style="display:none">
            </p>
            <p class="responseAjax"></p>
        </form>
    </div>
</div>
