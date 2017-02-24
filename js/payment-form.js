
/****************************************************
 * 
 * This JavaScript handles all payment form functionality
 * Implements namespacing by using JavaScript Closure
 * TODO: Could be improved by global namespace variable
 * 
 ******************************************************/

(function() {

    var PaymentForm = {
        $form: {},
        baseUrl: '',
        $customerInfoContainer: {},
        $accountInfoContainer: {}
    };


    /**
     * 
     * @param {type} customerID
     * @returns {undefined}
     * 
     * fetch customer details
     */
    function fetchCustomerDetails(customerID) {
        var paid = $("#paid").val();
        var $container = PaymentForm.$customerInfoContainer;

        if (customerID !== null && !isNaN(customerID) && parseInt(customerID) > 0) {

            //show loading
            var loadingHTML = '<img ' +
                    'src="' + PaymentForm.baseUrl + '/images/loading.gif" ' +
                    'alt="loading......">';
            $container.html(loadingHTML).show();

            //fetch details
            $.post(
                PaymentForm.baseUrl + "index.php/payment/details", 
                {
                    customerID: customerID,
                    paid: paid
                },
                function (responseHtml) {
                    $container.html(responseHtml);
                    var $select = $('select', $container);
                    $select.combobox({
                        onChange: fetchAccountDetails
                    });
                }
            );
        }
    }


    /**
     * 
     * @returns {undefined}
     * 
     * fetches account details
     */
    function fetchAccountDetails() {
        var $accountsSelect = $('select', PaymentForm.$customerInfoContainer);
        var $paidTextField = $('input#paid', PaymentForm.$form);
        var accountID = $accountsSelect.combo('getValue');
        var paidAmount = parseInt($paidTextField.val());
        var $container = PaymentForm.$accountInfoContainer;
        
        //check account ID
        if (!(
                accountID !== null 
                && !isNaN(accountID) 
                && parseInt(accountID) > 0
            )) {
            return;
        }

        //show loading
        var loadingHTML = '<img ' +
                'src="' + PaymentForm.baseUrl + '/images/loading.gif" ' +
                'alt="loading......">';
        $container.html(loadingHTML).show();

        $.post(
            PaymentForm.baseUrl + "index.php/account/details", 
            {
                accountID: accountID,
                paid: paidAmount
            }, 
            function (responseHTML) {
                $container.html(responseHTML);
            }
        );

    }
    $(document).ready( function() {
        PaymentForm.baseUrl = TACEAS.baseURL;
        PaymentForm.$form = $('form#station-form');
        PaymentForm.$customerInfoContainer = $('#loading', PaymentForm.$form);
        PaymentForm.$accountInfoContainer = $('#loading2', PaymentForm.$form);

        //watch for customer selected
        var $customerComboBox = $('#customerID', PaymentForm.$form);
        $customerComboBox.combobox({
            onChange: function(id) {
                fetchCustomerDetails(id);
            }
        });
        
        //watch payment amount
        $('input#paid', PaymentForm.$form).on('blur', fetchAccountDetails);

    });

})();

