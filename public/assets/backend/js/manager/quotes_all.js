var fn = {
    /**
     *  Initialize DOM
     */
    // Quote Table
    quoteTable: $('#quoteTable'),
    // Quote Modal
    quoteModal: $('#quoteModal'),
    cID: $('#cID'),
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

    /**
     *  Initialize Global Value
     */
    tableRef: '',

    /**
     *  Funcitons
     */
    showDetails: function (id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/quotes/detail/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                fn.quoteModal.modal('show');
                fn.cCompany.text(data.company_name);
                fn.cAddress.text(data.company_address);
                fn.cName.text(data.firstName + '' +data.lastName);
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
                fn.rComment.text(data.company_comment);
                fn.cID.val(data.quote_id);
            }
        });
    },

    init_table: function () {
        fn.quoteTable.DataTable({
            columnDefs: [{ orderable: false, targets: [-1] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
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