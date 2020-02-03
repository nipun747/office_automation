<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class Mycontroller extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */public function login()
    {
        return view('login');
    }
	 
	public function designation_form()
    {
         $designations = DB::table('designation_table')
                            ->select('designation_table.*')
                            ->where('status',1)
                            ->get();
        return view('designation_form',['designations'=>$designations]);
    }
    public function employees_form()
    {
        $designations = DB::table('designation_table')
                            ->select('designation_table.*')
                            ->where('status',1)
                            ->get();
        $departments = DB::table('department_table')
                            ->select('department_table.*')
                            ->where('status',1)
                            ->get();
        $line_manager=DB::table('employees')
                        ->select('employees.*')
                        ->where('status',1)
                        ->where('is_line_manager',1)
                        ->get();
        return view('employees_form',
            ['designations'=>  $designations,
                'departments' => $departments,
                'line_manager'=>$line_manager]);
       

    }
    public function department_form()
    { $departments = DB::table('department_table')
                            ->select('department_table.*')
                            ->where('status',1)
                            ->get();
     
          return view('department_form',
            [
                'departments' => $departments
                ]);
        
    }
    public function employee_view_form()
    { 
        $employee = DB::table('employees')
                ->select('employee_name','designation','department','line_manager_id')
                ->get();
                $designation = DB::table('designation_table')
                ->select('designation')
                ->get();

        return view('employee_view_form',['employee'=>$employee,'designation'=>$designation]);
       
    }
    public function employee_form_submit(Request $request){
        $employee_code = $request->input('employee_code');

        $employee_name = $request->input('employee_name');
        $designation =$request->input('designation');
        $department = $request->input('department');
        $line_manager_id = $request->input('line_manager_id');
        
        DB::table('employees')->insert(
            ['employee_code' => $employee_code,
            'employee_name' => $employee_name,
            'designation' => $designation,
            'department' => $department,
            'line_manager_id' => $line_manager_id
            ]);
        echo 'Inserted';
    }
    public function designation_form_submit(Request $request){
        $designation = $request->input('designation');
        
        DB::table('designation_table')->insert(
            ['designation' => $designation
            
            ]);
        echo 'Inserted';
    }
    public function department_form_submit(Request $request){
        $department = $request->input('department');
        $department_lead = $request->input('department_lead');
        
        DB::table('department_table')->insert(
            ['department' => $department,
            'department_lead' => $department_lead
            
            ]);
        echo 'Inserted';
    }
     public function user_view_form(){
        

        return view('employee_view_form',['employee'=>$users]);
    }
     public function login_form_submit(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        echo 'inserted';
        }
}