<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RoasterController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [FrontendController::class, 'index']);
    Route::get('/', function () {
        return redirect(url('dashboard'));
    });
    Route::get('locations', [LocationController::class, 'index']);
    Route::get('locations/add', [LocationController::class, 'add']);
    Route::post('locations/insert', [LocationController::class, 'insert']);
    Route::get('locations//edit/{id}', [LocationController::class, 'edit']);
    Route::put('locations/update/{id}', [LocationController::class, 'update']);
    Route::get('locations/delete/{id}', [LocationController::class, 'delete']);
    Route::get('locations/show/{id}', [LocationController::class, 'show']);

    // employes
    Route::get('employes', [EmployeController::class, 'index']);
    Route::get('employes/add', [EmployeController::class, 'add']);
    Route::post('employes/insert', [EmployeController::class, 'insert']);
    Route::get('employes/edit/{id}', [EmployeController::class, 'edit']);
    Route::put('employes/update/{id}', [EmployeController::class, 'update']);
    Route::get('employes/delete/{id}', [EmployeController::class, 'delete']);
    Route::get('employes/show/{id}', [EmployeController::class, 'show']);


    //leaves

    Route::get('leaves', [LeaveController::class, 'add']);
    Route::post('insert-leaves', [LeaveController::class, 'insert']);

    Route::get('view-leaves', [LeaveController::class, 'view'])->name('home_leave');
    Route::get('show/leaves/{id}', [LeaveController::class, 'show']);
    Route::get('edit/leaves/{id}', [LeaveController::class, 'edit']);
    Route::put('leaves/update/{id}', [LeaveController::class, 'update']);
    Route::get('leave/reports', [LeaveController::class, 'report']);
    Route::get('delete-employes/{id}', [LeaveController::class, 'delete']);
    Route::get('leave/reports/selectDates', [LeaveController::class, 'leaveReportViaDate']);
    Route::get('show/leavespersonal/{id}', [LeaveController::class, 'leaveReportViaPersonal']);
    Route::get('leave/reports/selectDates/personal/{id}', [LeaveController::class, 'leaveReportViaDatePersonal']);


    //roaster
    // useable
    // Route::get('roasters/report', [RoasterController::class, 'report']);
    // Route::get('roasters', [RoasterController::class, 'index']);
    // Route::get('roaster/add', [RoasterController::class, 'add']);
    // Route::post('check/roaster', [RoasterController::class, 'checkRoaster'])->name('admin.checkEmployeRoaster');
    // Route::post('roaster/insert', [RoasterController::class, 'insert']);
    // Route::get('roaster/delete/{id}', [RoasterController::class, 'delete']);
    // Route::get('roaster/show/{id}', [RoasterController::class, 'show']);
    // Route::get('roaster/edit/{id}', [RoasterController::class, 'edit']);
    // Route::put('roaster/update/{id}', [RoasterController::class, 'update']);
    // // this used for all roaster record filter by date
    // Route::get('roasters/reportViaDate', [RoasterController::class, 'viewReportViaDate']);
    // // show all roaster for single employee
    // Route::get('show-roaster-by-employee/{id}', [RoasterController::class, 'showRoaster']);
    // // filter for single employee via date filter
    // Route::get('roaster/personal-filter', [RoasterController::class, 'filterViaDatePersonal']);

    // Route::get('roasterpersonal/reportViaDatePersonal/{id}', [RoasterController::class, 'viewRoasterPersonalViaDate']);
    // // ------------------
    // // ------------------
    // Route::get('show-roaster/{id}', [RoasterController::class, 'showRoaster']);
    // Route::get('testing', [RoasterController::class, 'testing']);
    Route::post('check/roaster', [RoasterController::class, 'checkRoaster'])->name('admin.checkEmployeRoaster');
    Route::get('roaster/add', [RoasterController::class, 'add']);
    Route::get('roasters', [RoasterController::class, 'index']);
    Route::get('roaster/deleteAll', [RoasterController::class, 'deleteAll']);
    Route::get('testing', [RoasterController::class, 'testing']);
    Route::post('roaster/insert', [RoasterController::class, 'insert']);
    Route::get('roaster/delete/{id}', [RoasterController::class, 'delete']);
    Route::get('roaster/show/{id}', [RoasterController::class, 'show']);
    Route::get('roaster/edit/{id}', [RoasterController::class, 'edit']);
    Route::put('roaster/update/{id}', [RoasterController::class, 'update']);
    Route::get('roasters/report', [RoasterController::class, 'report']);
    // Route::get('roasters/report', [RoasterController::class, 'report']);
    Route::get('roasters/reportViaDate', [RoasterController::class, 'viewReportViaDate']);
    Route::get('show-roaster/{id}', [RoasterController::class, 'showRoaster']);
    Route::get('show-roaster-by-employee/{id}', [RoasterController::class, 'showRoaster']);
    Route::get('roaster/personal-filter', [RoasterController::class, 'filterViaDatePersonal']);
    Route::get('roasterpersonal/reportViaDatePersonal/{id}', [RoasterController::class, 'viewRoasterPersonalViaDate']);
    Route::post('roaster/checkLeave', [RoasterController::class, 'checkLeaves'])->name('admin.checkLeaves');
});
Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('route:cache');
    Artisan::call('view:clear');

    return "Cleared!";
});


// });
