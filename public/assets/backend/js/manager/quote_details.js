var fn = {
    /**
     *  Funcitons
     */
    validate_sign: function (sign) {
        return sign.match(
            /^[a-zA-Z]*\.?[a-zA-Z]*$/
        );
    },

    signValidate: function () {
        if ($('#signature').val() == '') {
            $('#signature').focus();
            App.setToasterError("Signature field is required.");
            return false;
        } else if (!this.validate_sign($('#signature').val().replace(/ /g,''))) {
            $('#signature').focus();
            App.setToasterError("Sign field should be contained only string and dot.");
            return false;
        };

        return true;
    },

    createConf: function () {
        if ($('#suggestedCost').val()) {
            let data = {
                quote_id: $('#quoteID').val(),
                carrier_id: $('#carrier').val(),
                deliver_cost: $('#suggestedCost').val(),
                company_carrier_comment: $('#comment').val()
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/quote/comp/create',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function (data) {
                    $('#rateConfModal').modal('show');
                    $('#createdDate').text(data.updated_at.split(' ')[0]);
                    $('#createdTime').text(data.updated_at.split(' ')[1]);
                    $('#deliverCost').text(data.deliver_cost);
                    $('#companyCarrierComment').text(data.company_carrier_comment);
                    $('#carrierName').text(data.carrier_name);
                }
            });
        } else {
            App.setToasterError("Please enter cost value.");
            $('#suggestedCost').focus();
        }
    },

    checkConf: function () {
        $('#rateConfModal').modal('show');
    },

    /**
     *  Initialize Application
     */
    init: function () {
        $('#submitBtn').click(function(e) {
            e.preventDefault();
            if (fn.signValidate()) {
                $('#submitBtn').parents('form:first').submit();
            };
        });
    }
}

fn.init();
