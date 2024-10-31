<?php
if (!defined('ABSPATH')) exit();
include(ABSPATH . 'wp-admin/admin-header.php');
$linkPage = admin_url('edit.php?post_type=one-termspolicy_page&page=');
?>
    <div class="wrap">
        <div class="choiceTermsPolicy">
            <h1><?php _e('انتخاب نوع شرایط و قوانین :', ONETERMPOLICY_TD); ?></h1>
            <br>
            <div class="boxTerm">
                <h2><?php _e('شرایط و قوانین سایت فروشگاه کالا', ONETERMPOLICY_TD) ?></h2>
                <p><?php _e('در صورتی که مایل به ایجاد قوانین و شرایط مربوط به فروشگاه خود می باشید بر روی لینک زیر کلیک نمایید', ONETERMPOLICY_TD); ?></p>
                <a href=<?php echo "{$linkPage}oneTermsPolicy_StoreShop" ?> class="button-primary"><?php _e('انتخاب', ONETERMPOLICY_TD); ?></a>
            </div>
            <div class="boxTerm">
                <h2><?php _e('شرایط و قوانین سایت فروشگاه خدماتی', ONETERMPOLICY_TD) ?></h2>
                <p><?php _e('در صورتی که مایل به ایجاد قوانین و شرایط مربوط به سایت شرکتی خود می باشید بر روی لینک زیر کلیک نمایید', ONETERMPOLICY_TD); ?></p>
                <a href=<?php echo "{$linkPage}oneTermsPolicy_Company" ?> class="button-primary"><?php _e('انتخاب', ONETERMPOLICY_TD); ?></a>
            </div>
            <div class="boxTerm">
                <h2><?php _e('شرایط و قوانین سایت شخصی', ONETERMPOLICY_TD) ?></h2>
                <p><?php _e('در صورتی که مایل به ایجاد قوانین و شرایط مربوط به سایت شخصی خود خود می باشید بر روی لینک زیر کلیک نمایید', ONETERMPOLICY_TD); ?></p>
                <a href=<?php echo "{$linkPage}oneTermsPolicy_Personal" ?> class="button-primary"><?php _e('انتخاب', ONETERMPOLICY_TD); ?></a>
            </div>
            <!--<div class="boxTerm">
                <h2><?php /*_e('حریم خصوصی', ONETERMPOLICY_TD) */?></h2>
                <p><?php /*_e('در صورتی که مایل به ایجاد قوانین و شرایط مربوط به حریم خصوصی خود می باشید بر روی لینک زیر کلیک نمایید', ONETERMPOLICY_TD); */?></p>
                <a href=<?php /*echo "{$linkPage}oneTermsPolicy_Privacy" */?> class="button-primary"><?php /*_e('انتخاب', ONETERMPOLICY_TD); */?></a>
            </div>-->
        </div>
    </div>
<?php
include(ABSPATH . 'wp-admin/admin-footer.php');
