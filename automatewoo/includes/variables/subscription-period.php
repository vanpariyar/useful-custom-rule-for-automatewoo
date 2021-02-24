<?php


class SubscriptionPeriodVariable extends AutomateWoo\Variable {

    protected $name = 'subscription.period';

    public $use_fallback = false;

    function load_admin_details() {
        $this->description = __( 'Outputs the Subscription Period', 'automatewoo');
        parent::load_admin_details();
    }

    /**
     * @param $subscription \WC_Subscription
     * @param $parameters
     * @return string
     */
    public function get_value( $subscription, $parameters )
    {
        $subscriptionId = $subscription->get_id();
        if ( empty( $subscription ) ) {
            return false;
        }
        if (wcs_is_subscription($subscription)) {
            $subscriptionInterval = get_post_meta( $subscriptionId, '_billing_interval', true );
            $subscriptionPeriod = get_post_meta( $subscriptionId, '_billing_period', true );

            $subscriptionInterval = wcs_get_subscription_period_interval_strings($subscriptionInterval);

            return $subscriptionInterval .' '. $subscriptionPeriod;
        }
        return false;
    }
}
return new SubscriptionPeriodVariable();
