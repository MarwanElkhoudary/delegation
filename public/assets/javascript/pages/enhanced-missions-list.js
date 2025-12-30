/**
 * ============================================
 * ENHANCED MISSIONS LIST - JAVASCRIPT
 * Responsive DataTable with Mobile Card View
 * ============================================
 */

"use strict";

var EnhancedMissionsTable = function() {
    // Private variables
    var table;
    var dt;
    var statsData = {
        total: 0,
        active: 0,
        pending: 0,
        completed: 0
    };

    /**
     * Update statistics cards with animation
     */
    var updateStatistics = function(data) {
        statsData.total = data.length;
        statsData.active = data.filter(item => item.status === 'Ongoing').length;
        statsData.pending = data.filter(item => item.status === 'Recently').length;
        statsData.completed = data.filter(item => item.status === 'Completed').length;

        // Animate counters
        animateCounter('totalMissions', statsData.total);
        animateCounter('activeMissions', statsData.active);
        animateCounter('pendingMissions', statsData.pending);
        animateCounter('completedMissions', statsData.completed);
    };

    /**
     * Animate counter with smooth transition
     */
    var animateCounter = function(elementId, targetValue) {
        const element = document.getElementById(elementId);
        if (!element) return;

        const duration = 1000;
        const steps = 30;
        const stepValue = targetValue / steps;
        let currentValue = 0;

        const interval = setInterval(function() {
            currentValue += stepValue;
            if (currentValue >= targetValue) {
                element.textContent = targetValue;
                clearInterval(interval);
            } else {
                element.textContent = Math.floor(currentValue);
            }
        }, duration / steps);
    };

    /**
     * Format priority badge with icon
     */
    var formatPriority = function(priority) {
        const priorityClasses = {
            'high': 'high',
            'medium': 'medium',
            'low': 'low'
        };

        const priorityIcons = {
            'high': '<i class="ki-duotone ki-arrow-up fs-3"><span class="path1"></span><span class="path2"></span></i>',
            'medium': '<i class="ki-duotone ki-minus fs-3"><span class="path1"></span></i>',
            'low': '<i class="ki-duotone ki-arrow-down fs-3"><span class="path1"></span><span class="path2"></span></i>'
        };

        return `<span class="badge-enhanced priority-badge ${priorityClasses[priority] || 'medium'}">
            ${priorityIcons[priority] || ''} ${priority.toUpperCase()}
        </span>`;
    };

    /**
     * Format status badge with icon and tooltip
     */
    var formatStatus = function(status, note) {
        const statusConfig = {
            'Recently': { color: 'primary', icon: 'ki-time' },
            'Suspended': { color: 'dark', icon: 'ki-pause-circle' },
            'Rejected': { color: 'danger', icon: 'ki-cross-circle' },
            'Ongoing': { color: 'warning', icon: 'ki-loading' },
            'Completed': { color: 'success', icon: 'ki-check-circle' },
            'Approved': { color: 'info', icon: 'ki-verify' }
        };

        const config = statusConfig[status] || statusConfig['Recently'];
        const tooltip = note ? `data-bs-toggle="tooltip" title="${note}"` : '';

        return `<span class="badge badge-light-${config.color} badge-enhanced" ${tooltip}>
            <i class="ki-duotone ${config.icon} fs-5"><span class="path1"></span><span class="path2"></span></i>
            ${status}
        </span>`;
    };

    /**
     * Format timeline display
     */
    var formatTimeline = function(startDate, endDate) {
        return `
            <div class="d-flex flex-column gap-1">
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-calendar fs-5 text-success"><span class="path1"></span><span class="path2"></span></i>
                    <span class="fw-semibold text-success" style="font-size: 0.85rem;">${startDate}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-calendar fs-5 text-danger"><span class="path1"></span><span class="path2"></span></i>
                    <span class="fw-semibold text-danger" style="font-size: 0.85rem;">${endDate}</span>
                </div>
            </div>
        `;
    };

    /**
     * Format contact information
     */
    var formatContactInfo = function(name, phone) {
        return `
            <div class="d-flex flex-column gap-1">
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-user fs-5 text-primary"><span class="path1"></span><span class="path2"></span></i>
                    <span class="fw-semibold" style="font-size: 0.85rem;">${name}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-phone fs-5 text-primary"><span class="path1"></span><span class="path2"></span></i>
                    <span class="text-muted" style="font-size: 0.85rem;">${phone}</span>
                </div>
            </div>
        `;
    };

    /**
     * Format action buttons
     */
    var formatActions = function(row) {
        const disabled = row.status !== 'Recently';
        const disabledAttr = disabled ? 'aria-disabled="true"' : '';
        const disabledClass = disabled ? 'disabled opacity-50' : '';

        return `
            <div class="action-btn-group">
                <a href="${BASE_URL}/missions/view_mission/${row.id}"
                   class="action-btn view"
                   data-bs-toggle="tooltip"
                   title="View Details">
                    <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                </a>

                <a href="${BASE_URL}/missions/edit_mission/${row.id}"
                   class="action-btn edit ${disabledClass}"
                   ${disabledAttr}
                   data-bs-toggle="tooltip"
                   title="${disabled ? 'Cannot edit - Status is not Recently' : 'Edit Mission'}">
                    <i class="ki-duotone ki-notepad-edit fs-4"><span class="path1"></span><span class="path2"></span></i>
                </a>

                <a href="${BASE_URL}/missions/delete_mission/${row.id}"
                   class="action-btn delete ${disabledClass}"
                   ${disabledAttr}
                   data-bs-toggle="tooltip"
                   title="${disabled ? 'Cannot delete - Status is not Recently' : 'Delete Mission'}"
                   onclick="return confirm('Are you sure you want to delete this mission?');">
                    <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                </a>
            </div>
        `;
    };

    /**
     * Create mobile card view
     */
    var createMobileCard = function(row, index) {
        return `
            <div class="mobile-mission-card animate__animated animate__fadeInUp" style="animation-delay: ${index * 0.05}s;">
                <div class="mobile-card-header">
                    <div>
                        <div class="mobile-card-title">Mission #${row.id}</div>
                        <div class="mobile-card-id">${row.target}</div>
                    </div>
                    ${formatStatus(row.status, row.note)}
                </div>

                <div class="mobile-card-body">
                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-abstract-26 fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Specialization</div>
                            <div class="mobile-info-value">${row.target}</div>
                        </div>
                    </div>

                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-flag fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Priority</div>
                            <div class="mobile-info-value">${formatPriority(row.priority)}</div>
                        </div>
                    </div>

                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-user fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Contact Person</div>
                            <div class="mobile-info-value">${row.contact_name}</div>
                            <div class="text-muted" style="font-size: 0.85rem; margin-top: 0.25rem;">
                                <i class="ki-duotone ki-phone fs-6"><span class="path1"></span><span class="path2"></span></i>
                                ${row.contact_phone}
                            </div>
                        </div>
                    </div>

                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Timeline</div>
                            <div class="mobile-info-value">
                                <span class="text-success">${row.start_date}</span>
                                <i class="ki-outline ki-arrow-right fs-6 text-muted mx-1"></i>
                                <span class="text-danger">${row.end_date}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mobile-card-footer">
                    <div class="text-muted" style="font-size: 0.85rem;">
                        <i class="ki-duotone ki-hospital fs-5"><span class="path1"></span><span class="path2"></span></i>
                        ${row.requestTarget}
                    </div>
                    ${formatActions(row)}
                </div>
            </div>
        `;
    };

    /**
     * Update mobile cards container
     */
    var updateMobileCards = function(data) {
        const container = $('#mobileCardsContainer');
        container.empty();

        if (data.length === 0) {
            container.html(`
                <div class="empty-state">
                    <i class="ki-duotone ki-file-deleted empty-state-icon">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <h4 class="empty-state-title">No Missions Found</h4>
                    <p class="empty-state-text">Try adjusting your filters or create a new mission</p>
                </div>
            `);
            return;
        }

        data.forEach((row, index) => {
            container.append(createMobileCard(row, index));
        });

        // Initialize tooltips for mobile cards
        $('[data-bs-toggle="tooltip"]').tooltip();
    };

    /**
     * Initialize DataTable
     */
    var initDatatable = function() {
        // Show loading
        $('#loadingOverlay').show();

        dt = $("#kt_missions_table").DataTable({
            responsive: false,
            searchDelay: 500,
            processing: true,
            serverSide: false,
            order: [[1, 'desc']],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            pageLength: 25,
            language: {
                processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                lengthMenu: "Show _MENU_ missions",
                info: "Showing _START_ to _END_ of _TOTAL_ missions",
                infoEmpty: "Showing 0 to 0 of 0 missions",
                infoFiltered: "(filtered from _MAX_ total missions)",
                search: "",
                searchPlaceholder: "Search missions...",
                zeroRecords: "No matching missions found",
                paginate: {
                    first: '<i class="ki-outline ki-double-left fs-3"></i>',
                    last: '<i class="ki-outline ki-double-right fs-3"></i>',
                    previous: '<i class="ki-outline ki-left fs-3"></i>',
                    next: '<i class="ki-outline ki-right fs-3"></i>'
                }
            },
            ajax: {
                url: BASE_URL + '/missions/list',
                type: 'POST',
                data: {"_token": TOKEN},
                dataSrc: function(json) {
                    // Hide loading
                    $('#loadingOverlay').hide();

                    // Update statistics
                    updateStatistics(json.data);

                    // Update mobile cards
                    updateMobileCards(json.data);

                    // Show/hide empty state
                    if (json.data.length === 0) {
                        $('#emptyState').removeClass('d-none');
                        $('.table-responsive').hide();
                    } else {
                        $('#emptyState').addClass('d-none');
                        $('.table-responsive').show();
                    }

                    return json.data;
                },
                error: function(xhr, error, code) {
                    $('#loadingOverlay').hide();
                    console.error('Error loading missions:', error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error Loading Data',
                        text: 'Failed to load missions. Please refresh the page.',
                        confirmButtonColor: '#1e3c72'
                    });
                }
            },
            columns: [
                { data: 'id' },
                { data: 'id' },
                { data: 'target' },
                { data: 'priority' },
                { data: 'requestTarget' },
                { data: 'contact_name' },
                { data: 'start_date' },
                { data: 'status' },
                { data: null }
            ],
            columnDefs: [
                {
                    // Column 0: Row number
                    targets: 0,
                    className: 'text-center fw-bold',
                    render: function(data, type, row, meta) {
                        return `<span class="badge badge-light-primary">${meta.row + meta.settings._iDisplayStart + 1}</span>`;
                    }
                },
                {
                    // Column 1: Mission ID
                    targets: 1,
                    render: function(data, type, row) {
                        return `<a href="${BASE_URL}/missions/view_mission/${row.id}" class="text-primary fw-bold text-hover-dark">#${data}</a>`;
                    }
                },
                {
                    // Column 2: Specialization
                    targets: 2,
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex align-items-center gap-2">
                                <i class="ki-duotone ki-abstract-26 fs-2 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <a href="${BASE_URL}/missions/view_mission/${row.id}" class="text-gray-800 text-hover-primary fw-semibold">${data}</a>
                            </div>
                        `;
                    }
                },
                {
                    // Column 3: Priority
                    targets: 3,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return formatPriority(data);
                    }
                },
                {
                    // Column 4: Target
                    targets: 4,
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex align-items-center gap-2">
                                <i class="ki-duotone ki-geolocation fs-2 text-success">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="fw-semibold">${data}</span>
                            </div>
                        `;
                    }
                },
                {
                    // Column 5: Contact Info
                    targets: 5,
                    render: function(data, type, row) {
                        return formatContactInfo(row.contact_name, row.contact_phone);
                    }
                },
                {
                    // Column 6: Timeline
                    targets: 6,
                    render: function(data, type, row) {
                        return formatTimeline(row.start_date, row.end_date);
                    }
                },
                {
                    // Column 7: Status
                    targets: 7,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return formatStatus(data, row.note);
                    }
                },
                {
                    // Column 8: Actions
                    targets: 8,
                    className: 'text-center',
                    orderable: false,
                    render: function(data, type, row) {
                        return formatActions(row);
                    }
                }
            ],
            drawCallback: function() {
                // Initialize tooltips
                $('[data-bs-toggle="tooltip"]').tooltip();

                // Initialize Metronic menu
                KTMenu.createInstances();
            }
        });

        table = dt.$;
    };

    /**
     * Setup filter handlers
     */
    var setupFilters = function() {
        // Custom search
        $('#searchInput').on('keyup', function() {
            dt.search(this.value).draw();
        });

        // Status filter
        $('#statusFilter').on('change', function() {
            dt.column(7).search(this.value).draw();
        });

        // Priority filter
        $('#priorityFilter').on('change', function() {
            dt.column(3).search(this.value).draw();
        });

        // Reset filters
        $('#resetFilters').on('click', function() {
            $('#searchInput').val('');
            $('#statusFilter').val('');
            $('#priorityFilter').val('');
            dt.search('').columns().search('').draw();
        });
    };

    /**
     * Public methods
     */
    return {
        init: function() {
            initDatatable();
            setupFilters();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    EnhancedMissionsTable.init();
});

// Auto-dismiss alerts after 5 seconds
setTimeout(function() {
    $('.alert-dismissible').fadeOut('slow', function() {
        $(this).remove();
    });
}, 5000);
