<?php


namespace oneTermsPolicy;
if (!defined('ABSPATH')) exit();

class csQuery
{
    public function register()
    {

    }

    public function wp_get_option()
    {
        $blogname = get_option('blogname');
        return $Options = array(
            'SiteName' => $blogname,
            'SiteUrl' => get_option('siteurl'),
            'CompanyName' => $blogname
        );
    }

    public function one_get_option_page()
    {
        $key = '_' . ONETERMPOLICY_TD . '_option';
        $Option = get_option($key);
        if (csPresentation::Cheak_empty_isset($Option)) {
            return $Option;
        }
    }

    public function get_published_TermsPolicy_Post()
    {
        $arg = array(
            'post_type' => ONETERMPOLICY_POSTTYPE,
            'post_status' => 'publish'
        );
        $obj = new \WP_Query($arg);
        $objPosts = $obj->posts;
        return $objPosts;
    }

    public function get_published_TermsPolicy_Post_IDs()
    {
        $Posts = $this->get_published_TermsPolicy_Post();
        $PostIds = array();
        foreach ($Posts as $post) {
            array_push($PostIds, $post->ID);
        }
        return $PostIds;
    }
}