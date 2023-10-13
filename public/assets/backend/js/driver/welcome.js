var fn = {
    /**
     *  Initialize DOM
     */

    // Upload BOL
    bol_file: document.getElementById('bol_file'),

    /**
     *  Initialize Functions
     */
    getLocation: function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(fn.showPosition, fn.showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    },

    showPosition: function (position) {
        console.log(position.coords.latitude, position.coords.longitude);
    },

    showError: function (error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                console.log("User denied the request for Geolocation.");
                // location.reload();
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    },

    /**
     *  Initialize Application
     */
    init: function () {
        // File Upload
        FilePond.registerPlugin(
            // validates the size of the file...
            FilePondPluginFileValidateSize,
            // validates the file type...
            FilePondPluginFileValidateType,
            // preview the image file type...
            FilePondPluginImagePreview,
        );

        FilePond.create(fn.bol_file, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
            allowImagePreview: true,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            labelIdle: '<span class="filepond--label-action">Browse</span> BOL picture.',
            server: {
                url: '/uploads',
                process: {
                    url: '/process',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                revert: {
                    url: '/revert',
                    method: 'DELETE',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            }
        });

        // Car Location
        window.onload = fn.getLocation();
    }
}
fn.init();
