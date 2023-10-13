var fn = {
    /**
     *  Initialize DOM
     */
    // Order Form
    orderForm: $('#orderForm'),
    submitBtn: $('#submitBtn'),
    // Order Details
    firstName: $('#firstName'),
    lastName: $('#lastName'),
    email: $('#email'),
    phone: $('#phone'),
    pickup: $('#pickup'),
    delivery: $('#delivery'),
    pickupDate: $('#pickupDate'),
    deliveryDate: $('#deliveryDate'),
    commodity: $('#commodity'),
    dimension: $('#dimension'),
    weight: $('#weight'),
    temperature: $('#temperature'),
    equipment: $('#equipment'),
    trailerSize: $('#trailerSize'),
    comment: $('#comment'),
    policyCheckbox: $('#policy-checkbox'),

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
        if (fn.firstName.val() == '') {
            fn.firstName.focus();
            Main.errorAlert("Firstname is required.");
            return false;
        };

        if (fn.lastName.val() == '') {
            fn.lastName.focus();
            Main.errorAlert("Lastname is required.");
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

        if (fn.phone.val() == '') {
            fn.phone.focus();
            Main.errorAlert("Phone Number is required.");
            return false;
        } else if (!this.validate_phone(this.phone.val().replace(/ /g,''))) {
            fn.phone.focus();
            Main.errorAlert("Phone Number is not validate.");
            return false;
        };

        if (fn.pickup.val() == '') {
            fn.pickup.focus();
            Main.errorAlert("Pickup City is required.");
            return false;
        };

        if (fn.delivery.val() == '') {
            fn.delivery.focus();
            Main.errorAlert("Delivery City is required.");
            return false;
        };

        if (fn.pickupDate.val() == '') {
            fn.pickupDate.focus();
            Main.errorAlert("Pickup Date is required.");
            return false;
        };

        if (fn.deliveryDate.val() == '') {
            fn.deliveryDate.focus();
            Main.errorAlert("Delivery Date is required.");
            return false;
        };

        if (fn.commodity.val() == '') {
            fn.commodity.focus();
            Main.errorAlert("Commodity field is required.");
            return false;
        };

        if (!fn.policyCheckbox.is(":checked")) {
            fn.policyCheckbox.focus();
            Main.errorAlert("Check Terms of Use and Privacy Cookie Policy.");
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
                fn.orderForm.submit();
            };
        });

        $(document).ready(function(){
            let i = 1;
            $("input").click(function(clt){
                console.log(clt.target.type);
                let inputType = document.getElementById('Date');
                console.log(inputType.count);
            });
            $("#addTableContent").click(function(){
                i++;
                $("#serviceContent").append(
                    '<div class="col-sm-4">'+
                        '<div class="form-group">'+
                            '<label for="location">Location</label>'+
                            '<input id="location' + i + '" class="form-control" type="text" name="location' + i + '">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                        '<div class="form-group">'+
                            '<label for="commodity">Commodity</label>'+
                            '<input id="commodity' + i + '" class="form-control" type="text" name="commodity' + i + '" >'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                        '<div class="form-group">'+
                            '<label for="dimension">Dimension</label>'+
                            '<input id="dimension' + i + '" class="form-control" type="text" name="dimension' + i + '">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                        '<div class="form-group">'+
                            '<label for="Date">Date <span class="text-danger">*</span></label>'+
                            "<input type='date' id='Date' class='form-control' name='dateData" + i + "'  >" +
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                        '<div class="form-group" align="center">'+
                            '<label for="load/unload">Load/Unload</label>'+
                            "<button type='button' class='selectLoadBtn' value=" + i +" >Load</button>"+
                        '</div>'+
                    '</div>'+
                    '<input type="hidden" id="selectLoad' + i + '" name="selectLoad' + i + '" class="form-control selectLoad" value="Load"></input>'
                );
                let ctd = $("#countData").val(i);
                ctd = i;
                console.log(ctd);
            });

            

            $(document).on('click', '.selectLoadBtn', function(e){
               const buttons = document.getElementsByClassName('selectLoadBtn');

               let val = e.target.value;      
               const selectLoadContent = document.getElementsByClassName('selectLoad');
                if(buttons[val - 1].textContent == 'Load')
                {
                    buttons[val - 1].textContent = 'Unload';
                    const str = buttons[val - 1].textContent;
                    selectLoadContent[val - 1].value = str;
                    console.log(selectLoadContent[val - 1].value);
                    // selectLoadContent[val - 1].attr("value", str);
                    // console.log(selectLoadContent[val - 1].attr("value", str));
                }
                else if(buttons[val - 1].textContent == 'Unload')
                {
                    buttons[val - 1].textContent = 'Load'; 
                //    const aaa = selectLoadCount[val - 1].val(buttons[val - 1].textContent);
                    const str = buttons[val - 1].textContent;
                    selectLoadContent[val - 1].value = str;
                    console.log(selectLoadContent[val - 1].value);
                }
                
            });
        })
        
                  
    }
}

fn.init();


