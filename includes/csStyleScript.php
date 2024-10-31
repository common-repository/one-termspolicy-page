<?php


namespace oneTermsPolicy;

if(!defined('ABSPATH'))exit();

class csStyleScript
{
    public function register()
    {
        add_action('admin_enqueue_scripts',array($this,'enq_oneTermsPolicy'));
        add_action('init',array($this,'localize'));
    }

    public function enq_oneTermsPolicy()
    {
        $Curent_Screen = get_current_screen();

        if($Curent_Screen->post_type === 'one-termspolicy_page'){
            /*Style*/
            wp_enqueue_style('oneTermsPolicy-adm-Css',ONETERMPOLICY_ADMIN_STYLESCRIPT_URL.'/css/styleadmin.css');

            /*Scripts*/
            /*wp_enqueue_script(
                'jQuery341',
                ONETERMPOLICY_ADMIN_STYLESCRIPT_URL.'/js/jquery-3.4.1.min.js',
                array(),
                '3.4.1',
                true
            );*/
            wp_enqueue_script('oneTermsPolicy-adm-Js');
            wp_enqueue_script('jquery.validate-adm-Js',ONETERMPOLICY_ADMIN_STYLESCRIPT_URL.'/js/jquery.validate.min.js','jquery','980720',true);
            wp_enqueue_script('additional-methods-adm-Js',ONETERMPOLICY_ADMIN_STYLESCRIPT_URL.'/js/additional-methods.min.js','jquery','980720',true);
        }
    }

    public function localize()
    {
        wp_register_script('oneTermsPolicy-adm-Js',ONETERMPOLICY_ADMIN_STYLESCRIPT_URL.'/js/scriptadmin.js','jquery','980720',true);
        wp_localize_script('oneTermsPolicy-adm-Js','oneTermsPolicy_obj',array('optin_page'=>wp_create_nonce('oneTermsPolicy_Option_page_ajax')));
    }
    
}