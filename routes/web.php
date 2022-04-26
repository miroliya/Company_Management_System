<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Usercontroller;
use App\Http\Controllers\backend\EmployeeController;

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


  //EMPLOYEE ROUTE
  Route::get('/admin-dashboard/employee-list', [EmployeeController::class, 'index'])->name('admin.employee.list');
  Route::get('/admin-dashboard/employee-create', [EmployeeController::class, 'create'])->name('admin.employee.create');
  Route::post('/admin-dashboard/employee-store', [EmployeeController::class, 'store'])->name('admin.employee.store');
  Route::get('/admin-dashboard/employee-edit/{id}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
  Route::get('/admin-dashboard/employee-show/{id}', [EmployeeController::class, 'show'])->name('admin.employee.show');
  Route::post('/admin-dashboard/employee-update/{id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
  Route::delete('/admin-dashboard/employee-delete/{id}', [EmployeeController::class, 'destroy'])->name('admin.employee.delete');
  Route::post('/admin-dashboard/employee-search', [EmployeeController::class, 'employee_search'])->name('admin.employee.search');
  // Route::get('/admin-dashboard/employee-addpermission/{id}', [EmployeeController::class, 'user_addpermission'])->name('admin.employee.addpermission');
  // Route::post('/admin-dashboard/employee-savepermissin', [EmployeeController::class, 'user_savepermissin'])->name('admin.employee.savepermissin');	   
  //CUSTOMER ROUTE

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
