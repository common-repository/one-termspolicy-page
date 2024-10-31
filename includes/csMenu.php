<?php

namespace oneTermsPolicy;


if(!defined('ABSPATH'))exit();

class csMenu{
    protected $oneQuery;
    public function __construct()
    {
        $this->oneQuery = new csQuery();
    }
    public function register()
    {
        $this->registerSubMenu();
    }
    public function registerSubMenu()
    {
        add_action('admin_menu',array($this,'AddSubMenu'));
    }
    public function AddSubMenu()
    {
        /*oneTermsPolicy_option*/
        add_submenu_page(
            'edit.php?post_type=one-termspolicy_page',
            __('تنظیمات',ONETERMPOLICY_TD),
            __('تنظیمات',ONETERMPOLICY_TD),
            'manage_options',
            'oneTermsPolicy_option',
            array($this,'page_option_content')
        );
        /*oneTermsPolicy_StoreShop*/
        add_submenu_page(
            null,
            __('شرایط و قوانین سایت فروشگاهی',ONETERMPOLICY_TD),
            __('شرایط و قوانین سایت فروشگاهی',ONETERMPOLICY_TD),
            'manage_options',
            'oneTermsPolicy_StoreShop',
            array($this,'privacy_Question_Content')
        );
        /*oneTermsPolicy_Company*/
        add_submenu_page(
            null,
            __('شرایط و قوانین سایت شرکتی',ONETERMPOLICY_TD),
            __('شرایط و قوانین سایت شرکتی',ONETERMPOLICY_TD),
            'manage_options',
            'oneTermsPolicy_Company',
            array($this,'privacy_Question_Content')
        );
        /*oneTermsPolicy_Personal*/
        add_submenu_page(
            null,
            __('شرایط و قوانین سایت شخصی',ONETERMPOLICY_TD),
            __('شرایط و قوانین سایت شخصی',ONETERMPOLICY_TD),
            'manage_options',
            'oneTermsPolicy_Personal',
            array($this,'privacy_Question_Content')
        );
        /*oneTermsPolicy_Privacy*/
        add_submenu_page(
            null,
            __('حریم خصوصی',ONETERMPOLICY_TD),
            __('حریم خصوصی',ONETERMPOLICY_TD),
            'manage_options',
            'oneTermsPolicy_Privacy',
            array($this,'privacy_Question_Content')
        );
        add_submenu_page(
            null,
            __('تنظمیات اعتبارسنجی',ONETERMPOLICY_TD),
            __('تنظمیات اعتبارسنجی',ONETERMPOLICY_TD),
            'manage_options',
            'oneTermsPolicy_Validate_option',
            array($this,'page_validate_option_content')
        );
        add_submenu_page(
            'edit.php?post_type=one-termspolicy_page',
            __('درباره افزونه',ONETERMPOLICY_TD),
            __('درباره افزونه',ONETERMPOLICY_TD),
            'manage_options',
            'oneTermsPolicy_info',
            array($this,'page_info_content')
        );
    }
    public function page_option_content()
    {
        if(file_exists(ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Option.php')){
            include ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Option.php';
        }
    }

    public function privacy_Question_Content()
    {
            if(file_exists(ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Question.php')){
                include ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Question.php';
            }
    }

    public function page_validate_option_content()
    {
        if(file_exists(include ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Validate-Option.php')){
            include ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Validate-Option.php';
        }
    }

    public function page_info_content()
    {
        if(file_exists(include ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Info.php')){
            include ONETERMPOLICY_ADMIN_PAGES_PATH.'/Page-Info.php';
        }
    }
}