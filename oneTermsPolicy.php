<?php

/**
 * Terms Policy Management
 *
 * @package           one-TermPolicy
 * @author            onemohsen
 * @copyright         2019 onemohsen
 * @license           GPL-2.0-or-later
 *
 *
 * @wordpress-plugin
 * Plugin Name:       Terms And Policy Vindad
 * Description:       Without restrictions and automatically create the Terms and Policy on WordPress .
 * Version:           0.1.1
 * Author:            Vindad
 * Author URI:        http://vindad.com
 * Text Domain:       one-TermsPolicy
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('ABSPATH')) {
    exit();
}

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

define('ONETERMPOLICY_ADMIN_PAGES_PATH', plugin_dir_path(__FILE__) . 'includes/pages');
define('ONETERMPOLICY_ADMIN_STYLESCRIPT_URL', plugin_dir_url(__FILE__) . 'admin');
define('ONETERMPOLICY_FRONTEND_STYLESCRIPT_URL', plugin_dir_url(__FILE__) . 'public');
define('ONETERMPOLICY_FRONTEND_STYLESCRIPT_PATH', plugin_dir_path(__FILE__) . 'public');
define('ONETERMPOLICY_TD','one-TermsPolicy');
define('ONETERMPOLICY_SHORTCODE','onetermspolicy');
define('ONETERMPOLICY_OPTION_PREFIX','_'.ONETERMPOLICY_TD);
define('ONETERMPOLICY_DB_OPTION',ONETERMPOLICY_OPTION_PREFIX . '_option');
define('ONETERMPOLICY_DB_STORE',ONETERMPOLICY_OPTION_PREFIX . '_StoreOption');
define('ONETERMPOLICY_DB_COMPANY',ONETERMPOLICY_OPTION_PREFIX. '_CompanyOption');
define('ONETERMPOLICY_DB_PERSONAL',ONETERMPOLICY_OPTION_PREFIX. '_PersonalOption');
define('ONETERMPOLICY_DB_PRIVACY',ONETERMPOLICY_OPTION_PREFIX. '_PrivacyOption');
//define('ONETERMPOLICY_POSTTYPE',ONETERMPOLICY_TD.'_page');
define('ONETERMPOLICY_POSTTYPE','one-termspolicy_page');
if ( ! defined( 'ONETERMPOLICY_ROOT' ) ) {
    define( 'ONETERMPOLICY_ROOT', __FILE__ );
}
if ( ! defined( 'ONETERMPOLICY_ROOT_DIR' ) ) {
    define( 'ONETERMPOLICY_ROOT_DIR', plugin_dir_path( ONETERMPOLICY_ROOT ) );
}
if ( get_locale() == 'fa_IR' ) {
    load_textdomain( ONETERMPOLICY_TD, ONETERMPOLICY_ROOT_DIR . 'languages/'.ONETERMPOLICY_TD.'-fa_IR.mo' );
}
if (class_exists('\\oneTermsPolicy\Init')) {
    \oneTermsPolicy\Init::register_service();
}