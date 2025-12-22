console.log('show_task')


$(document).ready(function () {
    $('#task_status').change(function () {
        // Get the selected value
        var selectedValue = $(this).val();
        console.log('selectedValue: ', selectedValue);
        if (selectedValue == '2' || selectedValue == '5') {
            $('#reason')[0].style.setProperty('display', 'block', 'important');

        } else {
            $('#reason')[0].style.setProperty('display', 'none', 'important');
            $('#myTextarea').val('');

        }
    });
});
