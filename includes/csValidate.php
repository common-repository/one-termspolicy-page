<?php


namespace oneTermsPolicy;

if (!defined('ABSPATH')) exit();

class csValidate
{
    public function register()
    {
        add_action('register_form', array($this, 'register_form_checkbox'));
        add_filter('registration_errors', array($this, 'registration_check_fields'), 10, 3);
        add_action('login_form', array($this, 'login_form_checkbox'));
        add_filter('wp_authenticate_user', array($this, 'logonation_check_fields'), 10, 2);
    }

    public function register_form_checkbox()
    {
        $validate_option_db = get_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate');
        if (!csPresentation::Cheak_empty_isset($validate_option_db)) {
            $validate_option_db = array();
        }
        if ($validate_option_db['SignUp']['IsCheck']) {
            $IdPage = $validate_option_db['SignUp']['IdPage'];
            $arg = array(
                'post_type' => ONETERMPOLICY_POSTTYPE,
                'p' => $IdPage
            );
            $obj = new \WP_Query($arg);
            $CurrentPost = $obj->post;
            $postTitle = $CurrentPost->post_title ? esc_html($CurrentPost->post_title) : '';
            $postLink = get_permalink($IdPage);
            $postLink = $postLink ? esc_url($postLink) : '';
            $txtRow = esc_html__('را قبول دارم ', ONETERMPOLICY_TD);

            $sectionPrivacy = <<<html
            <p>
                <input type="checkbox" name="checkSignUp" id="">
                <a target="_blank" href="{$postLink}">{$postTitle}</a><span> {$txtRow}</span>
            </p>
html;
            echo $sectionPrivacy;
        }
    }

    public function registration_check_fields($errors, $sanitized_user_login, $user_email)
    {
        $validate_option_db = get_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate');
        if (!csPresentation::Cheak_empty_isset($validate_option_db)) {
            $validate_option_db = array();
        }
        if ($validate_option_db['SignUp']['IsCheck']) {
            $SanitiSignUpIsCheck = isset($_POST['checkSignUp']) ? sanitize_text_field($_POST['checkSignUp']) : '';
            $checkSignUp = $SanitiSignUpIsCheck == 'on' ? true : false;
            if (!$checkSignUp) {
                $errors->add('test', __('جهت ادامه ، قوانین باید مورد قبول واقع گردد', ONETERMPOLICY_TD));
            }
        }
        return $errors;
    }

    public function login_form_checkbox()
    {
        $validate_option_db = get_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate');
        if (!csPresentation::Cheak_empty_isset($validate_option_db)) {
            $validate_option_db = array();
        }
        if ($validate_option_db['SignIn']['IsCheck']) {
            $IdPage = $validate_option_db['SignIn']['IdPage'];
            $arg = array(
                'post_type' => ONETERMPOLICY_POSTTYPE,
                'p' => $IdPage
            );
            $obj = new \WP_Query($arg);
            $CurrentPost = $obj->post;
            $postTitle = $CurrentPost->post_title ? $CurrentPost->post_title : '';
            $postLink = get_permalink($IdPage);
            $postLink = $postLink ? esc_url($postLink) : '';
            $txtRow = esc_html__('را قبول دارم ', ONETERMPOLICY_TD);
            $sectionPrivacy = <<<html
            <p>
                <input type="checkbox" name="checkSignIn" id="">
                <a target="_blank" href="{$postLink}">{$postTitle}</a><span> {$txtRow}</span>
            </p>
html;
            echo $sectionPrivacy;
        }
    }

    public function logonation_check_fields($user, $pass)
    {
        $validate_option_db = get_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate');
        if (!csPresentation::Cheak_empty_isset($validate_option_db)) {
            $validate_option_db = array();
        }
        if ($validate_option_db['SignIn']['IsCheck']) {

            $SanitiSignInIsCheck = isset($_POST['checkSignIn']) ? sanitize_text_field($_POST['checkSignIn']) : '';
            $checkSignIn = $SanitiSignInIsCheck == 'on' ? true : false;
            if ($checkSignIn) {
                return $user;
            } else {
                global $errors;
                $errors->add('did_not_accept', __('جهت ادامه ، قوانین باید مورد قبول واقع گردد', ONETERMPOLICY_TD));
                return $errors;
            }
        } else {
            return $user;
        }
    }

}