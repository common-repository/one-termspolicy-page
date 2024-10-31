<?php


namespace oneTermsPolicy;

if(!defined('ABSPATH'))exit();

class csMetaBox
{
    public function register()
    {
        add_action('add_meta_boxes', array($this, 'shortcode_meta_boxes'));
    }

    public function shortcode_meta_boxes($post_type)
    {
        $types = array(ONETERMPOLICY_POSTTYPE);

        if (in_array($post_type, $types)){
            add_meta_box(
                'shortcode_meta_boxes',
                __('شورت کد',ONETERMPOLICY_TD),
                array($this,'shortcode_meta_boxes_handler'),
                null,
                'side'
            );
        }
    }

    public function shortcode_meta_boxes_handler($post)
    {
        $obj = new csPostType();
        $obj->custom_post_type_column('short_code',$post->ID);
    }
}