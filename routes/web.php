<?php

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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/designation_form','Mycontroller@designation_form');
Route::get('employees_form','Mycontroller@employees_form');
Route::get('department_form','Mycontroller@department_form');
Route::post('/employee_form_submit','Mycontroller@employee_form_submit');
Route::post('/conveyance_submit','Mycontroller@conveyance_submit');
Route::post('/designation_form_submit','Mycontroller@designation_form_submit');
Route::post('/department_form_submit','Mycontroller@department_form_submit');
Route::get('/employee_view_form','Mycontroller@employee_view_form');
Route::get('/login','Mycontroller@login');
Route::get('leave_form','Mycontroller@leave_form');
Route::post('leave_form_submit','Mycontroller@leave_form_submit');
Route::post('/login_form_submit','Mycontroller@login_form_submit');
Route::post('fileupload','Mycontroller@fileupload');
Route::get('/logout','Mycontroller@logout');
Route::get('/employee_view_form','Mycontroller@employee_view_form');

Route::get('/leave_view_form','Mycontroller@leave_view_form');
Route::get('leave_show','Mycontroller@leave_show');
Route::get('viewAssignedDuty','employeeController@viewAssignedDuty');
Route::get('accRejectDuty','employeeController@accRejectDuty');
Route::get('viewPendingLeave','employeeController@viewPendingLeave');
Route::get('lineleave_view_form','MyController@lineleave_view_form');
Route::get('lineacceptReject_Duty','employeeController@lineacceptRejectDuty');
Route::get('hrlineacceptReject_Duty','employeeController@hrlineacceptRejectDuty');
Route::get('hrviewLeave','employeeController@hrviewLeave');
Route::get('index','DynamicPDFController@index');
Route::get('/employee_view_form/pdf','DynamicPDFController@pdf');
Route::get('leave_show/pdf','DynamicPDFController@pdf');
Route::get('/employee_view_form_pdf','DynamicPDFController@index');
Route::get('/leave_show','DynamicPDFController@index');
Route::get('view/pdf','DynamicPDFController@pdf');

Route::get('leave','Mycontroller@leave');
Route::post('/leave_submit','Mycontroller@leave_submit');
Route::get('view','Mycontroller@view');
Route::get('conveyance','Mycontroller@conveyance');
Route::get('index','Mycontroller@index');
Route::get('debit','Mycontroller@debit');
Route::get('index','Mycontroller@index');
Route::get('debit_pdf','Mycontroller@debit_pdf');
Route::get('view_pdf/{leave_id}','Mycontroller@view_pdf');
Route::get('conveyance_input','Mycontroller@conveyance_input');
Route::get('debit_input','Mycontroller@debit_input');
Route::post('/debit_submit','Mycontroller@debit_submit');
Route::get('view_employee','Mycontroller@view_employee');
Route::get('edit/{employee_code?}','Mycontroller@edit');
//Route::post('update','Mycontroller@update')->name('update');
Route::post('/update_employee','Mycontroller@updateEmployee');
Route::get('/leave_log','Mycontroller@leave_log');
Route::get('conveyance_view_received','Mycontroller@conveyance_view_received');
Route::get('conveyance_function','Mycontroller@conveyancefunction');
Route::get('conveyance_for_received','Mycontroller@conveyance_for_received');
Route::get('conveyance_pdf/{id}','Mycontroller@conveyance_pdf');
Route::get('conveyance_view_received_md','Mycontroller@conveyance_view_received_md');
Route::get('mdfunctionagain','Mycontroller@mdfunctionagain');
Route::get('mdfunction_again','Mycontroller@mdfunction_again');
Route::get('my_conveyance','Mycontroller@myconveyance');
Route::get('myconveyance','Mycontroller@myconveyance');
Route::get('conveyance_for_employee','Mycontroller@conveyance_for_employee');
Route::get('my_conveyance','Mycontroller@my_conveyance');
Route::get('conveyance_log/{conveyance_id}','Mycontroller@conveyance_log');
Route::get('profile','Mycontroller@profile');
Route::get('password','Mycontroller@password');
Route::post('update_image','Mycontroller@update_image');
Route::post('update_password','Mycontroller@update_password');
Route::get('edit_profile/{employee_code?}','Mycontroller@edit_profile');
Route::get('change_password/{employee_code?}','Mycontroller@change_password');
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return 'Application cache cleared';
 });