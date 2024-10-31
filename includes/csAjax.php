<?php


namespace oneTermsPolicy;

if (!defined('ABSPATH')) exit();

class csAjax
{
    public function register()
    {
        add_action('wp_ajax_' . ONETERMPOLICY_TD . '_option_page', array($this, 'option_page_Handler'));
        add_action('wp_ajax_' . ONETERMPOLICY_TD . '_question_page', array($this, 'question_page_Handler'));
        add_action('wp_ajax_' . ONETERMPOLICY_TD . '_validate_option_page', array($this, 'validate_option_page_Handler'));
    }

    public function option_page_Handler()
    {
        $data_valid = false;
        $text = __('خطا', ONETERMPOLICY_TD);
        $sendfromsubmit = $_POST;
        if (!isset($_POST['nonce_js']) || !wp_verify_nonce($_POST['nonce_js'], 'oneTermsPolicy_Option_page_ajax')) {
            $text = __('خطا امنیتی', ONETERMPOLICY_TD);
            static::responseAjax($text, $data_valid);
            exit();
        }
        if (csPresentation::Cheak_empty_isset($_POST['form_js'])) {
            parse_str($_POST['form_js'], $form_option);
        }
        $form_option = isset($form_option) ? $form_option : '';
        $val_option = array(
            'SiteName' => $form_option['opSiteName'] ? sanitize_text_field($form_option['opSiteName']) : '',
            'SiteUrl' => $form_option['opSiteUrl'] ? esc_url_raw($form_option['opSiteUrl']) : '',
            'CompanyName' => $form_option['opCompanyName'] ? sanitize_text_field($form_option['opCompanyName']) : '',
            'SiteType' => $form_option['opSiteType'] ? sanitize_text_field($form_option['opSiteType']) : '',
            'SiteCity' => $form_option['opSiteCity'] ? sanitize_text_field($form_option['opSiteCity']) : '',
            'BlogOption' => 'PHAgc3R5bGU9InRleHQtYWxpZ246IGxlZnQ7bWFyZ2luOjMwcHggMHB4OyI+DQo8c21hbGw+DQrZgtiv2LHYqiDar9ix2YHYqtmHINi02K/ZhyDYp9iyINmI2KjYs9in24zYqiA8YSBocmVmPSJodHRwczovL3ZpbmRhZC5jb20vIj7ZiNuM2YbYr9in2K88L2E+DQo8L3NtYWxsPg0KPC9wPg=='
        );
        $db_Option = get_option(ONETERMPOLICY_DB_OPTION);
        $response = array();
        if (csPresentation::Cheak_empty_isset($db_Option)) {
            update_option(ONETERMPOLICY_DB_OPTION, $val_option);
            $text = __('اطلاعات با موفقیت ویرایش گردید', ONETERMPOLICY_TD);
            $data_valid = true;
        } else {
            add_option(ONETERMPOLICY_DB_OPTION, $val_option);
            $text = __('اطلاعات با موفقیت اضافه گردید', ONETERMPOLICY_TD);
            $data_valid = true;
        }

        static::responseAjax($text, $data_valid);

        die();
    }

    public function question_page_Handler()
    {
        $data_valid = false;
        $text = __('خطا', ONETERMPOLICY_TD);
        if (!isset($_POST['nonce_js']) || !wp_verify_nonce($_POST['nonce_js'], 'oneTermsPolicy_Option_page_ajax')) {
            $text = __('خطا امنیتی', ONETERMPOLICY_TD);
            static::responseAjax($text, $data_valid);
            exit();
        }
        if (csPresentation::Cheak_empty_isset($_POST['form_js'])) {
            parse_str($_POST['form_js'], $form_question);
        }
        $form_question = isset($form_question) ? $form_question : '';
        $CurrentPage = sanitize_text_field($form_question['fromPage']);
        if (csPresentation::Cheak_empty_isset($CurrentPage)) {
            $Question = array();
            if (csPresentation::Cheak_empty_isset($form_question[$CurrentPage]['field'])) {
                foreach ($form_question[$CurrentPage]['field'] as $key => $field) {
                    switch ($key) {
                        case 'field1':
                        case 'field2' :
                        case 'field4' :
                        case 'field5' :
                        case 'field6' :
                            $Question[$key] = sanitize_text_field($field);
                            break;
                        default:
                            if ($CurrentPage === 'StoreQuestion' || $CurrentPage === 'PersonalQuestion') {
                                if ($key === 'field3') {
                                    $Question[$key] = esc_url_raw($field);
                                    break;
                                }
                            }
                            if ($CurrentPage === 'CompanyQuestion') {
                                if ($key === 'field3') {
                                    $Question[$key] = sanitize_text_field($field);
                                    break;
                                }
                            }
                            if ($CurrentPage === 'StoreQuestion') {
                                if ($key === 'field7') {
                                    $Question[$key] = sanitize_email($field);
                                    break;
                                }
                            }
                            break;
                    }
                }
            }
            if (csPresentation::Cheak_empty_isset($form_question[$CurrentPage]['radio'])) {
                $valid_radio = array(
                    'true',
                    'false'
                );
                foreach ($form_question[$CurrentPage]['radio'] as $key => $radio) {
                    if (in_array($radio, $valid_radio)) {
                        $Question[$key] = sanitize_text_field($radio);
                    }
                }
            }
            if (csPresentation::Cheak_empty_isset($form_question[$CurrentPage]['checkbox'])) {
                $valid_checkbox = array(
                    'درگاه آنلاین',
                    'پرداخت نقدی',
                    'چک'
                );
                foreach ($form_question[$CurrentPage]['checkbox'] as $key => $checkbox) {
                    $arrayDef = array_diff($checkbox, $valid_checkbox);
                    if (count($arrayDef) == 0) {
                        $Saniti_Checkbox = array();
                       foreach ($checkbox as $item){
                            array_push($Saniti_Checkbox , sanitize_text_field($item));
                       }
                        $Question[$key] = $Saniti_Checkbox;
                    }
                }
            }

            $objBuild = new csBuild();
            switch ($CurrentPage) {
                case 'StoreQuestion':
                    $text = __('قوانین فروشگاه کالا ایجاد گردید', ONETERMPOLICY_TD);
                    $Build = $objBuild->GetBuildStore($Question);
                    $Build = trim(preg_replace('/\s\s+/', ' ', $Build));
                    $args = array(
                        'post_type' => ONETERMPOLICY_POSTTYPE,
                        'post_title' => 'قوانین فروشگاه کالا',
                        'post_name' => 'Store-Privacy',
                        'post_content' => $Build
                    );
                    $PolicyId = wp_insert_post($args);
                    $urlPolicy = get_edit_post_link($PolicyId);
                    $text .= '<p>در صورتی که به صورت اتوماتیک به صفحه ویرایش انتقال نیافتید <a href="' . $urlPolicy . '">اینجا</a> کلیک کنید</p>';
                    $data_valid = true;
                    $Status = true;
                    $response = array(
                        'text' => $text,
                        'url' => $urlPolicy,
                        'status' => $Status
                    );
                    echo json_encode($response);
                    break;
                case 'CompanyQuestion':
                    $text = __('قوانین فروشگاه خدماتی ایجاد گردید', ONETERMPOLICY_TD);
                    $Build = $objBuild->GetBuildCompany($Question);
                    $Build = trim(preg_replace('/\s\s+/', ' ', $Build));
                    $args = array(
                        'post_type' => ONETERMPOLICY_POSTTYPE,
                        'post_title' => 'قوانین فروشگاه خدماتی',
                        'post_name' => 'Company-Privacy',
                        'post_content' => $Build
                    );
                    $PolicyId = wp_insert_post($args);
                    $urlPolicy = get_edit_post_link($PolicyId);
                    $text .= '<p>در صورتی که به صورت اتوماتیک به صفحه ویرایش انتقال نیافتید <a href="' . $urlPolicy . '">اینجا</a> کلیک کنید</p>';
                    $data_valid = true;
                    $Status = true;
                    $response = array(
                        'text' => $text,
                        'url' => $urlPolicy,
                        'status' => $Status
                    );
                    echo json_encode($response);
                    break;
                case 'PersonalQuestion':
                    $text = __('قوانین سایت شخصی ایجاد گردید', ONETERMPOLICY_TD);
                    $Build = $objBuild->GetBuildPersonal($Question);
                    $Build = trim(preg_replace('/\s\s+/', ' ', $Build));
                    $args = array(
                        'post_type' => ONETERMPOLICY_POSTTYPE,
                        'post_title' => 'قوانین شخصی',
                        'post_name' => 'Personal-Privacy',
                        'post_content' => $Build
                    );
                    $PolicyId = wp_insert_post($args);
                    $urlPolicy = get_edit_post_link($PolicyId);
                    $text .= '<p>در صورتی که به صورت اتوماتیک به صفحه ویرایش انتقال نیافتید <a href="' . $urlPolicy . '">اینجا</a> کلیک کنید</p>';
                    $data_valid = true;
                    $Status = true;
                    $response = array(
                        'text' => $text,
                        'url' => $urlPolicy,
                        'status' => $Status
                    );
                    echo json_encode($response);
                    break;
                case 'PrivacyQuestion':
                    $text = __('قوانین حریم خصوصی ایجاد گردید', ONETERMPOLICY_TD);
                    break;
                default:
                    break;
            }
        }
        die();
    }

    public function validate_option_page_Handler()
    {
        $data_valid = false;
        $text = __('خطا', ONETERMPOLICY_TD);
        if (!isset($_POST['nonce_js']) || !wp_verify_nonce($_POST['nonce_js'], 'oneTermsPolicy_Option_page_ajax')) {
            $text = __('خطا امنیتی', ONETERMPOLICY_TD);
            static::responseAjax($text, $data_valid);
            exit();
        }
        if (csPresentation::Cheak_empty_isset($_POST['form_js'])) {
            parse_str($_POST['form_js'], $form_validate_option);
        }
        $form_validate_option = isset($form_validate_option) ? $form_validate_option : '';
        $valid_Page_Ids = (new csQuery())->get_published_TermsPolicy_Post_IDs();
        $formIdSignIn = sanitize_text_field($form_validate_option['selectSignInPrivacy']);
        $formIdSignUp = sanitize_text_field($form_validate_option['selectSignUpPrivacy']);
        $SignInIdPage = in_array($formIdSignIn,$valid_Page_Ids) ? $formIdSignIn : '' ;
        $SignUpIdPage = in_array($formIdSignUp,$valid_Page_Ids) ? $formIdSignUp : '' ;
        $val_validate_option = array(
            'SignIn' => array(
                'IsCheck' => sanitize_text_field($form_validate_option['showSignIn']) == 'on' ? true : false,
                'IdPage' => $SignInIdPage
            ),
            'SignUp' => array(
                'IsCheck' => sanitize_text_field($form_validate_option['showSignUp']) == 'on' ? true : false,
                'IdPage' => $SignUpIdPage
            )
        );
        $db_Option = get_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate');

        if (csPresentation::Cheak_empty_isset($db_Option)) {
            update_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate', $val_validate_option);
            $text = __('اطلاعات با موفقیت ویرایش گردید', ONETERMPOLICY_TD);
            $data_valid = true;
        } else {
            add_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate', $val_validate_option);
            $text = __('اطلاعات با موفقیت اضافه گردید', ONETERMPOLICY_TD);
            $data_valid = true;
        }

        static::responseAjax($text, $data_valid);

        die();
    }

    public static function responseAjax($text, $Status)
    {
        if (csPresentation::Cheak_empty_isset($text, $Status)) {
            $response = array(
                'text' => $text,
                'status' => $Status
            );
            echo json_encode($response);
        }
    }
}
