var fn = {
    /**
     *  Initialize DOM
     */
    showModal: $('#show-modal'),
    approveModal: $('#approveModal'),
    rejectModal: $('#rejectModal'),
    deleteModal: $('#deleteModal'),

    /**
     *  Initialize Application
     */
    init: function () {
        $(window).on('load',function(){
            if ($('#show-modal').val() == 1) {
                $('#approveModal').modal('show');
            } else if ($('#show-modal').val() == 2) {
                $('#rejectModal').modal('show');
            } else if ($('#show-modal').val() == 3) {
                $('#deleteModal').modal('show');
            };
        });
    }
}

fn.init();
