var fn = {
    /**
     *  Initialize DOM
     */
    // Quote Table
    quoteTable: $('#quoteTable'),

    /**
     *  Initialize Functions
     */
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
