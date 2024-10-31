<?php


namespace oneTermsPolicy;

if (!defined('ABSPATH')) exit();

class csQuestion
{
    public function register()
    {

    }

    /*public function Which_Question_Will_Be_Show($slug)
    {
        switch ($slug) {
            case 'oneTermsPolicy_StoreShop' :
                return $this->StoreQuestion();
                break;
            case 'oneTermsPolicy_Company':
                return $this->CompanyQuestion();
                break;
            case 'oneTermsPolicy_Personal':
                return $this->PersonalQuestion();
                break;
            case 'oneTermsPolicy_Privacy':
                return $this->PrivacyQuestion();
                break;
            default:
                return;
                break;
        }
    }*/

    public function StoreQuestion()
    {
        $Question = array(
            'key' => 'StoreQuestion',
            'val' => array(
                'field' => array(
                    'field1' => array(
                        'key' => __('نام سایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteName]')
                    ),
                    'field2' => array(
                        'key' => __('نام اداره کننده (شخص یا شرکت) وبسایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteCompany]')
                    ),
                    'field3' => array(
                        'key' => __('آدرس سایت چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteUrl]')
                    ),
                    'field4' => array(
                        'key' => __('موضوع وبسایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteType]')
                    ),
                    'field5' => array(
                        'key' => __('شما در چه شهری فعالیت می‌کنید؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteCity]')
                    ),
                    'field6' => array(
                        'key' => __('شما از چه درگاه بانکی استفاده میکنید؟', ONETERMPOLICY_TD),
                        'val' => ''
                    ),
                    'field7' => array(
                        'key' => __('ایمیل پشتیبانی سایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => ''
                    )
                ),
                'radio' => array(
                    'radio1' => array(
                        'key' => __('آیا محصولات شما شامل ضمانت(گارانتی) میباشد؟', ONETERMPOLICY_TD),
                        'val' => ''
                    ),
                    'radio2' => array(
                        'key' => __('آیا سایت شما ارسال و تحویل سفارش نیز انجام می‌دهد؟', ONETERMPOLICY_TD),
                        'val' => ''
                    ),
                )
            )
        );

        return $Question;
    }

    public function PersonalQuestion()
    {
        $Question = array(
            'key' => 'PersonalQuestion',
            'val' => array(
                'field' => array(
                    'field1' => array(
                        'key' => __('نام سایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteName]')
                    ),
                    'field2' => array(
                        'key' => __('نام اداره کننده (شخص یا شرکت) وبسایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteCompany]')
                    ),
                    'field3' => array(
                        'key' => __('آدرس سایت چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteUrl]')
                    ),
                    'field4' => array(
                        'key' => __('موضوع وبسایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteType]')
                    ),
                    'field5' => array(
                        'key' => __('شما در چه شهری فعالیت می‌کنید؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteCity]')
                    )
                )
            )
        );
        return $Question;
    }

    public function CompanyQuestion()
    {
        $Question = array(
            'key' => 'CompanyQuestion',
            'val' => array(
                'field' => array(
                    'field1' => array(
                        'key' => __('نام سایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteName]')
                    ),
                    'field2' => array(
                        'key' => __('نام اداره کننده (شخص یا شرکت) وبسایت شما چیست؟', ONETERMPOLICY_TD),
                        'val' => do_shortcode('[onetermspolicy SiteCompany]')
                    ),
                    'field3' => array(
                        'key' => __('شما از چه درگاه بانکی استفاده میکنید؟', ONETERMPOLICY_TD),
                        'val' => ''
                    )
                ),
                'checkbox' => array(
                    'checkbox1' => array(
                        'key' => __('پرداخت ها به چه شکلی انجام میشود؟', ONETERMPOLICY_TD),
                        'val' => array(
                            __('درگاه آنلاین', ONETERMPOLICY_TD),
                            __('پرداخت نقدی', ONETERMPOLICY_TD),
                            __('چک', ONETERMPOLICY_TD)
                        )
                    )
                )
            )
        );
        return $Question;
    }

    /*    public function SampelQuestion()
        {
            $Question = array(
                'key'=>'StoreQuestion',
                'val'=>array(
                    'field' => array(
                        'field1' => array(
                            'key' => 'تست خصوصی سوال فیلد 1 ؟',
                            'val' => ''
                        ),
                        'field2' => array(
                            'key' => 'تست  خصوصی سوال فیلد 2 ؟',
                            'val' => ''
                        ),
                        'field3' => array(
                            'key' => 'تست سوال فیلد 3 ؟',
                            'val' => ''
                        )
                    ),
                    'radio' => array(
                        'radio1' => array(
                            'key' => 'تست سوال رادیو 1 ؟',
                            'val' => ''
                        ),
                        'radio2' => array(
                            'key' => 'تست سوال رادیو 2 ؟',
                            'val' => ''
                        ),
                    ),
                    'checkbox' => array(
                        'checkbox1' => array(
                            'key' => 'تست سوال چک باکس 1 ؟',
                            'val' => array(
                                'چک 1',
                                'چک 2',
                                'چک 3',
                                'چک 4',
                            )
                        ),
                        'checkbox2' => array(
                            'key' => 'تست سوال چک باکس 2 ؟',
                            'val' => array(
                                'چک 1',
                                'چک 2',
                                'چک 3'
                            )
                        ),
                    )
                )
            );
        }*/
}