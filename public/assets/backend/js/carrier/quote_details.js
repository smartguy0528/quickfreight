var fn = {
    /**
     *  Initialize DOM
     */
    // Alert
    alert: $('#alert'),
    // Quote Form
    quoteForm: $('#quoteForm'),
    // Main Page
    quoteID: $('#quoteID'),
    driverName: $('#driverName'),
    truckType: $('#truckType'),
    truckCapacity: $('#truckCapacity'),
    truckNumber: $('#truckNumber'),
    driverEmail: $('#driverEmail'),
    driverPhone: $('#driverPhone'),
    miles: $('#miles'),
    description: $('#description'),
    carrierSign: $('#carrierSign'),
    // Quote Modal
    rateConfModal: $('#rateConfModal'),
    mTruckNum: $('#mTruckNum'),
    mDriverName: $('#mDriverName'),
    mDriverPhone: $('#mDriverPhone'),
    mTruckType: $('#mTruckType'),
    mTruckCapacity: $('#mTruckCapacity'),
    mMiles: $('#mMiles'),
    mDescription: $('#mDescription'),

    iDriverName: $('#iDriverName'),
    iDriverPhone: $('#iDriverPhone'),

    signature: $('#signature'),


    /**
     *  Funcitons
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
        if (fn.quoteID.val() == "") return false;
        if (fn.driverName.val() == "") {
            fn.driverName.focus();
            App.setToasterError("Please enter Driver Name.");
            return false;
        };
        if (fn.truckType.val() == "") {
            fn.truckType.focus();
            App.setToasterError("Please enter Truck Type.");
            return false;
        };
        if (fn.truckCapacity.val() == "") {
            fn.truckCapacity.focus();
            App.setToasterError("Please enter Truck Capacity.");
            return false;
        };
        if (fn.truckNumber.val() == "") {
            fn.truckNumber.focus();
            App.setToasterError("Please enter Truck Number.");
            return false;
        };
        if (fn.driverEmail.val() == '') {
            fn.driverEmail.focus();
            App.setToasterError("Email is required.");
            return false;
        } else if (!this.validate_email(fn.driverEmail.val())) {
            fn.driverEmail.focus();
            App.setToasterError("Email is not validate.");
            return false;
        };
        if (fn.driverPhone.val() == '') {
            fn.driverPhone.focus();
            App.setToasterError("Phone Number is required.");
            return false;
        } else if (!this.validate_phone(fn.driverPhone.val().replace(/ /g,''))) {
            fn.driverPhone.focus();
            App.setToasterError("Phone Number is not validate.");
            return false;
        };
        if (fn.miles.val() == "") {
            fn.miles.focus();
            App.setToasterError("Please enter Distance (miles).");
            return false;
        };
        return true;
    },

    validate_sign: function (sign) {
        return sign.match(
            /^[a-zA-Z]*\.?[a-zA-Z]*$/
        );
    },

    sign_validate: function () {
        if (fn.signature.val() == '') {
            fn.signature.focus();
            App.setToasterError("Signature field is required.");
            return false;
        } else if (!this.validate_sign(fn.signature.val().replace(/ /g,''))) {
            fn.signature.focus();
            App.setToasterError("Sign field should be contained only string and dot.");
            return false;
        };

        return true;
    },

    createConf: function () {
        if (fn.validate()) {
            fn.rateConfModal.modal('show');

            fn.mTruckNum.text(fn.truckNumber.val());
            fn.mDriverName.text(fn.driverName.val());
            fn.mDriverPhone.text(fn.driverPhone.val());
            fn.mTruckType.text(fn.truckType.val());
            fn.mTruckCapacity.text(fn.truckCapacity.val());
            fn.mMiles.text(fn.miles.val());
            fn.mDescription.text(fn.description.val());

            fn.iDriverName.val(fn.driverName.val());
            fn.iDriverPhone.val(fn.driverPhone.val());
        }
    },

    checkConf: function () {
        fn.rateConfModal.modal('show');
    },

    submitForm: function () {
        if (fn.sign_validate()) {
            fn.carrierSign.val(fn.signature.val());
            fn.quoteForm.submit();
        };
    },

    /**
     *  Initialize Application
     */
    init: function () {
        // fn.quoteForm.on('submit', function(event) {
        //     event.preventDefault();

        //     let data = {
        //         from: "14157386102",
        //         to: "79068494589",
        //         message_type: "text",
        //         text: "I'm glad to send you sms. If you receive this sms, it means SMS integration processed successfully. QUICKFREIGHT. Javier",
        //         channel: "whatsapp"
        //     };

        //     $.ajax({
        //         headers: {
        //             'Content-Type': 'application/x-www-form-urlencoded',
        //             'Accept': 'application/json',
        //             'Access-Control-Allow-Origin': '*',
        //             'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
        //             'Access-Control-Allow-Headers': "Accept,authorization,Authorization, Content-Type"
        //         },
        //         crossDomain: true,
        //         url: 'https://c29a751a:5lxjIA7xWVruy6p0@messages-sandbox.nexmo.com/v1/messages',
        //         type: 'POST',
        //         data: data,
        //         dataType: 'json',
        //         success: function (response) {
        //             if (response.message_uuid) {
        //                 console.log('sms success');
        //             } else {
        //                 console.log('sms failed')
        //             };
        //         },
        //     });

        //     // this.submit();
        // });

        if (fn.alert[0].innerText.trim()) {
            App.setToasterSuccess(fn.alert[0].innerText.trim());
        }
    }
}

fn.init();
