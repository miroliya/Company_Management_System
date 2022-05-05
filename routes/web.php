<?php

use App\Http\Controllers\backend\AttendanceController;
use App\Http\Controllers\backend\DepartmentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Usercontroller;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\backend\EventController;
use App\Http\Controllers\backend\LeavesContrller;
use App\Http\Controllers\backend\TaskController;
use App\Http\Controllers\backend\ManageSalaryController;
use App\Http\Controllers\backend\UserMetaController;
use Illuminate\Support\Facades\Auth;
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

  Route::get('/admin-dashboard/admin-list', [UserController::class, 'index'])->name('admin.user.list');
  Route::get('/admin-dashboard/user-create', [UserController::class, 'user_create'])->name('admin.user.create');
  Route::post('/admin-dashboard/user-store', [UserController::class, 'store'])->name('admin.user.store');
  Route::get('/admin-dashboard/user-edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
  Route::get('/admin-dashboard/user-show/{id}', [UserController::class, 'user_show'])->name('admin.user.show');
  Route::post('/admin-dashboard/user-update/{id}', [UserController::class, 'update'])->name('admin.user.update');
  Route::delete('/admin-dashboard/user-delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
  Route::post('/admin-dashboard/user-search', [UserController::class, 'user_search'])->name('admin.user.search');
  Route::get('/admin-dashboard/admin-addpermission/{id}', [UserController::class, 'user_addpermission'])->name('admin.user.addpermission');
  Route::post('/admin-dashboard/user-savepermissin', [UserController::class, 'user_savepermissin'])->name('admin.user.savepermissin');


  //Employee Route
  Route::get('/admin-dashboard/employee-list', [EmployeeController::class, 'index'])->name('admin.employee.list');
  Route::get('/admin-dashboard/employee-create', [EmployeeController::class, 'create'])->name('admin.employee.create');
  Route::post('/admin-dashboard/employee-store', [EmployeeController::class, 'store'])->name('admin.employee.store');
  Route::get('/admin-dashboard/employee-edit/{id}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
  Route::get('/admin-dashboard/employee-show/{id}', [EmployeeController::class, 'show'])->name('admin.employee.show');
  Route::post('/admin-dashboard/employee-update/{id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
  Route::delete('/admin-dashboard/employee-delete/{id}', [EmployeeController::class, 'destroy'])->name('admin.employee.delete');
  Route::post('/admin-dashboard/employee-search', [EmployeeController::class, 'employee_search'])->name('admin.employee.search');

  //Task Route
  Route::get('/admin-dashboard/task-list', [TaskController::class, 'index'])->name('admin.task.list');
  Route::get('/admin-dashboard/task-create', [TaskController::class, 'create'])->name('admin.task.create');
  Route::post('/admin-dashboard/task-store', [TaskController::class, 'store'])->name('admin.task.store');
  Route::get('/admin-dashboard/task-edit/{id}', [TaskController::class, 'edit'])->name('admin.task.edit');
  Route::get('/admin-dashboard/task-show/{id}', [TaskController::class, 'show'])->name('admin.task.show');
  Route::post('/admin-dashboard/task-update/{id}', [TaskController::class, 'update'])->name('admin.task.update');
  Route::delete('/admin-dashboard/task-delete/{id}', [TaskController::class, 'destroy'])->name('admin.task.delete');
  Route::post('/admin-dashboard/task-search', [TaskController::class, 'task_search'])->name('admin.task.search');

    //Event Route
    Route::get('/admin-dashboard/event-list', [EventController::class, 'index'])->name('admin.event.list');
    Route::get('/admin-dashboard/event-create', [EventController::class, 'create'])->name('admin.event.create');
    Route::post('/admin-dashboard/event-store', [EventController::class, 'store'])->name('admin.event.store');
    Route::get('/admin-dashboard/event-edit/{id}', [EventController::class, 'edit'])->name('admin.event.edit');
    Route::get('/admin-dashboard/event-show/{id}', [EventController::class, 'show'])->name('admin.event.show');
    Route::post('/admin-dashboard/event-update/{id}', [EventController::class, 'update'])->name('admin.event.update');
    Route::delete('/admin-dashboard/event-delete/{id}', [EventController::class, 'destroy'])->name('admin.event.delete');
    Route::post('/admin-dashboard/event-search', [EventController::class, 'event_search'])->name('admin.event.search');

    //Department Route
    Route::get('/admin-dashboard/department-list', [DepartmentsController::class, 'index'])->name('admin.department.list');
    Route::get('/admin-dashboard/department-create', [DepartmentsController::class, 'create'])->name('admin.department.create');
    Route::post('/admin-dashboard/department-store', [DepartmentsController::class, 'store'])->name('admin.department.store');
    Route::get('/admin-dashboard/department-edit/{id}', [DepartmentsController::class, 'edit'])->name('admin.department.edit');
    Route::get('/admin-dashboard/department-show/{id}', [DepartmentsController::class, 'show'])->name('admin.department.show');
    Route::post('/admin-dashboard/department-update/{id}', [DepartmentsController::class, 'update'])->name('admin.department.update');
    Route::delete('/admin-dashboard/department-delete/{id}', [DepartmentsController::class, 'destroy'])->name('admin.department.delete');
    Route::post('/admin-dashboard/department-search', [DepartmentsController::class, 'department_search'])->name('admin.department.search');

    //Leaves Route
    Route::get('/admin-dashboard/leave-list', [LeavesContrller::class, 'index'])->name('admin.leave.list');
    Route::get('/admin-dashboard/leave-create', [LeavesContrller::class, 'create'])->name('admin.leave.create');
    Route::post('/admin-dashboard/leave-store', [LeavesContrller::class, 'store'])->name('admin.leave.store');
    Route::get('/admin-dashboard/leave-edit/{id}', [LeavesContrller::class, 'edit'])->name('admin.leave.edit');
    Route::get('/admin-dashboard/leave-show/{id}', [LeavesContrller::class, 'show'])->name('admin.leave.show');
    Route::post('/admin-dashboard/leave-update/{id}', [LeavesContrller::class, 'update'])->name('admin.leave.update');
    Route::delete('/admin-dashboard/leave-delete/{id}', [LeavesContrller::class, 'destroy'])->name('admin.leave.delete');
    Route::post('/admin-dashboard/leave-search', [LeavesContrller::class, 'leave_search'])->name('admin.leave.search');

    Route::resource('leaves', LeavesContrller::class);

    //Salary Route
    Route::get('/admin-dashboard/salary-list', [ManageSalaryController::class, 'index'])->name('admin.salary.list');
    Route::get('/admin-dashboard/salary-create', [ManageSalaryController::class, 'create'])->name('admin.salary.create');
    Route::post('/admin-dashboard/salary-store', [ManageSalaryController::class, 'store'])->name('admin.salary.store');
    Route::get('/admin-dashboard/salary-edit/{id}', [ManageSalaryController::class, 'edit'])->name('admin.salary.edit');
    Route::get('/admin-dashboard/salary-show/{id}', [ManageSalaryController::class, 'show'])->name('admin.salary.show');
    Route::post('/admin-dashboard/salary-update/{id}', [ManageSalaryController::class, 'update'])->name('admin.salary.update');
    Route::delete('/admin-dashboard/salary-delete/{id}', [ManageSalaryController::class, 'destroy'])->name('admin.salary.delete');
    Route::post('/admin-dashboard/salary-search', [ManageSalaryController::class, 'salary_search'])->name('admin.salary.search');

     //Attendance Route
     Route::get('/admin-dashboard/attendance-list', [AttendanceController::class, 'index'])->name('admin.attendance.list');
     Route::get('/admin-dashboard/attendance-create', [AttendanceController::class, 'create'])->name('admin.attendance.create');
     Route::post('/admin-dashboard/attendance-store', [AttendanceController::class, 'store'])->name('admin.attendance.store');
     Route::get('/admin-dashboard/attendance-edit/{id}', [AttendanceController::class, 'edit'])->name('admin.attendance.edit');
     Route::get('/admin-dashboard/attendance-show/{id}', [AttendanceController::class, 'show'])->name('admin.attendance.show');
     Route::post('/admin-dashboard/attendance-update/{id}', [AttendanceController::class, 'update'])->name('admin.attendance.update');
     Route::delete('/admin-dashboard/attendance-delete/{id}', [AttendanceController::class, 'destroy'])->name('admin.attendance.delete');
     Route::post('/admin-dashboard/attendance-search', [AttendanceController::class, 'attendance_search'])->name('admin.attendance.search');

    //User-Meta Route
    Route::get('/admin-dashboard/meta-list', [UserMetaController::class, 'index'])->name('admin.meta.list');
    Route::get('/admin-dashboard/meta-create', [UserMetaController::class, 'create'])->name('admin.meta.create');
    Route::post('/admin-dashboard/meta-store', [UserMetaController::class, 'store'])->name('admin.meta.store');
    Route::get('/admin-dashboard/meta-edit/{id}', [UserMetaController::class, 'edit'])->name('admin.meta.edit');
    Route::get('/admin-dashboard/meta-show/{id}', [UserMetaController::class, 'show'])->name('admin.meta.show');
    Route::post('/admin-dashboard/meta-update/{id}', [UserMetaController::class, 'update'])->name('admin.meta.update');
    Route::delete('/admin-dashboard/meta-delete/{id}', [UserMetaController::class, 'destroy'])->name('admin.meta.delete');
    Route::post('/admin-dashboard/meta-search', [UserMetaController::class, 'meta_search'])->name('admin.meta.search');
    
});
//ADMIN PROTECTED ROUTE END
//Auth::routes();


// Route::get('/users-login', [CustomeruserController::class, 'login'])->name('customer.login');
// Route::post('/customer-login-try', [CustomeruserController::class, 'try_login'])->name('customer.login.try');
// //ADMIN PROTECTED ROUTE START
// Route::group(['middleware' => 'auth:customer'], function () {

//          //USER ROUTE
//            Route::get('/users-dashboard', [CustomeruserController::class, 'dashboard'])->name('customer.dashboard');
//            Route::get('/users-dashboard/users-logout', [CustomeruserController::class, 'logout'])->name('customer.logout');
//            Route::get('/customer-dashboard/changepassword', [CustomeruserController::class, 'change_password'])->name('customer.changepassword');
//            Route::post('/customer-dashboard/changepassword', [CustomeruserController::class, 'change_password_try'])->name('customer.changepassword');

//            //CUSTOMER ROUTE
//            Route::get('/users-dashboard/customersuser-list', [CustomersUserController::class, 'index'])->name('customer.customersuser.list');
//            Route::get('/customer-dashboard/customersuser-create', [CustomersUserController::class, 'create'])->name('customer.customersuser.create');
//            Route::post('/customer-dashboard/customersuser-store', [CustomersUserController::class, 'store'])->name('customer.customersuser.store');
//            Route::get('/customer-dashboard/customersuser-edit/{id}', [CustomersUserController::class, 'edit'])->name('customer.customersuser.edit');
//            Route::get('/customer-dashboard/customersuser-show/{id}', [CustomersUserController::class, 'show'])->name('customer.customersuser.show');
//            Route::post('/customer-dashboard/customersuser-update/{id}', [CustomersUserController::class, 'update'])->name('customer.customersuser.update');
//            Route::delete('/customer-dashboard/customersuser-delete/{id}', [CustomersUserController::class, 'destroy'])->name('customer.customersuser.delete');
//            Route::post('/customer-dashboard/customersuser-search', [CustomersUserController::class, 'search'])->name('customer.customersuser.search');
//            Route::get('/customer-dashboard/customersuser-addpermission/{id}', [CustomersUserController::class, 'user_addpermission'])->name('customer.customersuser.addpermission');
//            Route::post('/customer-dashboard/customersuser-savepermissin', [CustomersUserController::class, 'user_savepermissin'])->name('customer.customersuser.savepermissin');	   
//          //CUSTOMER ROUTE
// });

// Route::get('/customerusers-login', [UserCustomerController::class, 'login'])->name('customerusers.login');
// Route::post('/customerusers-login-try', [UserCustomerController::class, 'try_login'])->name('customerusers.login.try');
// //ADMIN PROTECTED ROUTE START
// Route::group(['middleware' => 'auth:customeruser'], function () {

//          //USER ROUTE
//            Route::get('/customerusers-dashboard', [UserCustomerController::class, 'dashboard'])->name('customerusers.dashboard');
//            Route::get('/customerusers-dashboard/customer-logout', [UserCustomerController::class, 'logout'])->name('customerusers.logout');
//            Route::get('/customerusers-dashboard/changepassword', [UserCustomerController::class, 'change_password'])->name('customerusers.changepassword');
//            Route::post('/customerusers-dashboard/changepassword', [UserCustomerController::class, 'change_password_try'])->name('customerusers.changepassword');

// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
