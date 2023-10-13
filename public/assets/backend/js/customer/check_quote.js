var fn = {
    /**
     *  Initialize DOM
     */
    approveModal: $('#approveModal'),
    approveForm: $('#approveForm'),
    approveCompanyName: $('#approveCompanyName'),
    approveCompanyAddress: $('#approveCompanyAddress'),
    approveBtn: $('#approveBtn'),
    rejectModal: $('#rejectModal'),
    rejectForm: $('#rejectForm'),
    rejectCompanyName: $('#rejectCompanyName'),
    rejectCompanyAddress: $('#rejectCompanyAddress'),
    rejectComment: $('#rejectComment'),
    rejectBtn: $('#rejectBtn'),
    deleteForm: $('#deleteForm'),
    deleteComment: $('#deleteComment'),
    deleteBtn: $('#deleteBtn'),
    alert: $('#alert'),
    
    /**
     *  Functions
     */
    approveValidate: function () {
        if (fn.approveCompanyName.val() == '') {
            fn.approveCompanyName.focus();
            App.setToasterError("Company Name is required.");
            return false;
        };

        if (fn.approveCompanyAddress.val() == '') {
            fn.approveCompanyAddress.focus();
            App.setToasterError("Company Address is required.");
            return false;
        };

        return true;
    },

    rejectValidate: function () {
        if (fn.rejectCompanyName.val() == '') {
            fn.rejectCompanyName.focus();
            App.setToasterError("Company Name is required.");
            return false;
        };

        if (fn.rejectCompanyAddress.val() == '') {
            fn.rejectCompanyAddress.focus();
            App.setToasterError("Company Address is required.");
            return false;
        };

        if (fn.rejectComment.val() == '') {
            fn.rejectComment.focus();
            App.setToasterError("Reject Reason is required.");
            return false;
        };

        return true;
    },

    deleteValidate: function () {
        if (fn.deleteComment.val() == '') {
            fn.deleteComment.focus();
            App.setToasterError("Please send us a reason why you delete this order.");
            return false;
        };

        return true;
    },

    /**
     *  Initialize Application
     */
    init: function () {
        if (fn.alert[0].innerText.trim()) {
            App.setToasterSuccess(fn.alert[0].innerText.trim());
        };

        fn.approveBtn.click(function(e) {
            e.preventDefault();

            if (fn.approveValidate()) {
                fn.approveForm.submit();
            };
        });

        fn.rejectBtn.click(function(e) {
            e.preventDefault();

            if (fn.rejectValidate()) {
                fn.rejectForm.submit();
            };
        });

        fn.deleteBtn.click(function(e) {
            e.preventDefault();

            if (fn.deleteValidate()) {
                fn.deleteForm.submit();
            };
        });
    }
}

fn.init();