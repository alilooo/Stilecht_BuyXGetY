/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

define([
    'jquery',
    'domReady!'
], function ($) {
    'use strict';

    return function() {
        // Wait for the simple_action dropdown to be available
        var checkInterval = setInterval(function() {
            var simpleActionSelect = $('[name="simple_action"]');
            
            if (simpleActionSelect.length) {
                clearInterval(checkInterval);
                
                // Add our custom option if it doesn't exist
                if (simpleActionSelect.find('option[value="buy_x_get_y_cheapest_free"]').length === 0) {
                    simpleActionSelect.append(
                        $('<option></option>')
                            .attr('value', 'buy_x_get_y_cheapest_free')
                            .text('Buy X Get Y Cheapest Free')
                    );
                }
                
                // Handle the change event to update labels
                simpleActionSelect.on('change', function() {
                    var action = $(this).val();
                    
                    if (action === 'buy_x_get_y_cheapest_free') {
                        // Update labels for our action
                        $('label[for="discount_step"]').text('Buy X Products');
                        $('label[for="discount_amount"]').text('Get Y Free (Cheapest)');
                        
                        // Update validation
                        $('#discount_step').attr('data-validate', '{"required":true, "validate-integer":true, "validate-greater-than-zero":true}');
                        $('#discount_amount').attr('data-validate', '{"required":true, "validate-integer":true, "validate-greater-than-zero":true}');
                    }
                });
                
                // Trigger change event to update UI if our option is selected
                simpleActionSelect.trigger('change');
            }
        }, 500);
    };
}); 