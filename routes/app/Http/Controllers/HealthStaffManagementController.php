<?php

namespace App\Http\Controllers;

use App\Models\HealthStaff;
use App\Models\HumanType;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HealthStaffManagementController extends Controller
{
    /**
     * Display a listing of all health staff applications
     * Route: /health_staff
     */
    public function index()
    {
        // جلب جميع الطلبات مع العلاقات
        $applications = HealthStaff::with([
            'user',
            'task',
            'humanType',
            'specialization',
            'applicationState'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(20);

        // إحصائيات سريعة
        $stats = [
            'total' => HealthStaff::count(),
            'pending' => HealthStaff::where('application_status', 'pending')->count(),
            'approved' => HealthStaff::where('application_status', 'approved')->count(),
            'rejected' => HealthStaff::where('application_status', 'rejected')->count(),
        ];

        return view('health_staff.index', compact('applications', 'stats'));
    }

    /**
     * Display health staff applications (doctors/nurses/etc)
     * Route: /health_staff/doctors
     */
    public function doctors(Request $request)
    {
        $query = HealthStaff::with([
            'user',
            'task',
            'humanType',
            'specialization',
            'applicationState',
            'languages'
        ]);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('application_status', $request->status);
        }

        // Filter by human type
        if ($request->has('human_type') && $request->human_type != '') {
            $query->where('human_type_id', $request->human_type);
        }

        // Filter by task
        if ($request->has('task') && $request->task != '') {
            $query->where('task_id', $request->task);
        }

        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get filters data
        $humanTypes = HumanType::all();
        $tasks = Task::orderBy('created_at', 'desc')->limit(50)->get();

        return view('health_staff.doctors', compact('applications', 'humanTypes', 'tasks'));
    }

    /**
     * Display personal details of a specific application
     * Route: /health_staff/personal-detail/{id}
     */
    public function personalDetail($id)
    {
        $application = HealthStaff::with([
            'user',
            'task',
            'humanType',
            'specialization',
            'applicationState',
            'languages',
            'files',
            'workedWith'
        ])->findOrFail($id);

        return view('health_staff.personal-detail', compact('application'));
    }

    /**
     * Update application status (approve/reject)
     * Route: POST /health_staff/update-status/{id}
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'application_status' => 'required|in:pending,approved,rejected',
            'reason' => 'nullable|string|max:1000',
        ]);

        $application = HealthStaff::findOrFail($id);

        $application->update([
            'application_status' => $validated['application_status'],
            'reason' => $validated['reason'] ?? null,
            'state_date' => now(),
            'state_application' => $this->getStateIdFromStatus($validated['application_status']),
        ]);

        // TODO: إرسال إشعار بالبريد الإلكتروني للمتقدم
        // يمكن استخدام Event/Listener هنا

        return response()->json([
            'status' => 'success',
            'message' => 'Application status updated successfully',
            'data' => $application
        ]);
    }

    /**
     * Bulk update status for multiple applications
     * Route: POST /health_staff/bulk-update-status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:health_staff,id',
            'application_status' => 'required|in:pending,approved,rejected',
            'reason' => 'nullable|string|max:1000',
        ]);

        HealthStaff::whereIn('id', $validated['ids'])->update([
            'application_status' => $validated['application_status'],
            'reason' => $validated['reason'] ?? null,
            'state_date' => now(),
            'state_application' => $this->getStateIdFromStatus($validated['application_status']),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Applications updated successfully',
        ]);
    }

    /**
     * Helper: Convert status to state_id
     */
    private function getStateIdFromStatus($status)
    {
        return match($status) {
            'pending' => 1,
            'approved' => 2,
            'rejected' => 3,
            default => 1,
        };
    }

    /**
     * Export applications to Excel
     * Route: GET /health_staff/export
     */
    public function export(Request $request)
    {
        // TODO: Implement Excel export
        // يمكن استخدام Laravel Excel package
    }
}
