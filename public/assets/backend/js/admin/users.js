var fn = {
    /**
     *  Initialize DOM
     */
    // User Table
    usersTable: $('#usersTable'),

    // User Modal
    userModal: $('#userModal'),
    userId: $('#userId'),
    userName: $('#userName'),
    userEmail: $('#userEmail'),
    userPhone: $('#userPhone'),
    userAddress: $('#userAddress'),
    userInfo: $('#userInfo'),

    // Confirm Modal
    confirmModal: $('#confirmModal'),
    userConfirmId: $('#userConfirmId'),

    /**
     *  Initialize Global Values
     */
    tableRef: '',

    /**
     *  Define Functions
     */
    validate_email: function (email) {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    },

    validate_phone: function (phone) {
        return phone.match(
            /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im
        );
    },

    validate: function () {
        if (fn.userName.val() == '') {
            fn.userName.focus();
            App.setToasterError("Name is required.");
            return false;
        };

        if (fn.userEmail.val() == '') {
            fn.userEmail.focus();
            App.setToasterError("Email is required.");
            return false;
        } else if (!this.validate_email(this.userEmail.val())) {
            fn.userEmail.focus();
            App.setToasterError("Email is not validate.");
            return false;
        };

        if (fn.userPhone.val() == '') {
            fn.userPhone.focus();
            App.setToasterError("Phone Number is required.");
            return false;
        } else if (!this.validate_phone(this.userPhone.val().replace(/ /g,''))) {
            fn.userPhone.focus();
            App.setToasterError("Phone Number is not validate.");
            return false;
        };

        return true;
    },

    init_table: function () {
        fn.usersTable.DataTable({
            columnDefs: [{ orderable: false, targets: [-1] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
    },

    addUserModal: function () {
        fn.userModal.modal('show');
        fn.userName.val('');
        fn.userEmail.val('');
        fn.userPhone.val('');
        fn.userAddress.val('');
        fn.userInfo.val('');
    },

    editUserModal: function (id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/users/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                fn.userModal.modal('show');
                fn.userName.val(data.name);
                fn.userEmail.val(data.email);
                fn.userPhone.val(data.phone);
                fn.userAddress.val(data.address);
                fn.userInfo.val(data.information);
                fn.userId.val(data.id);
            }
        });
    },

    deleteUserModal: function (id) {
        fn.confirmModal.modal('show');
        fn.userConfirmId.val(id);
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
