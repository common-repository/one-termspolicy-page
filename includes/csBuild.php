<?php


namespace oneTermsPolicy;

if (!defined('ABSPATH')) exit();

class csBuild
{
    public function register()
    {
        add_filter('get_pages', array($this, 'update_setting_privacy_page'), 10, 2);
        add_action('admin_init', array($this, 'Run_After_Plugin_Loaded'));
    }

    public function GetBuildStore($Question)
    {
        ob_start();
        include ONETERMPOLICY_ADMIN_PAGES_PATH . '/Build/Store.php';
        $string = ob_get_clean();
        return $string;
    }

    public function GetBuildPersonal($Question)
    {
        ob_start();
        include ONETERMPOLICY_ADMIN_PAGES_PATH . '/Build/Personal.php';
        $string = ob_get_clean();
        return $string;
    }

    public function GetBuildCompany($Question)
    {
        ob_start();
        include ONETERMPOLICY_ADMIN_PAGES_PATH . '/Build/Company.php';
        $string = ob_get_clean();
        return $string;
    }

    public function update_setting_privacy_page($pages, $r)
    {
        if (!isset($r['name']) || !in_array($r['name'], array(
                'wp_page_for_privacy_policy',
                'page_for_privacy_policy',
                'woocommerce_terms_page_id'
            ))) {
            return $pages;
        }
        $r['post_type'] = 'one-termspolicy_page';
        $r['name'] = 'one-termspolicy_page_for_privacy_policy';
        $autoterms_pages = get_pages($r);
        return array_merge($pages, $autoterms_pages);
    }

    public function Run_After_Plugin_Loaded()
    {
        $checkRun = 1;
        if (get_option(ONETERMPOLICY_OPTION_PREFIX . '_Activate') == '') {
            $blogname = get_option('blogname');
            $Options = array(
                'SiteName' => $blogname,
                'SiteUrl' => get_option('siteurl'),
                'CompanyName' => $blogname,
                'BlogOption' => 'PHAgc3R5bGU9InRleHQtYWxpZ246IGxlZnQ7bWFyZ2luOjMwcHggMHB4OyI+DQo8c21hbGw+DQrZgtiv2LHYqiDar9ix2YHYqtmHINi02K/ZhyDYp9iyINmI2KjYs9in24zYqiA8YSBocmVmPSJodHRwczovL3ZpbmRhZC5jb20vIj7ZiNuM2YbYr9in2K88L2E+DQo8L3NtYWxsPg0KPC9wPg==',
                'SiteCity' => '',
                'SiteType' => ''
            );
            $val_validate_option = array(
                'SignIn' => array(
                    'IsCheck' => false,
                    'IdPage' => ''
                ),
                'SignUp' => array(
                    'IsCheck' => false,
                    'IdPage' => ''
                )
            );
            update_option(ONETERMPOLICY_OPTION_PREFIX . '_option', $Options);
            update_option(ONETERMPOLICY_OPTION_PREFIX . '_Validate', $val_validate_option);
            $checkRun++;
        }
        if ($checkRun == 2) {
            update_option(ONETERMPOLICY_OPTION_PREFIX . '_Activate', date("Ymd-hi"));
        }
    }
}