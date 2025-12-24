// Get the current URL path and extract the task ID
const path = window.location.pathname;
const segments = path.split('/');
const id = segments.pop() || segments.pop();
console.log('Task ID:', id);

let result_arr = [];

// Fetch medical needs data asynchronously (optional, for logging)
function fetchMedicalNeeds() {
    return new Promise((resolve, reject) => {
        if (id) {
            console.log('Fetching medical needs from:', BASE_URL + '/tasks/medical_needs/' + id);
            $.ajax({
                type: 'GET',
                url: BASE_URL + '/tasks/medical_needs/' + id,
                dataType: 'json',
                success: function (mm) {
                    console.log('Medical Needs Data:', mm);
                    result_arr = mm || [];
                    resolve(result_arr);
                },
                error: function (e) {
                    console.error('Error fetching medical needs:', e);
                    reject(e);
                }
            });
        } else {
            console.warn('No task ID found, resolving with empty array');
            resolve([]);
        }
    });
}

$(document).ready(function () {
    console.log('Document ready - Initializing repeaters');
    console.log('jQuery version:', $.fn.jquery);
    console.log('Select2 loaded:', typeof $.fn.select2);
    console.log('Form Repeater loaded:', typeof $.fn.repeater);
    console.log('BASE_URL:', BASE_URL);
    console.log('TOKEN:', TOKEN);

    // تهيئة Flatpickr لحقلي تاريخ البداية والنهاية
    document.addEventListener('DOMContentLoaded', function () {
        // تهيئة Flatpickr لتاريخ البداية
        flatpickr("#start_date", {
            dateFormat: "d/m/Y", // الصيغة المطلوبة (مثل DD/MM/YYYY)
            altInput: true, // يسمح بعرض صيغة بديلة للمستخدم
            altFormat: "d/m/Y", // الصيغة المعروضة للمستخدم
            defaultDate: document.querySelector("#start_date").value || null, // القيمة الافتراضية
        });

        // تهيئة Flatpickr لتاريخ النهاية
        flatpickr("#end_date", {
            dateFormat: "d/m/Y", // نفس الصيغة
            altInput: true,
            altFormat: "d/m/Y",
            defaultDate: document.querySelector("#end_date").value || null,
        });
    });

    // Function to safely initialize Select2 on a single element
    function initializeSelect2($element) {
        if ($element.hasClass('select2-hidden-accessible')) {
            console.log('Select2 already initialized for:', $element.attr('name'), '- destroying');
            $element.select2('destroy');
        }
        console.log('Initializing Select2 for:', $element.attr('name'));

        // Get the preselected value from the DOM
        const preselectedValue = $element.find('option[selected]').val() || $element.data('preselected-value');
        console.log('Preselected value for', $element.attr('name'), ':', preselectedValue);

        $element.select2({
            placeholder: "Select an option",
            allowClear: true
        });

        // Force Select2 to respect the preselected value
        if (preselectedValue) {
            console.log('Forcing Select2 to set preselected value for', $element.attr('name'), 'to:', preselectedValue);
            $element.val(preselectedValue).trigger('change.select2');
            const currentValue = $element.val();
            console.log('Current value after forcing preselection:', currentValue);
            if (currentValue !== preselectedValue) {
                console.error('Failed to set preselected value for', $element.attr('name'), '- Expected:', preselectedValue, 'Actual:', currentValue);
            }
        }
    }

    // Function to populate specialization_id dropdown
    function populateSpecializationDropdown($humanTypeSelect, $specializationSelect, itemIndex) {
        const selectedValue = $humanTypeSelect.val();
        console.log('Populating specialization for human_type_id:', selectedValue, 'Index:', itemIndex);
        if (!selectedValue) {
            console.warn('No human_type_id selected for index', itemIndex);
            $specializationSelect.empty().append('<option value="">Select human type first</option>');
            initializeSelect2($specializationSelect);
            return;
        }

        console.log('Making AJAX call to:', BASE_URL + '/tasks/get_specialization');
        console.log('With data:', { 'HUMAN_TYPE': selectedValue, "_token": TOKEN });
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/tasks/get_specialization',
            data: { 'HUMAN_TYPE': selectedValue, "_token": TOKEN },
            dataType: 'json',
            success: function (result) {
                console.log('Specializations received:', result);
                $specializationSelect.empty();
                $specializationSelect.append('<option value="">Select an option</option>');

                const specializations = result.data || [];
                if (specializations.length === 0) {
                    console.warn('No specializations received for human_type_id:', selectedValue);
                    $specializationSelect.empty().append('<option value="">No specializations available</option>');
                    initializeSelect2($specializationSelect);
                    return;
                }

                const specializationIds = specializations.map(item => String(item.id));
                console.log('Available specialization IDs for human_type_id ' + selectedValue + ':', specializationIds);

                $.each(specializations, function (key, value) {
                    $specializationSelect.append(`<option value="${value.id}">${value.name}</option>`);
                });

                initializeSelect2($specializationSelect);
            },
            error: function (e) {
                console.error('Error fetching specializations for human_type_id ' + selectedValue + ':', e);
                $specializationSelect.empty().append('<option value="">Error loading options</option>');
                initializeSelect2($specializationSelect);
            }
        });
    }

    // Initialize Medical Needs Repeater
    $('#medical_needs_repeater').repeater({
        initEmpty: false,
        defaultValues: {
            'medical_needs_list[human_type_id]': '',
            'medical_needs_list[specialization_id]': '',
            'medical_needs_list[count]': '',
            'medical_needs_list[note]': ''
        },
        isFirstItemUndeletable: true,
        show: function () {
            console.log('Adding new medical need item via show function');
            $(this).slideDown();

            const $allSelects = $(this).find('select');
            $allSelects.each(function() {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }
            });

            $(this).find('.need-human-type').val(null);
            $(this).find('.need-specialization').empty().append('<option value="">Select an option</option>');

            $(this).find('input[type="number"]').val('');
            $(this).find('input[type="text"]').val('');

            $(this).find('[data-control="select2"]').each(function() {
                initializeSelect2($(this));
            });
        },
        hide: function (deleteElement) {
            console.log('Removing medical need item');
            $(this).find('select').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }
            });
            $(this).slideUp(deleteElement);
        },
        ready: function (setIndexes) {
            console.log('Medical Needs Repeater initialized');
            $(document).off('change', '.need-human-type').on('change', '.need-human-type', function () {
                const $humanTypeSelect = $(this);
                const $needSpecialization = $humanTypeSelect.closest('div[data-repeater-item]').find('.need-specialization');
                const itemIndex = $humanTypeSelect.closest('div[data-repeater-item]').index();
                console.log('human_type_id changed to:', $humanTypeSelect.val(), 'Index:', itemIndex);
                populateSpecializationDropdown($humanTypeSelect, $needSpecialization, itemIndex);
            });
        }
    });

    // Initialize Additional Requirements Repeater
    if ($('#additional_requirements_repeater').length) {
        console.log('Found additional_requirements_repeater element');
        $('#additional_requirements_repeater').repeater({
            initEmpty: false,
            defaultValues: {
                'additional_requirements_list[requirement_id]': '',
                'additional_requirements_list[category_name]': '',
                'additional_requirements_list[count]': '',
                'additional_requirements_list[priority]': ''
            },
            isFirstItemUndeletable: true,
            show: function () {
                console.log('Adding new additional requirement item via show function');
                $(this).slideDown();

                const $allSelects = $(this).find('select');
                $allSelects.each(function() {
                    if ($(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }
                });

                $(this).find('select[name="additional_requirements_list[][requirement_id]"]').val(null);
                $(this).find('select[name="additional_requirements_list[][priority]"]').val(null);
                $(this).find('input[name="additional_requirements_list[][category_name]"]').val('');
                $(this).find('input[name="additional_requirements_list[][count]"]').val('');

                $(this).find('[data-control="select2"]').each(function() {
                    initializeSelect2($(this));
                });
            },
            hide: function (deleteElement) {
                console.log('Removing additional requirement item');
                $(this).find('select').each(function () {
                    if ($(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }
                });
                $(this).slideUp(deleteElement);
            },
            ready: function (setIndexes) {
                console.log('Additional Requirements Repeater initialized');
            }
        });
    } else {
        console.error('additional_requirements_repeater element not found in DOM');
    }

    // Initialize all Select2 elements in both repeaters
    console.log('Initializing Select2 for all repeater elements');
    $('#medical_needs_repeater [data-control="select2"]').each(function () {
        initializeSelect2($(this));
    });
    $('#additional_requirements_repeater [data-control="select2"]').each(function () {
        initializeSelect2($(this));
    });

    // Fetch medical needs data (optional, for logging)
    fetchMedicalNeeds().then(() => {
        console.log('result_arr after fetch:', result_arr);
    }).catch((error) => {
        console.error('Failed to fetch medical needs:', error);
    });

    // Initialize Select2 for non-repeater elements
    $('[data-control="select2"]').not('#medical_needs_repeater [data-control="select2"], #additional_requirements_repeater [data-control="select2"]').each(function () {
        initializeSelect2($(this));
    });
});
