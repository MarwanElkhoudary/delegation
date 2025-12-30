// const flatpickr = require("flatpickr");

const date = new Date();

let day = date.getDate();

console.log('day : ', day)

flatpickr("#start_date", {
    "locale": {
        // "firstDayOfWeek": 1 // start week on Monday
    }

});

flatpickr("#end_date", {});

$('#start_date').change(function () {
    let selected = $(this).val();
    console.log('s ', selected.split('-')[2])
    let month = selected.split('-')[1];
    let year = selected.split('-')[0];
    if (selected.split('-')[2] === '01') {

        let newdate = year + '-' + month + '-15';
        $('#end_date').val(newdate);
    } else if (selected.split('-')[2] === '16') {
        console.log('last day : ', lastday(year, month - 1))
        let newdate = year + '-' + month + '-' + lastday(year, month - 1);
        $('#end_date').val(newdate);
    }
});
var lastday = function (y, m) {
    // Create a new Date object representing the last day of the specified month
    // By passing m + 1 as the month parameter and 0 as the day parameter, it represents the last day of the specified month
    return new Date(y, m + 1, 0).getDate();
}

// $('#human_type').change(function() {
//     let human_type = $(this).val();
//     console.log('human_type', human_type)
//     console.log('token', TOKEN)
//     // console.log('gdsgsaga', $('meta[name="csrf-token"]').attr('content'))
//
//
//     $.ajax({
//         url: BASE_URL + '/missions/get_specialization',
//         data : {'HUMAN_TYPE':human_type, "_token": TOKEN},
//         type: "POST",
//         dataType: 'json',
//         success:function(result){
//             let html = JSON.stringify(result.data)
//             $("#Specialization_type").empty();
//
//             $("#Specialization_type").attr('disabled', false);
//             $.each(result.data,function(key, value)
//             {
//                 $("#Specialization_type").append('<option value=' + value.id + '>' + value.name + '</option>');
//             });
//         },
//         error: function (e){
//             console.log('error : ', e)
//         }
//
//     });
// })
$('#medical_needs_repeater').repeater({
    initEmpty: false,
    isFirstItemUndeletable: true,
    show: function () {
        $(this).slideDown();
    },
    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});

$('#additional_requirements_repeater').repeater({
    initEmpty: false,
    isFirstItemUndeletable: true,
    show: function () {
        $(this).slideDown();
    },
    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});


$(document).on('change', '.need-human-type', function () {
    var selectedValue = $(this).val();
    var $need_specialization = $(this).closest('div[data-repeater-item]').find('.need-specialization');
    if (selectedValue) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/missions/get_specialization',
            data: {'HUMAN_TYPE': selectedValue, "_token": TOKEN},
            dataType: 'json',
            success: function (result) {
                // let html = JSON.stringify(result.data)
                var select = $need_specialization;
                select.empty();
                select.html('');
                select.attr('disabled', false);
                select.append('<option value="">Select an option</option>');
                $.each(result.data, function (key, value) {
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
                select.select2();
            },
            error: function (e) {
                console.log('error : ', e)
            }
        });
    }
});

