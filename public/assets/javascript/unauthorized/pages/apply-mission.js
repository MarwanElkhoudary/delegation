"use strict";

// Apply Mission Page Handler
var KTApplyMission = function () {

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

        console.log('Auto-loading specializations for role:', humanTypeId);

        if (humanTypeId) {
            loadSpecializations(humanTypeId);
        }
    };

    // Load specializations for given human type
    const loadSpecializations = (humanTypeId) => {
        var $specSelect = $('#specialization');

        console.log('Loading specializations for human_type:', humanTypeId);

        $.ajax({
            url: '/get_specialization',
            type: 'POST',
            data: {
                HUMAN_TYPE: humanTypeId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            beforeSend: function() {
                $specSelect.prop('disabled', true);
                $specSelect.next('.spinner-border').remove();
                $specSelect.parent().append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
            },
            success: function(response) {
                $specSelect.prop('disabled', false);
                $('.spinner-border').remove();

                console.log('Specialization response:', response);

                if (response.status === 'success' && response.data && response.data.length > 0) {
                    $specSelect.empty().append('<option value="" disabled selected>Select Your Specialization</option>');

                    $.each(response.data, function(index, spec) {
                        $specSelect.append('<option value="' + spec.id + '">' + spec.name + '</option>');
                    });

                    $specSelect.trigger('change');
                } else {
                    Swal.fire({
                        text: "No specializations found for this role.",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    $specSelect.empty().append('<option value="" disabled selected>Select Your Specialization</option>').trigger('change');
                }
            },
            error: function(xhr, status, error) {
                $specSelect.prop('disabled', false);
                $('.spinner-border').remove();
                console.error('AJAX Error:', error, xhr);

                Swal.fire({
                    text: "Failed to load specializations. Please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                $specSelect.empty().append('<option value="" disabled selected>Select Your Specialization</option>').trigger('change');
            }
        });
    };

    // Toggle conditional field visibility
    const toggleField = (yesRadio, noRadio, row, field) => {
        if (row && field) {
            if (yesRadio && yesRadio.checked) {
                row.style.display = 'block';
                field.setAttribute('required', 'required');
            } else {
                row.style.display = 'none';
                field.removeAttribute('required');
                field.value = '';
            }
        }
    };

    // Initialize conditional fields
    const initializeConditionalFields = () => {
        // Disaster Experience Toggle
        const yesRadioDisaster = document.getElementById('disaster_experience_yes');
        const noRadioDisaster = document.getElementById('disaster_experience_no');
        const descriptionRowDisaster = document.getElementById('disaster_experience_description_row');
        const descriptionTextareaDisaster = document.getElementById('disaster_experience_description');

        function toggleDisasterDescriptionField() {
            toggleField(yesRadioDisaster, noRadioDisaster, descriptionRowDisaster, descriptionTextareaDisaster);
        }

        if (yesRadioDisaster && noRadioDisaster) {
            yesRadioDisaster.addEventListener('change', toggleDisasterDescriptionField);
            noRadioDisaster.addEventListener('change', toggleDisasterDescriptionField);
            toggleDisasterDescriptionField();
        }

        // Volunteer Experience Toggle
        const yesRadioVolunteer = document.getElementById('volunteer_experience_yes');
        const noRadioVolunteer = document.getElementById('volunteer_experience_no');
        const descriptionRowVolunteer = document.getElementById('volunteer_experience_description_row');
        const descriptionTextareaVolunteer = document.getElementById('volunteer_experience_description');

        function toggleVolunteerDescriptionField() {
            toggleField(yesRadioVolunteer, noRadioVolunteer, descriptionRowVolunteer, descriptionTextareaVolunteer);
        }

        if (yesRadioVolunteer && noRadioVolunteer) {
            yesRadioVolunteer.addEventListener('change', toggleVolunteerDescriptionField);
            noRadioVolunteer.addEventListener('change', toggleVolunteerDescriptionField);
            toggleVolunteerDescriptionField();
        }
    };

    // Initialize form repeater
    const initializeRepeater = () => {
        console.log('Initializing repeater...');

        const repeaterElement = $('#kt_docs_repeater_basic_doctors');
        console.log('Repeater element found:', repeaterElement.length > 0);

        if (repeaterElement.length === 0) {
            console.error('Repeater element not found!');
            return;
        }

        try {
            repeaterElement.repeater({
                initEmpty: false,
                show: function () {
                    console.log('Show new item');
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    console.log('Delete item');
                    $(this).slideUp(deleteElement);
                }
            });
            console.log('Form repeater initialized successfully');
        } catch (e) {
            console.error('Error initializing repeater:', e);
        }
    };

    // Handle file uploads with preview
    const initializeFileUpload = () => {
        const fileInput = document.getElementById('file_input_temp');
        const filePreview = document.getElementById('file_preview');
        const fileInputsContainer = document.getElementById('file_inputs_container');
        let selectedFiles = [];
        const MAX_FILES = 10;
        const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB

        if (!fileInput || !filePreview || !fileInputsContainer) {
            console.error('File upload elements not found', {
                fileInput: !!fileInput,
                filePreview: !!filePreview,
                fileInputsContainer: !!fileInputsContainer
            });
            return;
        }

        console.log('File upload elements found, initializing...');

        fileInput.addEventListener('change', function(e) {
            console.log('File input changed, files:', e.target.files.length);
            const newFiles = Array.from(e.target.files);

            if (newFiles.length === 0) {
                console.log('No files selected');
                return;
            }

            // Check if adding these files would exceed the limit
            if (selectedFiles.length + newFiles.length > MAX_FILES) {
                Swal.fire({
                    text: `You can only upload a maximum of ${MAX_FILES} files. You currently have ${selectedFiles.length} file(s) selected.`,
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                fileInput.value = '';
                return;
            }

            // Validate each file
            let invalidFiles = [];
            newFiles.forEach(file => {
                if (file.size > MAX_FILE_SIZE) {
                    invalidFiles.push(file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + 'MB)');
                }
            });

            if (invalidFiles.length > 0) {
                Swal.fire({
                    html: `The following files exceed 5MB:<br><br>${invalidFiles.join('<br>')}`,
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                fileInput.value = '';
                return;
            }

            // Add new files to the selected files array
            newFiles.forEach(file => {
                selectedFiles.push(file);
            });

            console.log('Files added. Total:', selectedFiles.length);

            // Clear the temp input
            fileInput.value = '';

            // Update the display and actual inputs
            updateDisplay();
        });

        // Use event delegation for remove buttons
        filePreview.addEventListener('click', function(e) {
            if (e.target.classList.contains('file-item-remove')) {
                const index = parseInt(e.target.closest('.file-item').getAttribute('data-index'));
                console.log('Remove button clicked for index:', index);
                removeFile(index);
            }
        });

        function removeFile(index) {
            console.log('Removing file at index:', index);
            if (index >= 0 && index < selectedFiles.length) {
                const removedFile = selectedFiles[index];
                console.log('Removing file:', removedFile.name);
                selectedFiles.splice(index, 1);
                updateDisplay();
                console.log('File removed. Remaining:', selectedFiles.length);
            } else {
                console.error('Invalid index:', index, 'Total files:', selectedFiles.length);
            }
        }

        function updateDisplay() {
            console.log('Updating display with', selectedFiles.length, 'files');

            // Update preview
            if (selectedFiles.length === 0) {
                filePreview.classList.remove('active');
                filePreview.innerHTML = '';
            } else {
                filePreview.classList.add('active');
                let html = '<div class="mb-2"><strong>Selected Files (' + selectedFiles.length + '/' + MAX_FILES + '):</strong></div>';

                selectedFiles.forEach(function(file, index) {
                    const fileSize = (file.size / 1024).toFixed(2);
                    const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
                    const displaySize = file.size >= 1048576 ? fileSizeMB + ' MB' : fileSize + ' KB';

                    // Escape HTML in filename
                    const safeName = file.name.replace(/</g, '&lt;').replace(/>/g, '&gt;');

                    html += '<div class="file-item" data-index="' + index + '">';
                    html += '<span class="file-item-name">' + safeName + '</span>';
                    html += '<span class="file-item-size">' + displaySize + '</span>';
                    html += '<span class="file-item-remove" title="Remove file">×</span>';
                    html += '</div>';
                });

                filePreview.innerHTML = html;
            }

            // Update actual file inputs
            fileInputsContainer.innerHTML = '';

            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'file';
            hiddenInput.name = 'files[]';
            hiddenInput.multiple = true;
            hiddenInput.style.display = 'none';
            hiddenInput.files = dataTransfer.files;

            fileInputsContainer.appendChild(hiddenInput);

            console.log('Actual inputs updated. Files in input:', hiddenInput.files.length);
        }

        console.log('File upload initialized successfully');
    };

    // Handle form submission with AJAX
    const handleFormSubmit = () => {
        const form = document.getElementById('apply_mission_form');
        const submitBtn = document.getElementById('submit_btn');

        if (!form || !submitBtn) {
            console.error('Form or submit button not found');
            return;
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // منع الإرسال العادي

            // Basic validation
            const requiredFields = form.querySelectorAll('[required]');
            let hasError = false;

            requiredFields.forEach(field => {
                if (!field.value || (field.type === 'radio' && !form.querySelector(`input[name="${field.name}"]:checked`))) {
                    hasError = true;
                }
            });

            if (hasError) {
                Swal.fire({
                    text: "Please fill in all required fields.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                return;
            }

            // Show loading state
            submitBtn.setAttribute('data-kt-indicator', 'on');
            submitBtn.disabled = true;

            console.log('Form submitting...');

            // إرسال الفورم بـ AJAX
            const formData = new FormData(form);

            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Success response:', response);

                    submitBtn.removeAttribute('data-kt-indicator');
                    submitBtn.disabled = false;

                    if (response.status === 'success') {
                        // عرض رسالة نجاح
                        Swal.fire({
                            text: response.message || "Application submitted successfully!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(function(result) {
                            // التحويل للصفحة المطلوبة بعد الضغط على OK
                            if (result.isConfirmed) {
                                if (response.redirect) {
                                    window.location.href = response.redirect;
                                } else {
                                    window.location.href = '/calendar';
                                }
                            }
                        });
                    } else {
                        // في حالة status مش success
                        Swal.fire({
                            text: response.message || "An error occurred",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error response:', xhr);

                    submitBtn.removeAttribute('data-kt-indicator');
                    submitBtn.disabled = false;

                    let errorMessage = 'An error occurred. Please try again.';

                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.message) {
                            errorMessage = '<h4 class="mb-4">' + xhr.responseJSON.message + '</h4>';
                        }

                        // عرض أخطاء الـ validation بطريقة منظمة
                        if (xhr.responseJSON.errors) {
                            let organizedErrors = xhr.responseJSON.errors;
                            let errorSections = '';

                            // عناوين الأقسام بالعربي
                            const sectionTitles = {
                                'basic_info': '📋 Basic Information',
                                'qualifications': '🎓 Academic Qualifications',
                                'experience': '💼 Professional Experience',
                                'other': '📌 Other Fields'
                            };

                            // عرض الأخطاء حسب الأقسام
                            $.each(organizedErrors, function(section, messages) {
                                if (messages.length > 0) {
                                    errorSections += '<div class="mb-4">';
                                    errorSections += '<h5 class="text-dark fw-bold mb-2">' + (sectionTitles[section] || section) + '</h5>';
                                    errorSections += '<ul class="text-start mb-0">';
                                    $.each(messages, function(index, message) {
                                        errorSections += '<li class="text-muted">' + message + '</li>';
                                    });
                                    errorSections += '</ul>';
                                    errorSections += '</div>';
                                }
                            });

                            errorMessage += errorSections;
                        }
                    }

                    Swal.fire({
                        html: errorMessage,
                        icon: "error",
                        width: '600px',
                        buttonsStyling: false,
                        confirmButtonText: "Ok, I'll fix it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            popup: 'text-start'
                        }
                    });
                }
            });
        });
    };

    // Public methods
    return {
        init: function () {
            console.log('Initializing Apply Mission Page...');

            // Check for required plugins
            if (typeof $.fn.select2 === 'undefined') {
                console.error("Select2 plugin not loaded");
                return;
            }
            if (typeof Swal === 'undefined') {
                console.error("SweetAlert2 plugin not loaded");
                return;
            }
            if (typeof $.fn.repeater === 'undefined') {
                console.error("Form Repeater plugin not loaded");
                return;
            }

            // Initialize all components
            initializeSelect2();

            // Auto-load specializations after Select2 is initialized
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
