<?php

use App\Http\Controllers\backend\AttendanceController;
use App\Http\Controllers\backend\DepartmentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Usercontroller;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\backend\EventController;
use App\Http\Controllers\backend\LeavesContrller;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\TaskController;
use App\Http\Controllers\backend\ManageSalaryController;
use App\Http\Controllers\backend\UserMetaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backend\ReportController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('admin.login');

Route::get('/', [Usercontroller::class, 'login'])->name('admin.login');
Route::post('/login-try', [Usercontroller::class, 'try_login'])->name('admin.login.try');
//ADMIN PROTECTED ROUTE START
Route::group(['middleware' => 'auth:web'], function () {

  //USER ROUTE
  Route::get('/admin-dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/admin-dashboard/admin-logout', [UserController::class, 'logout'])->name('admin.logout');
  Route::get('/admin-dashboard/changepassword', [UserController::class, 'change_password'])->name('admin.changepassword');
  Route::post('/admin-dashboard/changepassword', [UserController::class, 'change_password_try'])->name('admin.changepassword');

  //User Route
  Route::resource('users', UserController::class);
  Route::post('/admin-dashboard/user-search', [UserController::class, 'user_search'])->name('admin.user.search');
  Route::get('/admin-dashboard/admin-addpermission/{id}', [UserController::class, 'user_addpermission'])->name('admin.user.addpermission');
  Route::post('/admin-dashboard/user-savepermissin', [UserController::class, 'user_savepermissin'])->name('admin.user.savepermissin');


  //Employee Route
  Route::resource('employee', EmployeeController::class);
  Route::post('/admin-dashboard/employee-search', [EmployeeController::class, 'employee_search'])->name('admin.employee.search');

  //Task Route
  Route::resource('task', TaskController::class);
  Route::post('/admin-dashboard/task-search', [TaskController::class, 'task_search'])->name('admin.task.search');

  //Event Route
  Route::resource('event', EventController::class);
  Route::post('/admin-dashboard/event-search', [EventController::class, 'event_search'])->name('admin.event.search');

  //Department Route
  Route::resource('department', DepartmentsController::class);
  Route::post('/admin-dashboard/department-search', [DepartmentsController::class, 'department_search'])->name('admin.department.search');

  //Leaves Route
  Route::resource('leave', LeavesContrller::class);
  Route::post('/admin-dashboard/leave-search', [LeavesContrller::class, 'leave_search'])->name('admin.leave.search');

  //Salary Route
  Route::resource('salary', ManageSalaryController::class);
  Route::post('/admin-dashboard/salary-search', [ManageSalaryController::class, 'salary_search'])->name('admin.salary.search');

  //Attendance Route
  Route::resource('attendance', AttendanceController::class);
  Route::post('/admin-dashboard/attendance-search', [AttendanceController::class, 'attendance_search'])->name('admin.attendance.search');


  //User-Meta Route
  Route::resource('meta', UserMetaController::class);
  Route::post('/admin-dashboard/meta-search', [UserMetaController::class, 'meta_search'])->name('admin.meta.search');

  //Report Route
  Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});
