<?php
/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

namespace Stilecht\BuyXGetY\Plugin\SalesRule\Model\Rule\Metadata;

class ValueProvider
{
    /**
     * Add custom "Buy X Get Y Cheapest Free" action to the dropdown
     *
     * @param \Magento\SalesRule\Model\Rule\Metadata\ValueProvider $subject
     * @param array $result
     * @return array
     */
    public function afterGetMetadataValues(
        \Magento\SalesRule\Model\Rule\Metadata\ValueProvider $subject,
        $result
    ) {
        if (!isset($result['simple_action'])) {
            $result['simple_action'] = [];
        }
        
        if (!isset($result['simple_action']['options'])) {
            $result['simple_action']['options'] = [];
        }
        
        // Add our custom action type
        $result['simple_action']['options'][] = [
            'label' => __('Buy X Get Y Cheapest Free'),
            'value' => 'buy_x_get_y_cheapest_free'
        ];
        
        // Ensure the component type is set
        if (!isset($result['simple_action']['arguments']['data']['config'])) {
            $result['simple_action']['arguments']['data']['config'] = [];
        }
        
        // Set required UI component configuration
        $result['simple_action']['arguments']['data']['config']['componentType'] = 'select';
        $result['simple_action']['arguments']['data']['config']['component'] = 'Magento_Ui/js/form/element/select';
        $result['simple_action']['arguments']['data']['config']['formElement'] = 'select';
        $result['simple_action']['arguments']['data']['config']['dataType'] = 'text';
        
        return $result;
    }
} 