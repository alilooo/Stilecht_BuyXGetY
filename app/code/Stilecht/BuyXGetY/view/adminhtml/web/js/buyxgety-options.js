/**
 * Copyright © Stilecht BuyXGetY All rights reserved.
 */

define([
    'jquery',
    'Magento_Ui/js/form/element/select',
    'domReady!'
], function ($, Select) {
    'use strict';

    return function() {
        // Make sure UI component registry is loaded
        require(['uiRegistry'], function(registry) {
            // Try to find the simple_action field in the registry
            registry.get('sales_rule_form.sales_rule_form.actions.simple_action', function(simpleAction) {
                if (simpleAction) {
                    // Set component type if it's not already set
                    if (!simpleAction.componentType) {
                        simpleAction.set('componentType', 'select');
                    }
                }
            });
        });
        
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
                            .text('BXGY Cheapest Free')
                    );
                }
                
                // Get field containers
                var discountStepContainer = $('#discount_step_container');
                var discountAmountContainer = $('#discount_amount_container');
                var discountQtyContainer = $('#discount_qty_container');
                
                // Function to update fields based on selected action
                function updateFields() {
                    var action = simpleActionSelect.val();
                    
                    // For all actions, reset to default first
                    discountStepContainer.hide();
                    
                    // Show/hide fields based on action type
                    if (action === 'buy_x_get_y_cheapest_free') {
                        // Show all necessary fields
                        discountStepContainer.show();
                        discountAmountContainer.show();
                        
                        // Update labels for our action
                        $('label[for="discount_step"]').text('Buy X Products');
                        $('label[for="discount_amount"]').text('Get Y Free (Cheapest)');
                        
                        // Set validation to integers only
                        $('#discount_step').attr('data-validate', '{"required":true, "validate-integer":true, "validate-greater-than-zero":true}');
                        $('#discount_amount').attr('data-validate', '{"required":true, "validate-integer":true, "validate-greater-than-zero":true}');
                    } else if (action === 'by_fixed' || action === 'by_percent' || action === 'cart_fixed') {
                        // For standard discount types
                        discountAmountContainer.show();
                    } else if (action === 'buy_x_get_y') {
                        // For standard BOGO
                        discountStepContainer.show();
                        discountAmountContainer.show();
                        
                        // Reset labels to default
                        $('label[for="discount_step"]').text('Buy X Items');
                        $('label[for="discount_amount"]').text('Get Y Discount');
                    }
                }
                
                // Handle the change event to update labels
                simpleActionSelect.on('change', updateFields);
                
                // Trigger change event to update UI initially
                updateFields();
            }
        }, 500);
    };
}); 