var fn = {
    /**
     *  Initialize DOM
     */
    // Quote Table
    quoteTable: $('#quoteTable'),
    // Quote Modal
    quoteModal: $('#quoteModal'),
    cID: $('#cID'),
    cQuoteID: $('#cQuoteID'),
    cCompany: $('#cCompany'),
    cAddress: $('#cAddress'),
    cName: $('#cName'),
    cEmail: $('#cEmail'),
    cPhone: $('#cPhone'),
    cPickup: $('#cPickup'),
    cDelivery: $('#cDelivery'),
    cCommodity: $('#cCommodity'),
    cPDate: $('#cPDate'),
    cDDate: $('#cDDate'),
    cDimension: $('#cDimension'),
    cWeight: $('#cWeight'),
    cTemperature: $('#cTemperature'),
    cEquipment: $('#cEquipment'),
    cComment: $('#cComment'),
    // Company Info
    rCost: $('#rCost'),
    rFee: $('#rFee'),
    rTotalCost: $('#rTotalCost'),
    rComment: $('#rComment'),
    // Reject Reason
    cCompany: $('#cCompany'),
    cAddress: $('#cAddress'),
    cReason: $('#cReason'),

    // Request Info
    nCost: $('#nCost'),
    nFee: $('#nFee'),
    nTotalCost: $('#nTotalCost'),
    nComment: $('#nComment'),

    /**
     *  Initialize Global Value
     */
    tableRef: '',

    /**
     *  Funcitons
     */
    validate: function () {
        if (fn.nCost.val() == '') {
            fn.nCost.focus();
            App.setToasterError("Delivery cost field is required.");
            return false;
        };

        if (fn.nTotalCost.val() == '') {
            fn.nTotalCost.focus();
            App.setToasterError("Total cost field is required.");
            return false;
        };

        return true;
    },

    detailQuote: function (id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/quotes/approved/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                fn.quoteModal.modal('show');
                fn.cQuoteID.text(data.id_alias);
                fn.cCompany.text(data.company_name);
                fn.cAddress.text(data.company_address);
                fn.cName.text(data.name);
                fn.cEmail.text(data.email);
                fn.cPhone.text(data.phone);
                fn.cPickup.text(data.pickup);
                fn.cDelivery.text(data.delivery);
                fn.cCommodity.text(data.commodity);
                fn.cPDate.text(data.pickupDate);
                fn.cDDate.text(data.deliveryDate);
                fn.cDimension.text(data.dimension);
                fn.cWeight.text(data.weight);
                fn.cTemperature.text(data.temperature);
                fn.cEquipment.text(data.equipment_name);
                fn.cComment.text(data.comment);
                fn.rCost.text(data.cost);
                fn.rFee.text(data.fee);
                fn.rTotalCost.text(data.total_cost);
                fn.cCompany.text(data.company_name);
                fn.cAddress.text(data.company_address);
                fn.cReason.text(data.reject_reason);
                fn.cID.val(data.quote_id);

                fn.nCost.val('');
                fn.nFee.val('');
                fn.nTotalCost.val('');
                fn.nComment.val('');

            }
        });
    },

    sendQuote: function () {
        if (fn.validate()) {
            let data = {
                quote_id: fn.cID.val(),
                cost: fn.nCost.val(),
                fee: fn.nFee.val(),
                total_cost: fn.nTotalCost.val(),
                company_comment: fn.nComment.val()
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/quote/approved/recreate',
                method: 'POST',
                data: data,
                dataType: 'JSON',
                success: function (response) {
                    fn.quoteModal.modal('hide');
                    fn.tableRef.ajax.reload();
                    App.setToasterSuccess(response.success);
                }
            });
        };
    },

    init_table: function () {
        fn.tableRef = fn.quoteTable.DataTable({
            ajax: '/quotes/rejected/all',
            columns: [
                { data: 'id' },
                { data: 'id_alias' },
                { data: 'updated_at' },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                {
                    "render": function (data, type, full, meta) {
                        let btnDetails = `<button class="btn btn-danger btn-sm" onclick="fn.detailQuote(` + full.id + `)"><i class="far fa-calendar-check"></i> Check Details</button>`;
                        return btnDetails;
                    }
                }
            ],
            columnDefs: [{ orderable: false, targets: [-1] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });

        fn.tableRef.on('order.dt search.dt', function () {
            fn.tableRef.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
    },

    /**
     *  Initialize Application
     */
    init: function () {
        // DataTable Init
        fn.init_table();
    }
}

fn.init();