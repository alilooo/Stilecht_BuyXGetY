<?php
/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

namespace Stilecht\BuyXGetY\Plugin\SalesRule\Model\Rule\Action;

use Magento\Framework\Data\OptionSourceInterface;

class SimpleActionOptionsProviderPlugin
{
    /**
     * Add custom "Buy X Get Y Cheapest Free" action to the available actions
     *
     * @param \Magento\SalesRule\Model\Rule\Action\SimpleActionOptionsProvider $subject
     * @param array $result
     * @return array
     */
    public function afterToOptionArray(
        \Magento\SalesRule\Model\Rule\Action\SimpleActionOptionsProvider $subject,
        array $result
    ) {
        // Add our custom discount type
        $result[] = [
            'label' => __('Buy X Get Y Cheapest Free'),
            'value' => 'buy_x_get_y_cheapest_free'
        ];
        
        return $result;
    }
} 