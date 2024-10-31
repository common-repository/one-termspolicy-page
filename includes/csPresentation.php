<?php

namespace oneTermsPolicy;

if(!defined('ABSPATH'))exit();

class csPresentation
{
    public static function Cheak_empty_isset($var, $var2 = null)
    {
        if (!$var2) {
            if ($var && isset($var) && !empty($var) && !is_wp_error($var)) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($var && isset($var) && !empty($var) && !is_wp_error($var) && $var2 && isset($var2) && !empty($var2) && !is_wp_error($var2)) {
                return true;
            } else {
                return false;
            }
        }
    }
}