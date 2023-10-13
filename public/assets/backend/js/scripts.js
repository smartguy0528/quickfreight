var App = {
    /**
     *  Initialize DOM
     */
    // Initial Alert
    successMsg: $("#successMsg"),
    errorMsg: $(".errorMsg"),

    // Password Form
    passwordModal: $('#passwordModal'),
    passwordForm: $('#passwordForm'),
    passwordId: $('#passwordId'),
    passwordNew: $('#passwordNew'),
    passwordConfirmInput: $('#passwordConfirmInput'),

    /**
     *  Initialize Functions
     */
    successAlert: function (msg) {
        Toastify({
            text: msg,
            duration: 5000,
            close:true,
            gravity:"bottom",
            position: "right",
            backgroundColor: "#01ba49",
        }).showToast();
    },

    errorAlert: function (msg) {
        Toastify({
            text: msg,
            duration: 5000,
            close:true,
            gravity:"bottom",
            position: "right",
            backgroundColor: "#ff4b4b",
        }).showToast();
    },

    resetPassModal: function () {
        App.passwordNew.val('');
        App.passwordConfirmInput.val('');
    },

    changePassword: function () {
        if (!App.passwordNew.val()) {
            App.errorAlert("Password field is required");
            App.passwordConfirmInput.val('');
        }
        else if (App.passwordNew.val() != App.passwordConfirmInput.val()) {
            App.errorAlert("Password dismatch");
            App.passwordConfirmInput.val('');
        } else if (App.passwordNew.val().length < 6) {
            App.errorAlert("Password should be 6 characters at least.");
        } else {
            App.passwordForm.submit();
        }
    },

    // Initialize application
    init: function () {
        /**
         * JS alert when page loading
         */
        // Success alert
        if(App.successMsg.text()) {
            App.successAlert(App.successMsg.text());
        };

        // Error alerts
        App.errorMsg.each(function (index, element) {
           App.errorAlert(element.value);
        });

        // Preloader Loading Fadeout
        $(window).on('load', function () {
            $('#preloader-active').delay(450).fadeOut("slow");
            $('body').delay(450).css({
                'overflow': 'visible'
            });
        });

        // Toggle the side navigation
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
            });
        }
    }
}

App.init();
