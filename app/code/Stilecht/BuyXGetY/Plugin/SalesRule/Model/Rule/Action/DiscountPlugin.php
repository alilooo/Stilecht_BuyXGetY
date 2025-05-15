<?php
/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

namespace Stilecht\BuyXGetY\Plugin\SalesRule\Model\Rule\Action;

class DiscountPlugin
{
    /**
     * Add custom "Buy X Get Y Cheapest Free" action to the available actions
     *
     * @param \Magento\SalesRule\Model\Rule\Action\Discount $subject
     * @param array $result
     * @return array
     */
    public function afterGetDiscountTypes(
        $subject,
        $result
    ) {
        // Add our custom discount type
        $result['buy_x_get_y_cheapest_free'] = __('Buy X Get Y Cheapest Free');
        
        return $result;
    }
} 