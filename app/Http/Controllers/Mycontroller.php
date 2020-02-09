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
    public function leave_form()
    {
        $catagories = DB::table('leave_table')
                            ->select('leave_table.*')
                            ->where('status',1)
                            ->get();
     $employee_names = DB::table('employees')
                     ->select('employees.*')
                            ->where('status',1)
                            ->get();
        
        return view('leave_form',['catagories'=>$catagories,'employee_names'=>$employee_names]);
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
        $this->validate($request, [
            'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $this->validate($request, [
            'input_signature' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

             if ( $request->hasFile('input_img')){
                if ($request->file('input_img')->isValid()){
                    $file = $request->file('input_img');
                    $name = $file->getClientOriginalName();
                    $file->move('images' , $name);
                    $inputs = $request->all();
                    $inputs['path'] = $name;

                    
                
                }}

             if ( $request->hasFile('input_signature')){
                if ($request->file('input_signature')->isValid()){
                    $file = $request->file('input_signature');
                    $signature = $file->getClientOriginalName();
                    $file->move('images' , $signature);
                    $inputs = $request->all();
                    $inputs['path'] = $signature;

                    
                
                }
            }
        
        DB::table('employees')->insert(
            ['employee_code' => $employee_code,
            'employee_name' => $employee_name,
            'designation' => $designation,
            'department' => $department,
            'line_manager_id' => $line_manager_id,
            'profile_image' => $name,
            'signature' => $signature
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
        public function leave_form_submit(Request $request){
         $catagory = $request->input('catagory');
        
        DB::table('leave_table')->insert(
            ['catagory' => $catagory
            
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
        $employee_code = $request->input('employee_code');
        $password = $request->input('password');

        $employee = DB::table('employees')
                ->select('employee_name','designation','department','line_manager_id')
                ->where('employee_code', $employee_code)
                ->where('password', $password)
                ->get();
        if(count($employee) > 0){
            return view('dashboard');
        }
        else{
             return view('login');
        }
        //echo $email."-----------".$password;
        }
        public function fileUpload(Request $request) {

        $this->validate($request, [
            'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

             if ( $request->hasFile('input_img')){
                if ($request->file('input_img')->isValid()){
                    $file = $request->file('input_img');
                    $name = $file->getClientOriginalName();
                    $file->move('images' , $name);
                    $inputs = $request->all();
                    $inputs['path'] = $name;

                    
                echo 'Inserted';
                }
            }
     /*if ($request->hasFile('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
}*/
   
    }

    public function store(Request $request)
  {

  // get current time and append the upload file extension to it,
  // then put that name to $photoName variable.
  $photoName = time().'.'.$request->user_photo->getClientOriginalExtension();

  /*
  talk the select file and move it public directory and make avatars
  folder if doesn't exsit then give it that unique name.
  */
  $request->user_photo->move(public_path('avatars'), $photoName);

  }
  

}