var fn = {
    /**
     *  Initialize DOM
     */
    
    // Quote Table
    quoteTable: $('#quoteTable'),
    // Quote Modal
    quoteModal: $('#quoteModal'),
    // RejectPad
    rejectPad: $('#rejectPad'),
    // Variables
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
    
    // Reject Information
    oCost: $('#oCost'),
    oFee: $('#oFee'),
    oTotalCost: $('#oTotalCost'),
    oComment: $('#oComment'),
    oReason: $('#oReason'),

    // Company Info
    rCost: $('#rCost'),
    rFee: $('#rFee'),
    rTotalCost: $('#rTotalCost'),
    rComment: $('#rComment'),

    /**
     *  Initialize Global Value
     */
    tableRef: '',

    /**
     *  Funcitons
     */
    detailQuote: function (id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/quotes/approved/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (!data.old_reject_reason) {
                    fn.rejectPad.addClass('d-none');
                };
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

                fn.oCost.text(data.old_cost);
                fn.oFee.text(data.old_fee);
                fn.oTotalCost.text(data.old_total_cost);
                fn.oComment.text(data.old_company_comment);
                fn.oReason.text(data.old_reject_reason);
            
                fn.rCost.text(data.cost);
                fn.rFee.text(data.fee);
                fn.rTotalCost.text(data.total_cost);
                fn.rComment.text(data.company_comment);
                
                fn.cID.val(data.id);
            }
        });
    },

    init_table: function () {
        fn.tableRef = fn.quoteTable.DataTable({
            ajax: '/quotes/checked/all',
            columns: [
                { data: 'id' },
                { data: 'id_alias' },
                { data: 'created_at' },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                {
                    "render": function (data, type, full, meta) {
                        let btnDetails = `<button class="btn btn-secondary btn-sm w-125p" onclick="fn.detailQuote(` + full.id + `)"><i class="fas fa-info-circle"></i> Check Details</button>`;
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