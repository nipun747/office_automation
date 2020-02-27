<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;
use Session;
use PDF;
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
        $catagories = DB::table('leave_categories')
                            ->select('leave_categories.*')
                            ->where('status',1)
                            ->get();
     $employee_names = DB::table('employees')
                     ->select('employees.*')
                            ->where('status',1)
                            ->get();
        
        return view('leave_form',['catagories'=>$catagories,'employee_names'=>$employee_names]);
    }

    public function leave_form_submit(Request $request){
      
     $employee_id=session()->get('employee_id');
     $catagory = $request->input('catagory');
     $leave_type = $request->input('leave_type');
     $employee = $request->input('employee_name');
     $start_date = date('Y-m-d',strtotime($request->input('fromdate')));
     $end_date = date('Y-m-d',strtotime($request->input('todate')));
     $leave_applied = $request->input('numberofdays');
     $reason = $request->input('reason');
     $remarks = $request->input('remarks');
     $catagory = $request->input('catagory');
         
        DB::table('leave_table')->insert(
            ['catagory' => $catagory,
      'leave_type'=>$leave_type,
      'duty_assigned_to'=>$employee,
      'start_date'=>$start_date,
      'end_date'=>$end_date,
      'leave_applied'=>$leave_applied,
      'reason'=>$reason,
      'remarks'=>$remarks,  
            'status'=>1   ,
            'employee_id'=>$employee_id        
            ]);
        
      Session()->flash('flash_message', 'Leave Submitted successfully!');
      return redirect('/leave_form');
    }

 public function leave_view_form(){
              $hrlineDuty=DB::table('leave_table')
                      ->select('leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','duty_assigned_to','employees.employee_name')
                      ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                       ->get();
              return view('leave_view_form',['hrlineDuty'=>$hrlineDuty]);
     }
     public function lineleave_view_form(){
               $lineDuty=DB::table('leave_table')
                      ->select('leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','duty_assigned_to','employees.employee_name')
                      ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                       ->get();
              return view('employees.lineleave_view_form',['lineDuty'=>$lineDuty]);
          }

    public function employee_view_form()
    { 
        $employee = DB::table('employees')
                ->select('employee_name','designation','department','line_manager_id')
                ->get();
       $designation = DB::table('designation_table')
                ->select('designation')
                ->get();
        $catagory=DB::table('leave_table')
              ->select('leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','employees.employee_id','duty_assigned_to')
               ->join('employees', 'employees.employee_id', '=', 'leave_table.employee_id')
              ->get();
              // dd($catagory);

        return view('employee_view_form',['employee'=>$employee,'designation'=>$designation,'catagory'=>$catagory]);
       
    }
    public function employee_form_submit(Request $request){


        $employee_code = $request->input('employee_code');
        $employee_email = $request->input('employee_email');
        $employee_name = $request->input('employee_name');
        $designation =$request->input('designation');
        $department = $request->input('department');
        $line_manager_id = $request->input('line_manager_id');
        $password = $request->input('password');
        $is_line_manager = $request->input('is_line_manager');



    try {
        $this->validate($request, [
            'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
    catch (\Illuminate\Validation\ValidationException $e){
         echo "input_img not valid";exit;
    }

    try {
        $this->validate($request, [
            'input_signature' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
    catch (\Illuminate\Validation\ValidationException $e){
         echo "input_signature not valid";exit;
    }




             if ( $request->hasFile('input_img')){
                if ($request->file('input_img')->isValid()){
                    $file = $request->file('input_img');
                    $name = $file->getClientOriginalName();
                    $file->move('images' , $name);
                    $inputs = $request->all();
                    $inputs['path'] = $name;
                }
                else{
                   
                }
            }

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
            'employee_email' => $employee_email,
            'designation' => $designation,
            'department' => $department,
            'line_manager_id' => $line_manager_id,
            'profile_image' => $name,
            'signature' => $signature,
            'password' => $password,
            'is_line_manager' => $is_line_manager
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
        
    
    public function leave_show()

    { $leave=DB::table('leave_details')
            ->select('employee_id','employee_name','designation','department','line_manager','application_date','leave_category','line_manager','leave_applied')
            ->get();
              return view('leave_show',['leave'=>$leave]);
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
        $employee_email = $request->input('employee_email');
        $password = $request->input('password');

        

        $employee = DB::table('employees')
                ->select('employee_id','employee_name','designation','department','line_manager_id','employee_email')
                ->where('employee_email', $employee_email)
                ->where('password', $password)
                ->get();
        if(count($employee) > 0){

            Session::put('employee_name', $employee[0]->employee_name);
            Session::put('designation', $employee[0]->designation);
            Session::put('department', $employee[0]->department);
            Session::put('line_manager_id', $employee[0]->line_manager_id);
            Session::put('employee_email', $employee[0]->employee_email);
            Session::put('employee_id', $employee[0]->employee_id);

            //$request->session()->flush();

            if ($request->session()->has('employee_name')) {
                echo  Session::get('employee_name', $employee[0]->employee_name);
            }
            //exit;
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
    public function logout(Request $request){
        $request->session()->flush();
       return view('dashboard');
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
  public function leave()
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
        $catagories = DB::table('leave_categories')
                            ->select('leave_categories.*')
                            ->where('status',1)
                            ->get();
         $employee_names = DB::table('employees')
                     ->select('employees.*')
                            ->where('status',1)
                            ->get();
        return view('leave',
            ['designations'=>  $designations,
                'departments' => $departments,
                'line_manager'=>$line_manager,'catagories'=>$catagories,'employee_names'=>$employee_names]);
  }
 public function leave_submit(Request $request){
            
        $employee_id=session()->get('employee_id');
        $employee_name=session()->get('employee_name');
        $department=session()->get('department');
        $designation=session()->get('designation');
        $line_manager=session()->get('line_manager');
         $leave_category = $request->input('leave_category');
         $leave_type = $request->input('leave_type');
        
         $start_date = date('Y-m-d',strtotime($request->input('fromdate')));
         $end_date = date('Y-m-d',strtotime($request->input('todate')));
         $leave_applied = $request->input('numberofdays');
         
         $remarks = $request->input('remarks');
        
         
        DB::table('leave_details')->insert(
            ['employee_id'=>$employee_id,
            'employee_name'=>$employee_name,
            'department'=>$department,
            'designation'=>$designation,    
            'leave_category' => $leave_category,
            'leave_type'=>$leave_type,
            
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'leave_applied'=>$leave_applied,
          
            'remarks'=>$remarks  
             
                   
            ]);
        echo 'Inserted';
    }
    public function conveyance()
    {$employee = DB::table('conveyance')
                ->select('name','date',
         'from',
          'to',
           'by',
            'purpose',
             'taka',
              
                'received_by',
                 'prepared_by',
                  'checked_by',
                   'approved_by'
            )
                ->get();
        return view('conveyance',['employee'=>$employee]);
     
    }
    public function index()
    {
         $pdf = PDF::loadView('conveyance');
           return $pdf->download('conveyance.pdf');
    }

     public function view_pdf($leave_id)
    {

      $leave_applicant_id = DB::table('leave_table')
                ->select('leave_table.leave_id','leave_table.employee_id')
                ->where('leave_id', $leave_id)
                ->first()->employee_id;

                 
      $leave_categories = DB::table('leave_categories')
                ->select('leave_category_id','leave_category','available_days')
                ->get(); 

      $leave_count = collect(\DB::SELECT("SELECT
              leave_table.catagory,
                count(leave_table.catagory) as count
                FROM
                leave_table
                WHERE
                leave_table.employee_id =  $leave_applicant_id 
                AND leave_table.`status` = 4
                GROUP BY leave_table.catagory
                "))->first();

      $leave_details = collect(\DB::SELECT("SELECT
              employees.employee_name,
              employees.employee_code,
              line_manager.employee_name AS line_manager,
              department_table.department,
              designation_table.designation,
              leave_table.created,
              leave_table.remarks,
              leave_table.catagory,
              leave_categories.leave_category,
              leave_table.leave_type,
              leave_table.start_date,
              leave_table.end_date,
              leave_table.leave_applied,
              leave_table.reason,
              leave_table.`status`,
              duty_assign.employee_name as duty_assign_name,
              duty_assign.signature AS duty_signature,
              line_manager.signature AS line_manager_signature,
              employees.signature AS applicant_signature,
              leave_table.employee_id,
              hr.employee_name AS hr_name,
              hr.signature AS hr_signature
              FROM
              leave_table
              INNER JOIN employees ON employees.employee_id = leave_table.employee_id
              INNER JOIN employees AS line_manager ON employees.line_manager_id = line_manager.employee_id
              INNER JOIN employees AS duty_assign ON leave_table.duty_assigned_to = duty_assign.employee_id
              INNER JOIN employees AS hr ON 1=1 AND hr.department = 3
              INNER JOIN department_table ON employees.department = department_table.department_id
              INNER JOIN designation_table ON employees.designation = designation_table.designation_id
              INNER JOIN leave_categories ON leave_table.catagory = leave_categories.leave_category_id
              WHERE leave_table.leave_id = $leave_id
              "))->first();

      $available_leave_array = [];
      foreach ($leave_categories as $leave) {
        $available_leave_array[$leave->leave_category_id] = $leave->available_days;
      }

      $availed_leave_array = [];
      $availed_leave_array[$leave_count->catagory] = $leave_count->count;
      
      $pdf = PDF::loadView('view',[
        'leave_details'=>$leave_details,
        'available_leave_array'=>$available_leave_array,
        'availed_leave_array'=>$availed_leave_array]);

     return $pdf->download('view.pdf');
      //return view('view',['leave_details'=>$leave_details,'available_leave_array'=>$available_leave_array,
      //'availed_leave_array'=>$availed_leave_array]);
    }
    public function view()
    {
        return view('view');
    }
//     public function index()
//     {
       
//        $pdf = PDF::loadView('view');
//            return $pdf->download('view.pdf');
//     }
     public function debit()
    {
         $employee = DB::table('debit')
                ->select('account_name','particulars',
         'taka',
          'total_taka',
           'taka_in_word',
            'received_by',
             'prepared_by',
              'checked_by',
                   'approved_by'
            )
                ->get();
        return view('debit',['employee'=>$employee]);
    }
      public function debit_pdf()
      {
        $pdf = PDF::loadView('debit');
           return $pdf->download('debit.pdf');

      }
      public function debit_input()
    {
         return view('debit_input');
    }
    public function conveyance_input()
    {
         return view('conveyance_input');
    }
     public function conveyance_submit(Request $request){
       $name = $request->input('name');

        $date = date('Y-m-d',strtotime($request->input('date')));
         $from = date('Y-m-d',strtotime($request->input('from')));
          $to = date('Y-m-d',strtotime($request->input('to')));
           $by = $request->input('by');
            $purpose = $request->input('date');
             $taka = $request->input('taka');
              $total = $request->input('total');
               $word = $request->input('word');
                $received_by = $request->input('received_by');
                 $prepared_by = $request->input('prepared_by');
                  $checked_by = $request->input('checked_by');
                   $approved_by = $request->input('approved_by');
        DB::table('conveyance')->insert(
            [
            'name' => $name,
        'date' => $date,
         'from' => $from,
          'to' => $to,
           'by' => $by,
            'purpose' => $date,
             'taka'=> $taka,
              
                'received_by' => $received_by,
                 'prepared_by' => $prepared_by,
                  'checked_by' => $checked_by,
                   'approved_by' => $approved_by
            
            ]);
        echo 'Inserted';
    }
     public function debit_submit(Request $request){
        $particulars = $request->input('particulars');
        $taka = $request->input('taka');
        $total_taka = $request->input('total_taka');
        $taka_in_word = $request->input('taka_in_word');
        $received_by = $request->input('received_by');
        $prepared_by = $request->input('prepared_by');
        $checked_by = $request->input('checked_by');
        $approved_by = $request->input('approved_by');
        
        DB::table('debit')->insert(
            ['particulars' => $particulars,
            'taka' => $taka,
            'total_taka' => $total_taka,
            'taka_in_word' => $taka_in_word,
            'received_by' => $received_by,
            'prepared_by' => $prepared_by,
            'checked_by' => $checked_by,
            'approved_by' => $approved_by

            ]);
        echo 'Inserted';
    }
    public function view_employee(){
        
        

        $employee=DB::table('employees')
              ->select('employee_id','employee_code','employee_name',
                'employee_email','department_table.department','designation_table.designation','is_line_manager','profile_image','signature')
               ->join('department_table', 'department_table.department_id', '=', 'employees.department')
                ->join('designation_table', 'designation_table.designation_id', '=', 'employees.designation')
              ->get();
              // dd($catagory);

        return view('view_employee',['employee'=>$employee]) ;
      }
      public function edit($employee_code = 'nai')
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
                      // dd($line_manager);
        $employee=DB::table('employees')
              ->select('employee_id','employee_code','employee_name','line_manager_id','password',
                'employee_email','department_table.department','designation_table.designation','designation_table.designation_id','is_line_manager','profile_image','signature','department_table.department_id')
               ->join('department_table', 'department_table.department_id', '=', 'employees.department')
                ->join('designation_table', 'designation_table.designation_id', '=', 'employees.designation')
                ->where('employee_code',$employee_code)
              ->first();


              // dd($employee);
        return view('employees.edit',['employee' =>$employee,'designations'=>  $designations,
                'departments' => $departments,
                'line_manager'=>$line_manager]);
      }
      public function updateEmployee(Request $request){
        //echo "hi"; exit;
        //dd('hi');
         //$employee=employee::find($employee_code);
          $employee_code = $request->input('employee_code');
        $employee_email = $request->input('employee_email');
        $employee_name = $request->input('employee_name');
        $designation =$request->input('designation');
        $department = $request->input('department');
        $line_manager_id = $request->input('line_manager_id');
        $password = $request->input('password');
        $is_line_manager = $request->input('is_line_manager');
        $status = $request->input('status');
         DB::table('employees')
         ->where('employee_code', $employee_code)
         ->update(
            [
            'employee_name' => $employee_name,
            'employee_email' => $employee_email,
            'designation' => $designation,
            'department' => $department,
            'line_manager_id' => $line_manager_id,
            //'profile_image' => $name,
            //'signature' => $signature,            
            'status' => $status
            ]);
          // ->where('employee_code', $employee_code->employee_code)
          //        ->update(['active' => true]);
    //     }
        return redirect('/view_employee');
    }
     public function leave_log()
    {
      $leave_details=DB::table('leave_table')
              ->select('leave_id','leave_status_table.leave_status','leave_table.created','employees.employee_id','employees.employee_name')
               ->leftJoin('employees', 'employees.employee_id', '=', 'leave_table.employee_id', 'employees.employee_name', '=', 'leave_table.employee_id')
               ->join('leave_status_table', 'leave_status_table.leave_status_id', '=', 'leave_table.status')
               
              ->get();

      //$data['leave_details'] = $leave_details;
      //dd($leave_details);

     //$pdf = PDF::loadView('view',['leave_details'=>$leave_details]);
           //return $pdf->download('view.pdf');
      return view('leave_log',['leave_details' =>$leave_details]);
    }
    //      DB::table('employees')
    //      ->where('active', false)
    //      ->chunkById(100, function ($employee_code) {
    //     foreach ($employee_code as $employee_code) {
    //         DB::table('employees')
    //             ->where('employee_code', $employee_code->employee_code)
    //             ->update(['active' => true]);
    //     }
    //     dd();
    // });
        //  $employee=employee::find($employee_code);
        // $employee->employee_code = $request->get('employee_code');
        // $employee->employee_email = $request->get('employee_email');
        // $employee->employee_name = $request->get('employee_name');
        // $employee->designation =$request->get('designation');
        // $employee->department = $request->get('department');
        // $employee->line_manager_id = $request->get('line_manager_id');
        // $employee->password = $request->get('password');
        // $employee->is_line_manager = $request->get('is_line_manager');
        // $employee->save();
        // return redirect()-route('employees_form')->with('success','Data Updated');
    public function leave_log_submit(Request $request){
            
        $employee_id=session()->get('employee_id');
        $employee_name=session()->get('employee_name');
        $department=session()->get('department');
        $designation=session()->get('designation');
        $line_manager=session()->get('line_manager');
         $leave_category = $request->input('leave_category');
         $leave_type = $request->input('leave_type');
        
         $start_date = date('Y-m-d',strtotime($request->input('fromdate')));
         $end_date = date('Y-m-d',strtotime($request->input('todate')));
         $leave_applied = $request->input('numberofdays');
         
         $remarks = $request->input('remarks');
        
         
        DB::table('leave_details')->insert(
            ['employee_id'=>$employee_id,
            'employee_name'=>$employee_name,
            'department'=>$department,
            'designation'=>$designation,    
            'leave_category' => $leave_category,
            'leave_type'=>$leave_type,
            
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'leave_applied'=>$leave_applied,
          
            'remarks'=>$remarks  
             
                   
            ]);
        echo 'Inserted';
    } 
    public function conveyance_view_received()
    {
      return view('conveyance_view_received');
    } 
}