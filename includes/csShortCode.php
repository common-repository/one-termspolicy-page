<?php


namespace oneTermsPolicy;

if (!defined('ABSPATH')) exit();

class csShortCode
{
    protected $OneQuery;

    public function __construct()
    {
        $this->OneQuery = new csQuery();
    }

    public function register()
    {
        add_shortcode(ONETERMPOLICY_SHORTCODE, array($this, 'onetermspolicy_handle'));
    }

    public function onetermspolicy_handle($attr)
    {
        if (isset($attr['page'])) {
            $attrPage = sanitize_text_field($attr['page']);
            $arg = array(
                'name' => $attrPage,
                'post_type' => 'one-termspolicy_page'
            );
            $curentPost = get_posts($arg);
            if (csPresentation::Cheak_empty_isset($curentPost)) {
                $opS = get_option(ONETERMPOLICY_OPTION_PREFIX . '_option');
                $opS = isset($opS['BlogOption']) ? $opS['BlogOption'] : '';
                $opS = base64_decode($opS);
                $Pcnt = $curentPost[0]->post_content;
                $Pcnt .= $opS;
                return $Pcnt;
            }
            return '';
        }
        else {
            $attrString = implode(",", $attr);
            $attrString = sanitize_text_field($attrString);
            $onetermspolicy_option = get_option(ONETERMPOLICY_DB_OPTION);
            $defultOption = $this->OneQuery->wp_get_option();
            if (csPresentation::Cheak_empty_isset($onetermspolicy_option) || csPresentation::Cheak_empty_isset($defultOption)) {
                switch ($attrString) {
                    case 'SiteName':
                        if (csPresentation::Cheak_empty_isset($onetermspolicy_option['SiteName'])) {
                            return $onetermspolicy_option['SiteName'];
                        } else {
                            return $defultOption['SiteName'];
                        }
                        break;
                    case 'SiteUrl':
                        if (csPresentation::Cheak_empty_isset($onetermspolicy_option['SiteUrl'])) {
                            return $onetermspolicy_option['SiteUrl'];
                        } else {
                            return $defultOption['SiteUrl'];
                        }
                        break;
                    case 'SiteCompany':
                        if (csPresentation::Cheak_empty_isset($onetermspolicy_option['CompanyName'])) {
                            return $onetermspolicy_option['CompanyName'];
                        } else {
                            return $defultOption['CompanyName'];
                        }
                        break;
                    case 'SiteType':
                        if (csPresentation::Cheak_empty_isset($onetermspolicy_option['SiteType'])) {
                            return $onetermspolicy_option['SiteType'];
                        }
                        break;
                    case 'SiteCity':
                        if (csPresentation::Cheak_empty_isset($onetermspolicy_option['SiteCity'])) {
                            return $onetermspolicy_option['SiteCity'];
                        }
                        break;
                    default:
                        break;
                }
            }
        }
    }

    public function getPost_ShortCode($post_id)
    {
        if (csPresentation::Cheak_empty_isset($post_id)) {
            $curentPost = get_post($post_id);
            $postContetn = $curentPost->post_content;
        }
    }

}