// "use strict";
// var KTAppCalendar = function () {
//     let calendar;
//
//     // Fetch events from Laravel controller
//     const fetchEvents = (info, successCallback, failureCallback) => {
//         $.ajax({
//             url: BASE_URL + '/missions/get_events',
//             method: 'GET',
//             dataType: 'json',
//             success: function (events) {
//                 console.log('events :', events)
//                 successCallback(events);
//             },
//             error: function (jqXHR, textStatus, errorThrown) {
//                 failureCallback(new Error('AJAX error: ' + textStatus + ' - ' + errorThrown));
//             }
//         });
//     };
//
//     return {
//         init: function () {
//             const calendarEl = document.getElementById("kt_calendar_app");
//
//             calendar = new FullCalendar.Calendar(calendarEl, {
//                 headerToolbar: {
//                     left: "prev,next today",
//                     center: "title",
//                     right: "dayGridMonth,timeGridWeek,timeGridDay"
//                 },
//                 initialView: "dayGridMonth",
//                 editable: false,
//                 selectable: false,
//                 events: fetchEvents // Use function to load events via AJAX
//             });
//
//             calendar.render();
//         }
//     };
// }();
//
// KTAppCalendar.init();
"use strict";

var KTAppCalendar = function () {
    let calendar;

    // Fetch events from Laravel controller
    const fetchEvents = (info, successCallback, failureCallback) => {
        $.ajax({
            url: BASE_URL + '/missions/get_events',
            method: 'GET',
            data: {
                start: info.startStr, // Send date range to filter events
                end: info.endStr
            },
            dataType: 'json',
            success: function (events) {
                console.log('events :', events);
                successCallback(events);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                alert('Failed to load events. Please try again.');
                failureCallback(new Error('AJAX error: ' + textStatus + ' - ' + errorThrown));
            }
        });
    };

    return {
        init: function () {
            const calendarEl = document.getElementById("kt_calendar_app");
            const modalEl = document.getElementById("kt_modal_view_event");
            const modal = new bootstrap.Modal(modalEl); // Initialize Bootstrap 5 modal

            calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                initialView: "dayGridMonth",
                editable: false,
                selectable: false,
                events: fetchEvents,
                eventClick: function (info) {
                    // Prevent default behavior
                    info.jsEvent.preventDefault();

                    // Get event data
                    const event = info.event;
                    const contactName = event.extendedProps.contact_name || 'Unknown';
                    const contactPhone = event.extendedProps.contact_phone || 'No Phone';

                    // Populate modal fields
                    modalEl.querySelector('[data-kt-calendar="event_name"]').textContent = event.title;
                    modalEl.querySelector('[data-kt-calendar="event_start_date"]').textContent = event.start.toLocaleString();
                    modalEl.querySelector('[data-kt-calendar="event_end_date"]').textContent = event.end ? event.end.toLocaleString() : event.start.toLocaleString();
                    modalEl.querySelector('[data-kt-calendar="event_description"]').textContent = `Contact Person: ${contactName}, Phone: ${contactPhone}`;
                    modalEl.querySelector('[data-kt-calendar="event_location"]').textContent = contactName;
                    modalEl.querySelector('[data-kt-calendar="all_day"]').style.display = event.allDay ? 'inline-block' : 'none';

                    // Handle edit button
                    const editButton = modalEl.querySelector('#kt_modal_view_event_edit');
                    editButton.onclick = () => {
                        console.log('Edit event:', event.id);
                        // Example: Redirect to edit page
                        // window.location.href = `${BASE_URL}/missions/${event.id}/edit`;
                    };

                    // Handle delete button
                    const deleteButton = modalEl.querySelector('#kt_modal_view_event_delete');
                    deleteButton.onclick = () => {
                        if (confirm('Are you sure you want to delete this event?')) {
                            console.log('Delete event:', event.id);
                            // Example: AJAX delete request
                            /*
                            $.ajax({
                                url: BASE_URL + '/missions/' + event.id,
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: () => {
                                    calendar.refetchEvents();
                                    modal.hide();
                                }
                            });
                            */
                        }
                    };

                    // Show the modal
                    modal.show();
                }
            });

            calendar.render();
        }
    };
}();

KTAppCalendar.init();
