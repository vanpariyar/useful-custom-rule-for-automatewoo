<?php

namespace AutomateWoo\Rules;

defined( 'ABSPATH' ) || exit;

/**
 * @class Subscription_Meta
 */
class Subscription_Srialized_Meta extends Abstract_Meta {

	/** @var string */
	public $data_item = 'subscription';

	/**
	 * Init the rule
	 */
	public function init() {
		$this->title = __( 'Subscription - Custom Serealized Field', 'automatewoo' );
        $this->compare_types = [
			'is' => __( 'is', 'automatewoo' ),
			'is_not' => __( 'is not', 'automatewoo' )
		];
	}


	/**
	 * Validate the rule based on options set by a workflow
	 *
	 * @param \WC_Subscription $subscription
	 * @param string           $compare_type
	 * @param array            $value_data
	 *
	 * @return bool
	 */
	public function validate( $subscription, $compare_type, $value_data ) {

		$value_data = $this->prepare_value_data( $value_data );

		if ( ! is_array( $value_data ) ) {
			return false;
		}

        $combined_keys = explode( "#", $value_data['key'] );
        $serealized_data = $subscription->get_meta( $combined_keys[0] , true );

        if ( ! array_key_exists( $combined_keys[1], $serealized_data ) ){
            return false;
        }    

        //$this->validate_meta( $serealized_data[$combined_keys[1]] , $compare_type, $value_data['value'] );

		return $this->validate_meta( $serealized_data[$combined_keys[1]] , $compare_type, $value_data['value'] );
	}
}
return new Subscription_Srialized_Meta(); // must return a new instance
