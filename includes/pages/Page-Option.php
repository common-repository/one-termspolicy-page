<?php

if (!defined('ABSPATH')) exit();
$db_one_option = false;
if (method_exists('oneTermsPolicy\csQuery', 'one_get_option_page')) {
    $OnePageOptions = $this->oneQuery->one_get_option_page();
    if (\oneTermsPolicy\csPresentation::Cheak_empty_isset($OnePageOptions)) {
        $db_one_option = true;
    }
}
?>

<div class="wrap">
    <div class="onetermOptionHeader">
        <h2 class="nav-tab-wrapper">
            <a href="?post_type=one-termspolicy_page&page=oneTermsPolicy_option" class="nav-tab nav-tab-active"><?php _e('اطلاعات عمومی',ONETERMPOLICY_TD); ?></a>
            <a href="?post_type=one-termspolicy_page&page=oneTermsPolicy_Validate_option" class="nav-tab"><?php _e('تنظیمات پیشرفته',ONETERMPOLICY_TD);?></a>
        </h2>
        <h1><?php _e('تنظیمات قوانین و خط مشی', ONETERMPOLICY_TD) ?></h1>
    </div>
    <div class="onetermoptionPage">
        <br>
        <form id="frm_option_page" action="" type="post">
            <table>
                <tbody>
                <tr>
                    <th><?php esc_html_e('نام وبسایت', ONETERMPOLICY_TD); ?></th>
                    <td>
                        <input type="text" name="opSiteName"
                               value="<?php $db_one_option ? esc_attr_e($OnePageOptions['SiteName']) : '' ?>">
                        <p>ShortCode: [onetermspolicy SiteName]</p>
                    </td>
                </tr>
                <tr>
                    <th><?php esc_html_e('آدرس وبسایت', ONETERMPOLICY_TD); ?></th>
                    <td>
                        <input type="text" name="opSiteUrl"
                               value="<?php echo $db_one_option ? esc_url($OnePageOptions['SiteUrl']) : '' ?>">
                        <p>ShortCode: [onetermspolicy SiteUrl]</p>
                    </td>
                </tr>
                <tr>
                    <th><?php esc_html_e('نام اداره کننده (شخص یا شرکت) وبسایت', ONETERMPOLICY_TD); ?></th>
                    <td>
                        <input type="text" name="opCompanyName"
                               value="<?php $db_one_option ? esc_attr_e($OnePageOptions['CompanyName']) : '' ?>">
                        <p>ShortCode: [onetermspolicy SiteCompany]</p>
                    </td>
                </tr>
                <tr>
                    <th><?php esc_html_e('موضوع وبسایت', ONETERMPOLICY_TD); ?></th>
                    <td>
                        <input type="text" name="opSiteType"
                               value="<?php $db_one_option ? esc_attr_e($OnePageOptions['SiteType']) : '' ?>">
                        <p>ShortCode: [onetermspolicy SiteType]</p>
                    </td>
                </tr>
                <tr>
                    <th><?php esc_html_e('نام شهری که فعالیت می کنید', ONETERMPOLICY_TD); ?></th>
                    <td>
                        <input type="text" name="opSiteCity"
                               value="<?php $db_one_option ? esc_attr_e($OnePageOptions['SiteCity']) : '' ?>">
                        <p>ShortCode: [onetermspolicy SiteCity]</p>
                    </td>
                </tr>
                </tbody>
            </table>
            <p>
                <input type="submit" class="button-primary option_sub"
                       value="<?php esc_attr_e('ثبت اطلاعات', ONETERMPOLICY_TD); ?>">
                <img src="<?php echo esc_url(admin_url('/images/wpspin_light.gif')); ?>" class="waiting"
                     id='one-loading' style="display:none">
            </p>
            <p class="responseAjax"></p>
        </form>
    </div>
</div>
