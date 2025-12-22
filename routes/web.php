<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::post('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [TaskController::class, 'index'])->middleware(['auth', 'verified']); // for task listing
Route::get('/home', [MainController::class, 'index']); // for task listing
Route::get('/apply-mission/{id}',  [MainController::class, 'showApplyPage'])->name('apply.mission.show');
Route::get('/publish_tasks', [MainController::class, 'getPublishTasks'])->name('home.publish_tasks');
Route::get('/application/success/{id}', [MainController::class, 'applicationSuccess'])
    ->name('application.success');
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

    Route::controller(CandidateController::class)->prefix('candidate')->name('candidate.')->group(function () {
        Route::get('/', 'index')->name('index'); // for task listing
        Route::get('/doctors', 'doctors')->name('doctors'); // for task listing
        Route::get('/personal-detail', 'personalDetail')->name('personalDetail'); // for task listing

    });
});

require __DIR__ . '/auth.php';
