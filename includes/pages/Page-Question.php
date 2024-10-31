<?php
if (!defined('ABSPATH')) exit();
$objQuestion = new \oneTermsPolicy\csQuestion();
$objPresentation = new \oneTermsPolicy\csPresentation();
$Saniti_Get_Page = sanitize_text_field($_GET['page']);
if ($objPresentation->Cheak_empty_isset($Saniti_Get_Page)) {
    $fromPage = '';
    switch ($Saniti_Get_Page) {
        case 'oneTermsPolicy_StoreShop' :
            $Question = $objQuestion->StoreQuestion();
            $fromPage = 'StoreQuestion';
            break;
        case 'oneTermsPolicy_Company':
            $Question = $objQuestion->CompanyQuestion();
            $fromPage = 'CompanyQuestion';
            break;
        case 'oneTermsPolicy_Personal':
            $Question = $objQuestion->PersonalQuestion();
            $fromPage = 'PersonalQuestion';
            break;
        case 'oneTermsPolicy_Privacy':
            $Question = $objQuestion->PrivacyQuestion();
            $fromPage = 'PrivacyQuestion';
            break;
        default:
            break;
    }
}
?>

<div class="wrap">
    <div class="onetermOptionHeader">
        <h1><?php _e('ایجاد قوانین', ONETERMPOLICY_TD) ?></h1>
    </div>
    <div class="Question">
        <?php if ($objPresentation->Cheak_empty_isset($Question)) : ?>
            <form id="frmQuestion" action="">
                <table>
                    <tbody>
                    <?php if (\oneTermsPolicy\csPresentation::Cheak_empty_isset($Question['val']['field'])): ?>
                        <?php foreach ($Question['val']['field'] as $key => $item): ?>
                            <tr>
                                <th><?php esc_html_e($item['key']); ?></th>
                                <td>
                                    <input type="text" name="<?php esc_attr_e("{$Question['key']}[field][{$key}]") ?>"
                                           value="<?php esc_attr_e($item['val']); ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($Question['val']['radio'])): ?>
                        <?php foreach ($Question['val']['radio'] as $key => $item): ?>
                            <tr>
                                <th><?php esc_html_e($item['key']); ?></th>
                                <td>
                                    <input type="radio" value="true"
                                           name="<?php esc_html_e( "{$Question['key']}[radio][{$key}]" );?>"
                                           id=""><?php esc_html_e('بله', ONETERMPOLICY_TD); ?>
                                    <input type="radio" value="false"
                                           name="<?php esc_html_e( "{$Question['key']}[radio][{$key}]"); ?>"
                                           id=""><?php esc_html_e('خیر', ONETERMPOLICY_TD); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($Question['val']['checkbox'])): ?>
                        <?php foreach ($Question['val']['checkbox'] as $key => $item): ?>
                            <tr>
                                <th><?php esc_html_e($item['key']);  ?></th>
                                <td>
                                    <?php $i = 0 ?>
                                    <?php foreach ($item['val'] as $checkbox) : ?>
                                        <?php $i++ ?>
                                        <input type="checkbox" name="<?php esc_attr_e
                                        ("{$Question['key']}[checkbox][{$key}][{$i}]"); ?>" value="<?php esc_attr_e
                                        ($checkbox); ?>"><span><?php esc_html_e($checkbox); ?></span>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <p>
                    <input type="hidden" name="fromPage" value="<?php esc_attr_e($fromPage); ?>">
                    <input type="submit" name="frmQuestion" id="frmQuestion" class="button-primary"
                           value="<?php _e('ثبت اطلاعات', ONETERMPOLICY_TD); ?>">
                    <img src="<?php echo esc_url(admin_url('/images/wpspin_light.gif')); ?>" class="waiting"
                         id='one-loading' style="display:none">
                </p>
                <p class="responseAjax"></p>
            </form>
        <?php endif; ?>
    </div>
</div>
