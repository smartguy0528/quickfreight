var fn = {
    /**
     *  Initialize DOM
     */
    invoiceTable: $('#invoiceTable'),
    reviewModal: $('#reviewModal'),
    customerName: $('#customerName'),
    customerRiview: $('#customerRiview'),
    reviewDate: $('#reviewDate'),

    /**
     *  Functions
     */
    review_modal: function (id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/quote/get/review/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                fn.reviewModal.modal("show");
                fn.customerName.text(data.customer_name);
                fn.customerRiview.text(data.customer_review);
                fn.reviewDate.text(data.updated_at);
            }
        });
    },

    init_table: function () {
        fn.invoiceTable.DataTable({
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
