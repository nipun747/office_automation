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

Route::get('designation_form','Mycontroller@designation_form');
Route::get('employees_form','Mycontroller@employees_form');
Route::get('department_form','Mycontroller@department_form');
Route::post('/employee_form_submit','Mycontroller@employee_form_submit');
Route::post('/designation_form_submit','Mycontroller@designation_form_submit');
Route::post('/department_form_submit','Mycontroller@department_form_submit');
Route::get('/employee_view_form','Mycontroller@employee_view_form');
Route::get('/login','Mycontroller@login');