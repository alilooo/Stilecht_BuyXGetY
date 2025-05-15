<?php
/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

namespace Stilecht\BuyXGetY\Plugin\SalesRule\Model;

use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\SalesRule\Model\Validator as SalesRuleValidator;
use Closure;

class Validator
{
    /**
     * Additional validation for Buy X Get Y rules
     *
     * @param SalesRuleValidator $subject
     * @param \Closure $proceed
     * @param AbstractItem $item
     * @return mixed
     */
    public function aroundProcess(
        SalesRuleValidator $subject,
        Closure $proceed,
        $item
    ) {
        $result = $proceed($item);
        
        // Add any advanced validation logic here if needed
        
        return $result;
    }
} 