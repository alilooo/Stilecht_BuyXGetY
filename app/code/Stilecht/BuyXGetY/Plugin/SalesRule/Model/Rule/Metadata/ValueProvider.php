<?php
/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

namespace Stilecht\BuyXGetY\Plugin\SalesRule\Model\Rule\Metadata;

class ValueProvider
{
    /**
     * Add custom "Buy X Get Y Cheapest Free" action to the dropdown and configure fields
     *
     * @param \Magento\SalesRule\Model\Rule\Metadata\ValueProvider $subject
     * @param array $result
     * @return array
     */
    public function afterGetMetadataValues(
        \Magento\SalesRule\Model\Rule\Metadata\ValueProvider $subject,
        $result
    ) {
        // Add our custom action type to dropdown
        if (!isset($result['simple_action'])) {
            $result['simple_action'] = [];
        }
        if (!isset($result['simple_action']['options'])) {
            $result['simple_action']['options'] = [];
        }
        $result['simple_action']['options'][] = [
            'label' => __('Buy X Get Y Cheapest Free'),
            'value' => 'buy_x_get_y_cheapest_free'
        ];

        // Ensure UI component configuration
        if (!isset($result['simple_action']['arguments']['data']['config'])) {
            $result['simple_action']['arguments']['data']['config'] = [];
        }
        $result['simple_action']['arguments']['data']['config']['componentType'] = 'select';
        $result['simple_action']['arguments']['data']['config']['component'] = 'Magento_Ui/js/form/element/select';
        $result['simple_action']['arguments']['data']['config']['formElement'] = 'select';
        $result['simple_action']['arguments']['data']['config']['dataType'] = 'text';

        // Configure discount_step for our action type
        if (!isset($result['discount_step'])) {
            $result['discount_step'] = [];
        }
        if (!isset($result['discount_step']['fields'])) {
            $result['discount_step']['fields'] = [];
        }
        $result['discount_step']['fields']['buy_x_get_y_cheapest_free'] = [
            'label' => __('Buy X Products'),
            'value' => 1
        ];

        // Configure discount_amount for our action type
        if (!isset($result['discount_amount'])) {
            $result['discount_amount'] = [];
        }
        if (!isset($result['discount_amount']['fields'])) {
            $result['discount_amount']['fields'] = [];
        }
        $result['discount_amount']['fields']['buy_x_get_y_cheapest_free'] = [
            'label' => __('Get Y Free (Cheapest)'),
            'value' => 1
        ];

        return $result;
    }
} 