<?php
/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

namespace Stilecht\BuyXGetY\Model\Rule\Action\Discount;

use Magento\SalesRule\Model\Rule\Action\Discount\AbstractDiscount;
use Magento\SalesRule\Model\Rule\Action\Discount\Data;
use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\SalesRule\Model\Rule;

class BuyXGetYFree extends AbstractDiscount
{
    /**
     * Calculate discount for the item
     *
     * @param Rule $rule
     * @param AbstractItem $item
     * @param float $qty
     * @return Data
     */
    public function calculate($rule, $item, $qty)
    {
        /** @var Data $discountData */
        $discountData = $this->discountFactory->create();
        
        // Skip if this is not our rule
        if ($rule->getSimpleAction() != 'buy_x_get_y_cheapest_free') {
            return $discountData;
        }
        
        // Get all items from the cart
        $quote = $item->getQuote();
        $address = $item->getAddress();
        
        // Collect items eligible for the rule
        $eligibleItems = [];
        foreach ($address->getAllItems() as $quoteItem) {
            // Skip if the item is a child of a parent item (e.g., bundle product)
            if ($quoteItem->getParentItemId()) {
                continue;
            }
            
            // Skip if the item doesn't match the rule conditions
            if (!$rule->getActions()->validate($quoteItem)) {
                continue;
            }
            
            // Skip the item if it's already receiving a discount
            if ($quoteItem->getDiscountAmount() > 0) {
                continue;
            }
            
            $eligibleItems[] = $quoteItem;
        }
        
        // If not enough items, no discount
        $x = (int)$rule->getDiscountStep(); // How many to buy
        $y = (int)$rule->getDiscountAmount(); // How many to get free
        
        if (count($eligibleItems) < ($x + $y)) {
            return $discountData;
        }
        
        // Sort items by price (cheapest first)
        usort($eligibleItems, function($a, $b) {
            return $a->getPrice() - $b->getPrice();
        });
        
        // Select the cheapest Y items to receive the discount
        $itemsToDiscount = array_slice($eligibleItems, 0, $y);
        
        // If current item is one of the items to discount
        foreach ($itemsToDiscount as $discountItem) {
            if ($discountItem->getId() == $item->getId()) {
                $discountAmount = $item->getPrice() * $qty;
                $baseDiscountAmount = $item->getBasePrice() * $qty;
                
                $discountData->setAmount($discountAmount);
                $discountData->setBaseAmount($baseDiscountAmount);
                $discountData->setOriginalAmount($discountAmount);
                $discountData->setBaseOriginalAmount($baseDiscountAmount);
                break;
            }
        }
        
        return $discountData;
    }
} 