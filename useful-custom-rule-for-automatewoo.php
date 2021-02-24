<?php
/**
 * Plugin Name:     Useful Custom Rule For Automatewoo
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     useful-custom-rule-for-automatewoo
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Useful_Custom_Rule_For_Automatewoo
 */

// Your code starts here.



if ( !function_exists( 'add_action' ) ) {
	echo __('Hi there!  I\'m just a plugin, not much I can do when called directly.', 'useful-custom-rule-for-automatewoo');
	exit;
}

/* Plugin Constants */
if (!defined('USEFUL_CUSTOM_RULE_FOR_AUTOMATEWOO_URL')) {
    define('USEFUL_CUSTOM_RULE_FOR_AUTOMATEWOO_URL', plugin_dir_url(__FILE__));
}

if (!defined('USEFUL_CUSTOM_RULE_FOR_AUTOMATEWOO_PLUGIN_PATH')) {
    define('USEFUL_CUSTOM_RULE_FOR_AUTOMATEWOO_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

class Useful_custom_rule_for_automatewoo {
    function __construct(){
        add_action('plugins_loaded', array( $this,'check_some_other_plugin'), 10 );
		add_filter( 'automatewoo/variables', array( $this ,'custom_variable' ) );
		add_filter('automatewoo/rules/includes', array( $this ,'custom_rules' ) );
    } 
    
    public function check_some_other_plugin() {
		if ( ! function_exists( 'AW' ) ) {
			add_action( 'admin_notices', function() {				
				echo '<div class="error"><p><strong>' . esc_html__( 'Useful Custom Rule for Automatewoo plugin require AutomateWoo Plugin installed / activated', 'useful-custom-rule-for-automatewoo' ) . '</strong><code>Link:- https://wordpress.org/plugins/block-lab/</code></p></div>';
			} );
			return;
		}
    }
        
	/** Added the Subscription Period Veriable */
	
	public function custom_variable( $variables ) {
		$variables['subscription']['period'] = require_once USEFUL_CUSTOM_RULE_FOR_AUTOMATEWOO_PLUGIN_PATH.'/automatewoo/includes/variables/subscription-period.php';
		return $variables;
	}

	
	public function custom_rules( $rules ) {
		$rules['subscription_serialized_meta'] = require_once USEFUL_CUSTOM_RULE_FOR_AUTOMATEWOO_PLUGIN_PATH.'/automatewoo/includes/rules/Subscription_serialized_meta.php'; // absolute path to rule
		return $rules;
	}
}

$Useful_custom_rule_for_automatewoo = new Useful_custom_rule_for_automatewoo();