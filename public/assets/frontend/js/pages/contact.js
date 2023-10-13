var fn = {
    /**
     *  Initialize DOM
     */
    contactForm: $('#contactForm'),
    submitBtn: $('#submitBtn'),

    message: $('#message'),
    name: $('#name'),
    email: $('#email'),
    subject: $('#subject'),

    /**
     *  Functions
     */
    validate_email: function (email) {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    },

    validate: function () {
        if (fn.message.val() == '') {
            console.log(fn.message.val());
            fn.message.focus();
            Main.errorAlert("Message content is required.");
            return false;
        };

        if (fn.name.val() == '') {
            fn.name.focus();
            Main.errorAlert("Name is required.");
            return false;
        };

        if (fn.email.val() == '') {
            fn.email.focus();
            Main.errorAlert("Email is required.");
            return false;
        } else if (!this.validate_email(this.email.val())) {
            fn.email.focus();
            Main.errorAlert("Email is not validate.");
            return false;
        };

        if (fn.subject.val() == '') {
            fn.subject.focus();
            Main.errorAlert("Subject field is required.");
            return false;
        };

        return true;
    },

    /**
     *  Initialize Application
     */
    init: function () {
        this.submitBtn.click(function(e) {
            e.preventDefault();

            if (fn.validate()) {
                fn.contactForm.submit();
            };

        });
    }
}

fn.init();
