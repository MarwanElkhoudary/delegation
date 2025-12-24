<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\HealthStaffRegistrationController;
use Illuminate\Support\Facades\Route;

// ========== Health Staff Registration Route ==========
Route::get('/register_health_staff', [HealthStaffRegistrationController::class, 'showRegistrationForm'])
    ->name('register_health_staff');

Route::post('/health-staff/register', [HealthStaffRegistrationController::class, 'register'])
    ->name('health-staff.register');

Route::post('/health-staff/get-specializations', [HealthStaffRegistrationController::class, 'getSpecializations'])
    ->name('health-staff.get-specializations');

Route::post('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [TaskController::class, 'index'])->middleware(['auth', 'verified']); // for task listing
Route::get('/home', function() { return redirect('/calendar'); }); // redirect to calendar
Route::get('/calendar', [MainController::class, 'index'])->name('calendar'); // calendar page
Route::get('/apply-mission/{id}',  [MainController::class, 'showApplyPage'])->name('apply.mission.show');
Route::get('/publish_tasks', [MainController::class, 'getPublishTasks'])->name('home.publish_tasks');
Route::get('/application/success/{id}', [MainController::class, 'applicationSuccess'])
    ->name('application.success');
Route::get('/application/view/{id}', [MainController::class, 'viewApplication'])
    ->name('application.view');
Route::get('/application/edit/{id}', [MainController::class, 'editApplication'])
    ->name('application.edit');
Route::post('/application/update/{id}', [MainController::class, 'updateApplication'])
    ->name('application.update');
Route::delete('/application/file/{fileId}', [MainController::class, 'deleteApplicationFile'])
    ->name('application.file.delete');
//Route::post('/apply_to_mission', [MainController::class, 'applyToMission'])->name('apply_to_mission');
Route::post('/get_specialization', [MainController::class, 'get_specialization']);

Route::post('/apply_to_mission', [MainController::class, 'applyToMission'])->name('apply.mission');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(TaskController::class)->prefix('tasks')->name('task.')->group(function () {
        Route::get('/', 'index')->name('index'); // for task listing
        Route::get('/export', 'export')->name('export'); // for task listing
        Route::get('/add', 'create')->name('create');
        Route::get('/show_events', 'show_events')->name('show_events');
        Route::get('/get_events', 'get_events')->name('get_events');
        Route::get('/view_task/{id}', 'show');
        Route::get('/edit_task/{id}', 'edit');
        Route::put('/edit_task_status/{id}', 'edit_task_status')->name('edit_task_status');
        Route::put('/edit_task_internation/{id}', 'edit_task_internation')->name('edit_task_internation');
        Route::put('/task_update/{id}', 'update')->name('update');
        Route::get('/delete_task/{id}', 'destroy');
        Route::post('/', 'store')->name('store');
        Route::post('/get_specialization', 'get_specialization');
        Route::post('/list', 'list');
        Route::get('/medical_needs/{task_is}', 'medical_needs');
    });

    Route::controller(CandidateController::class)->prefix('health_staff')->name('health_staff.')->group(function () {
        Route::get('/', 'index')->name('index'); // for health staff listing
        Route::get('/doctors', 'doctors')->name('doctors'); // for doctors listing
        Route::get('/personal-detail', 'personalDetail')->name('personalDetail'); // for personal detail

    });
});

require __DIR__ . '/auth.php';
