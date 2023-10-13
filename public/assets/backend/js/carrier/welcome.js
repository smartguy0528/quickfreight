var fn = {
    /**
     *  Initialize DOM
     */
    // Modals
    show_modal: $('#show_modal'),
    rejectModal: $('#rejectModal'),

    // Image Preview Padd
    doc_carrier_packet: document.getElementById('doc_carrier_packet'),
    doc_cert_ins: document.getElementById('doc_cert_ins'),
    doc_w9_form: document.getElementById('doc_w9_form'),
    doc_operating_auth: document.getElementById('doc_operating_auth'),

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
            // preview the pdf file type...
            // FilePondPluginPdfPreview
        );

        FilePond.create( fn.doc_carrier_packet, {
            acceptedFileTypes: ['application/pdf'],
            allowImagePreview: true,
            //allowPdfPreview: true,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            imagePreviewMaxHeight: 256,
            imagePreviewMaxWidth: 256,
            labelIdle: 'Drag & Drop your Carrier Packet PDF or <span class="filepond--label-action">Browse</span>',
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

        FilePond.create( fn.doc_cert_ins, {
            acceptedFileTypes: ['application/pdf'],
            allowImagePreview: true,
            //allowPdfPreview: true,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            imagePreviewMaxHeight: 256,
            imagePreviewMaxWidth: 256,
            labelIdle: 'Drag & Drop your Certificate of Insurance PDF or <span class="filepond--label-action">Browse</span>',
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

        FilePond.create( fn.doc_w9_form, {
            acceptedFileTypes: ['application/pdf'],
            allowImagePreview: true,
            //allowPdfPreview: true,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            imagePreviewMaxHeight: 256,
            imagePreviewMaxWidth: 256,
            labelIdle: 'Drag & Drop your Completed W9 Tax Form or <span class="filepond--label-action">Browse</span>',
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

        FilePond.create( fn.doc_operating_auth, {
            acceptedFileTypes: ['application/pdf'],
            allowImagePreview: true,
            //allowPdfPreview: true,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            imagePreviewMaxHeight: 256,
            imagePreviewMaxWidth: 256,
            labelIdle: 'Drag & Drop yourOperating Authority PDF or <span class="filepond--label-action">Browse</span>',
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
    }
}
fn.init();
