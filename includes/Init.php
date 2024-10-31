<?php

namespace oneTermsPolicy;

if (!defined('ABSPATH')) exit();


class Init
{
    public static function get_service()
    {
        return [
            \oneTermsPolicy\csQuestion::class,
            \oneTermsPolicy\csPostType::class,
            \oneTermsPolicy\csMenu::class,
            \oneTermsPolicy\csStyleScript::class,
            \oneTermsPolicy\csAjax::class,
            \oneTermsPolicy\csShortCode::class,
            \oneTermsPolicy\csBuild::class,
            \oneTermsPolicy\csValidate::class,
            \oneTermsPolicy\csMetaBox::class
        ];
    }

    public static function register_service()
    {
        foreach (self::get_service() as $class) {
            $service = new $class;
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
}