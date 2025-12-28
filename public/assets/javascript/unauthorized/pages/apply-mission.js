"use strict";

// Apply Mission Page Handler
var KTApplyMission = function () {

    // ✅ Setup AJAX to always send CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize Select2 for all dropdowns
    const initializeSelect2 = () => {
        console.log('Initializing Select2...');

        // Specialization
        $('#specialization').select2({
            placeholder: "Select Your Specialization",
            allowClear: true
        });

        // Gender
        $('#gender').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        // Nationality
        $('#nationality').select2({
            placeholder: "Select Nationality",
            allowClear: true
        });

        // Languages
        $('#languages_spoken').select2({
            placeholder: "Select languages",
            closeOnSelect: false,
            allowClear: true
        });

        console.log('Select2 initialized successfully');
    };

    // Auto-load specializations based on user's role
    const loadSpecializationsOnInit = () => {
        var humanTypeId = $('#human_type').val();

        console.log('=== Specialization Loading Debug ===');
        console.log('Human Type ID from hidden input:', humanTypeId);
        console.log('Type:', typeof humanTypeId);

        // ✅ Enhanced validation
        if (!humanTypeId || humanTypeId === '' || humanTypeId === 'null' || humanTypeId === 'undefined') {
            console.error('❌ Human Type ID is missing or invalid!');

            Swal.fire({
                title: 'Missing Information',
                html: 'Your staff type is not set.<br><br>Please contact the administrator to update your profile.',
                icon: 'error',
                confirmButtonText: 'Go Back to Calendar',
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then(() => {
                window.location.href = '/calendar';
            });

            return;
        }

        console.log('✓ Human Type ID is valid, proceeding to load specializations...');
        loadSpecializations(humanTypeId);
    };

    // Load specializations for given human type
    const loadSpecializations = (humanTypeId) => {
        var $specSelect = $('#specialization');

        console.log('Loading specializations for human_type:', humanTypeId);

        // Get fresh CSRF token
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (!csrfToken) {
            console.error('❌ CSRF Token not found in page!');
            Swal.fire({
                title: "Session Error",
                text: "Please refresh the page and try again.",
                icon: "error",
                confirmButtonText: "Refresh Page"
            }).then(() => {
                window.location.reload();
            });
            return;
        }

        $.ajax({
            url: '/get_specialization',
            type: 'POST',
            data: {
                HUMAN_TYPE: humanTypeId,
                _token: csrfToken
            },
            dataType: 'json',
            beforeSend: function() {
                $specSelect.prop('disabled', true);
                $specSelect.next('.spinner-border').remove();
                $specSelect.parent().append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                console.log('⏳ Sending AJAX request...');
            },
            success: function(response) {
                $specSelect.prop('disabled', false);
                $('.spinner-border').remove();

                console.log('✓ AJAX Success!');
                console.log('Response:', response);

                if (response.status === 'success' && response.data && response.data.length > 0) {
                    $specSelect.empty().append('<option value="" disabled selected>Select Your Specialization</option>');

                    $.each(response.data, function(index, spec) {
                        $specSelect.append('<option value="' + spec.id + '">' + spec.name + '</option>');
                    });

                    $specSelect.trigger('change');
                    console.log('✓ Specializations loaded successfully! Total:', response.data.length);
                } else {
                    console.warn('⚠️ No specializations found');
                    Swal.fire({
                        text: "No specializations found for this role.",
                        icon: "warning",
                        confirmButtonText: "Ok"
                    });
                    $specSelect.empty().append('<option value="" disabled selected>No Specializations Available</option>').trigger('change');
                }
            },
            error: function(xhr, status, error) {
                $specSelect.prop('disabled', false);
                $('.spinner-border').remove();

                console.error('❌ AJAX Error');
                console.error('Status Code:', xhr.status);
                console.error('Response:', xhr.responseText);

                let errorMessage = 'Failed to load specializations. ';

                if (xhr.status === 419) {
                    errorMessage = 'Your session has expired. The page will refresh automatically.';
                    Swal.fire({
                        title: "Session Expired",
                        text: errorMessage,
                        icon: "error",
                        confirmButtonText: "Refresh Now",
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.reload();
                    });
                    return;
                } else if (xhr.status === 404) {
                    errorMessage += 'Endpoint not found.';
                } else if (xhr.status === 500) {
                    errorMessage += 'Server error.';
                } else if (xhr.status === 0) {
                    errorMessage += 'Network error.';
                } else {
                    errorMessage += 'Please try again.';
                }

                Swal.fire({
                    title: "Error",
                    text: errorMessage,
                    icon: "error",
                    confirmButtonText: "Ok"
                });

                $specSelect.empty().append('<option value="" disabled selected>Error Loading</option>').trigger('change');
            }
        });
    };

    // ✅ Initialize conditional fields - works for both apply and edit pages
    const initializeConditionalFields = () => {
        console.log('Initializing conditional fields...');

        // Disaster experience
        $('input[name="disaster_experience"]').on('change', function() {
            const value = $(this).val();
            console.log('Disaster experience changed to:', value);

            // Support both wrapper IDs (apply-mission and edit-application)
            const $wrapper = $('#disaster_experience_description_wrapper, #disaster_experience_description_row');
            const $field = $('#disaster_experience_description');

            if (value === 'yes') {
                $wrapper.removeClass('d-none').show();
                $field.prop('disabled', false);
                console.log('Showing disaster description field');
            } else {
                $wrapper.addClass('d-none').hide();
                $field.prop('disabled', true).val('');
                console.log('Hiding disaster description field');
            }
        });

        // Volunteer experience
        $('input[name="volunteer_experience"]').on('change', function() {
            const value = $(this).val();
            console.log('Volunteer experience changed to:', value);

            // Support both wrapper IDs
            const $wrapper = $('#volunteer_experience_description_wrapper, #volunteer_experience_description_row');
            const $field = $('#volunteer_experience_description');

            if (value === 'yes') {
                $wrapper.removeClass('d-none').show();
                $field.prop('disabled', false);
                console.log('Showing volunteer description field');
            } else {
                $wrapper.addClass('d-none').hide();
                $field.prop('disabled', true).val('');
                console.log('Hiding volunteer description field');
            }
        });

        // Gaza visit
        $('input[name="visited_gaza"]').on('change', function() {
            const value = $(this).val();
            console.log('Visited Gaza changed to:', value);

            // Support both wrapper IDs
            const $wrapper = $('#place_of_work_wrapper, #place_of_work_row');
            const $field = $('#place_of_work_previous_visit');

            if (value === 'yes') {
                $wrapper.removeClass('d-none').show();
                $field.prop('disabled', false);
                console.log('Showing place of work field');
            } else {
                $wrapper.addClass('d-none').hide();
                $field.prop('disabled', true).val('');
                console.log('Hiding place of work field');
            }
        });

        // ✅ Trigger change on page load to set initial state
        setTimeout(function() {
            $('input[name="disaster_experience"]:checked').trigger('change');
            $('input[name="volunteer_experience"]:checked').trigger('change');
            $('input[name="visited_gaza"]:checked').trigger('change');
        }, 100);

        console.log('Conditional fields initialized successfully!');
    };

    // Initialize form repeater for doctors
    const initializeRepeater = () => {
        if (typeof $.fn.repeater === 'function') {
            $('#doctors_repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'doctor_name': '',
                    'visited_date': ''
                },
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
            console.log('Form repeater initialized');
        }
    };

    // Initialize file upload handling
    const initializeFileUpload = () => {
        const MAX_FILES = 10;
        const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB
        let selectedFiles = [];

        $('#file_input_temp').on('change', function(e) {
            const newFiles = Array.from(e.target.files);

            if (selectedFiles.length + newFiles.length > MAX_FILES) {
                Swal.fire({
                    text: `You can only upload a maximum of ${MAX_FILES} files.`,
                    icon: "warning",
                    confirmButtonText: "Ok"
                });
                return;
            }

            newFiles.forEach(file => {
                if (file.size > MAX_FILE_SIZE) {
                    Swal.fire({
                        text: `File "${file.name}" exceeds 5MB limit.`,
                        icon: "warning",
                        confirmButtonText: "Ok"
                    });
                    return;
                }
                selectedFiles.push(file);
            });

            updateFilePreview();
            $(this).val('');
        });

        function updateFilePreview() {
            const previewContainer = $('#file_preview');
            const inputsContainer = $('#file_inputs_container');

            previewContainer.empty();
            inputsContainer.empty();

            selectedFiles.forEach((file, index) => {
                const fileItem = $(`
                    <div class="file-item">
                        <div class="file-item-info">
                            <i class="ki-duotone ki-file fs-2x">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div>
                                <div class="fw-bold">${file.name}</div>
                                <div class="text-muted fs-7">${(file.size / 1024).toFixed(2)} KB</div>
                            </div>
                        </div>
                        <span class="file-remove-btn" data-index="${index}">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                `);
                previewContainer.append(fileItem);

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                const fileInput = $(`<input type="file" name="files[]" class="d-none" />`);
                fileInput[0].files = dataTransfer.files;
                inputsContainer.append(fileInput);
            });

            $('.file-remove-btn').on('click', function() {
                const index = $(this).data('index');
                selectedFiles.splice(index, 1);
                updateFilePreview();
            });
        }
    };

    // ✅ Handle form submission with improved error display
    const handleFormSubmit = () => {
        const form = document.getElementById('apply_mission_form');
        const submitButton = document.getElementById('submit_btn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const humanTypeId = $('#human_type').val();
            if (!humanTypeId || humanTypeId === '' || humanTypeId === 'null') {
                Swal.fire({
                    title: 'Cannot Submit',
                    text: 'Your staff type is missing. Please contact the administrator.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                return false;
            }

            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            const formData = new FormData(form);

            console.log('Submitting application...');

            $.ajax({
                url: '/apply_to_mission',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;

                    console.log('Application submitted successfully:', response);

                    if (response.status === 'success') {
                        Swal.fire({
                            text: response.message || "Application submitted successfully!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(() => {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        });
                    } else {
                        Swal.fire({
                            text: response.message || "Something went wrong!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;

                    console.error('Application submission error:', xhr.responseJSON);

                    let errorHtml = '';

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        const errorList = [];

                        // Collect all errors
                        for (let field in errors) {
                            errors[field].forEach(err => {
                                errorList.push(err);
                            });
                        }

                        // ✅ Display errors nicely
                        if (errorList.length > 0) {
                            errorHtml = '<div class="text-start">';
                            errorHtml += '<p class="fw-bold mb-3">Please correct the following errors:</p>';
                            errorHtml += '<ul class="text-danger" style="list-style: none; padding: 0;">';

                            errorList.forEach(err => {
                                errorHtml += `<li class="mb-2">
                                    <i class="ki-duotone ki-cross-circle fs-4 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    ${err}
                                </li>`;
                            });

                            errorHtml += '</ul></div>';
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorHtml = xhr.responseJSON.message;
                    } else {
                        errorHtml = "An error occurred while submitting your application. Please try again.";
                    }

                    // ✅ Beautiful display with SweetAlert2
                    Swal.fire({
                        title: 'Validation Error',
                        html: errorHtml,
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        },
                        width: '600px'
                    });
                }
            });

            return false;
        });
    };

    // Public methods
    return {
        init: function() {
            console.log('=== Apply Mission Page Initialization ===');

            initializeSelect2();

            setTimeout(function() {
                loadSpecializationsOnInit();
            }, 300);

            initializeConditionalFields();
            initializeRepeater();
            initializeFileUpload();
            handleFormSubmit();

            console.log('Apply Mission Page initialized successfully!');
        }
    };
}();

// Initialize when DOM is ready
if (typeof KTUtil !== 'undefined') {
    KTUtil.onDOMContentLoaded(function() {
        KTApplyMission.init();
    });
} else {
    $(document).ready(function() {
        KTApplyMission.init();
    });
}
