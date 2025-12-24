"use strict";

// Calendar Page Handler
var KTAppCalendar = function () {
    var calendarEl;
    var calendar;

    // Initialize FullCalendar
    const initCalendar = () => {
        calendarEl = document.getElementById("kt_calendar_app");

        if (!calendarEl) {
            console.error("Calendar element not found");
            return;
        }

        var today = moment().startOf("day");
        var todayDate = today.format("YYYY-MM-DD");

        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },
            initialDate: todayDate,
            navLinks: true,
            selectable: false,
            selectMirror: true,

            // Handle event click - redirect to apply page
            eventClick: function (info) {
                var missionId = info.event.id;
                var durationState = info.event.extendedProps.duration_state;

                console.log('Mission clicked:', missionId, 'Status:', durationState);

                // Only allow applying to active missions
                if (durationState === 1) {
                    // Redirect to apply page
                    window.location.href = '/apply-mission/' + missionId;
                } else {
                    // Show info message for non-active missions
                    var statusText = durationState === 0 ? 'Pending' : 'Completed';

                    Swal.fire({
                        title: info.event.title,
                        html: `
                            <div style="text-align: left;">
                                <p><strong>Status:</strong> ${statusText}</p>
                                <p><strong>Start:</strong> ${moment(info.event.start).format('DD/MM/YYYY')}</p>
                                <p><strong>End:</strong> ${moment(info.event.end).format('DD/MM/YYYY')}</p>
                                <p><strong>Description:</strong> ${info.event.extendedProps.description || 'N/A'}</p>
                                <p><strong>Location:</strong> ${info.event.extendedProps.location || 'N/A'}</p>
                            </div>
                        `,
                        icon: "info",
                        buttonsStyling: false,
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            },

            editable: false,
            dayMaxEvents: true,

            // Fetch events from server
            events: function (fetchInfo, successCallback, failureCallback) {
                console.log('Fetching events from /publish_tasks...');

                fetch('/publish_tasks')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Events fetched:', data.length);

                        const events = data.map(event => {
                            // Determine color based on status
                            var eventColor = '#3788d8'; // default blue
                            if (event.duration_state === 1) {
                                eventColor = '#50cd89'; // green for active
                            } else if (event.duration_state === 0) {
                                eventColor = '#ffc700'; // yellow for pending
                            } else if (event.duration_state === 2) {
                                eventColor = '#7239ea'; // purple for completed
                            }

                            return {
                                id: event.id.toString(),
                                title: event.title || 'No Title',
                                start: event.start,
                                end: event.end,
                                allDay: true,
                                backgroundColor: eventColor,
                                borderColor: eventColor,
                                extendedProps: {
                                    description: `Mission: ${event.title}` || '',
                                    location: event.contact_name + (event.contact_phone ? `, ${event.contact_phone}` : '') || '',
                                    duration_state: event.duration_state !== undefined ? event.duration_state : null,
                                    contact_name: event.contact_name || '',
                                    contact_phone: event.contact_phone || ''
                                }
                            };
                        });

                        successCallback(events);
                    })
                    .catch(error => {
                        console.error('Error fetching events:', error);

                        Swal.fire({
                            text: "Failed to load missions. Please refresh the page.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                        failureCallback(error);
                    });
            },

            datesSet: function () {
                console.log('Calendar dates rendered');
            }
        });

        calendar.render();
        console.log("Calendar initialized and rendered successfully");
    };

    // Public methods
    return {
        init: function () {
            console.log('Initializing Calendar Page...');

            // Check for required plugins
            if (typeof FullCalendar === 'undefined') {
                console.error("FullCalendar plugin not loaded");
                return;
            }
            if (typeof Swal === 'undefined') {
                console.error("SweetAlert2 plugin not loaded");
                return;
            }
            if (typeof moment === 'undefined') {
                console.error("Moment.js not loaded");
                return;
            }

            // Initialize calendar
            initCalendar();

            console.log('Calendar Page initialized successfully!');
        }
    };
}();

// Initialize when DOM is ready
KTUtil.onDOMContentLoaded(() => {
    KTAppCalendar.init();
});
