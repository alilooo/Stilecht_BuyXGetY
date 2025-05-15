/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

define([
    'jquery'
], function ($) {
    'use strict';

    return function () {
        $(document).ready(function () {
            var simpleActionEl = $('[name="simple_action"]');
            var discountStepEl = $('#discount_step');
            var discountStepContainerEl = $('#discount_step_container');
            var discountAmountEl = $('#discount_amount');
            var discountAmountContainer = $('#discount_amount_container');
            var discountAmountLabel = $('label[for="discount_amount"]');
            var discountStepLabel = $('label[for="discount_step"]');
            
            function toggleFields() {
                var action = simpleActionEl.val();
                
                if (action === 'buy_x_get_y_cheapest_free') {
                    // Show and update labels for our action
                    discountStepContainerEl.show();
                    discountAmountContainer.show();
                    discountStepLabel.text('Buy X Products');
                    discountAmountLabel.text('Get Y Free (Cheapest)');
                    
                    // Set to integer input for our fields
                    discountStepEl.attr('data-validate', '{"required":true, "validate-integer":true, "validate-greater-than-zero":true}');
                    discountAmountEl.attr('data-validate', '{"required":true, "validate-integer":true, "validate-greater-than-zero":true}');
                } else {
                    // Reset to default labels if not our action
                    discountStepLabel.text('Buy X Items');
                    discountAmountLabel.text('Discount Amount');
                    
                    // Reset validation as needed for other rules
                    if (action.indexOf('by_percent') !== -1) {
                        discountAmountEl.attr('data-validate', '{"required":true, "validate-number":true, "validate-number-range":["0.00001-100"]}');
                    } else {
                        discountAmountEl.attr('data-validate', '{"required":true, "validate-number":true, "validate-greater-than-zero":true}');
                    }
                }
            }
            
            // Run initially and when action changes
            toggleFields();
            simpleActionEl.on('change', toggleFields);
        });
    };
}); 