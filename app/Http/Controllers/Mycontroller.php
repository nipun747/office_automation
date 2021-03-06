<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Border;
use Illuminate\Http\Request;
use DB;
use DateTime;
use Session;
use PDF;
use Mail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
        $employee_id=session()->get('employee_id');
        //echo $employee_id;

        $catagories = DB::table('leave_categories')
                            ->select('leave_categories.*')
                            ->where('status',1)
                            ->get();
     $employee_names = DB::table('employees')
                     ->select('employees.*')
                            ->where('status',1)
                            ->where('employee_id','<>',$employee_id)
                            ->get();

                            //dd($employee_names);
        
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
        
      Session()->flash('Success', 'Leave Submitted successfully!');
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

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
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
            'password' => md5($randomString),
            'is_line_manager' => $is_line_manager
            ]);

        $text = 'A new account has been created for you in Apsis Automation. <br> Please Login with following credentials.<br>Email : '.$employee_email.'<br>Password : '.$randomString.'.<br>If you face any problem feel free to contact HRD section.<br>Best Regards<br>HRD Section<br>Apsis Solutions Ltd.';

        $data = array('name'=>$employee_name,'employee_email'=>$employee_email,'employee_name'=>$employee_name,'text'=>$text);
   
        Mail::send('mail', $data, function($message) use ($data) {
           $message->to($data['employee_email'], $data['employee_name'])->subject
              ('New Account Created');
           $message->from('xyz@gmail.com','Apsis HRD');
        });

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
                ->select('employee_id','employee_name','designation','department','line_manager_id','is_line_manager','employee_email','profile_image')
                ->where('employee_email', $employee_email)
                ->where('password', md5($password))
                ->get();
        if(count($employee) > 0){

            Session::put('employee_name', $employee[0]->employee_name);
            Session::put('designation', $employee[0]->designation);
            Session::put('department', $employee[0]->department);
            Session::put('line_manager_id', $employee[0]->line_manager_id);
            Session::put('employee_email', $employee[0]->employee_email);
            Session::put('employee_id', $employee[0]->employee_id);
            Session::put('profile_image', $employee[0]->profile_image);
            Session::put('is_line_manager', $employee[0]->is_line_manager);

            //$request->session()->flush();

            if ($request->session()->has('employee_name')) {
                echo  Session::get('employee_name', $employee[0]->employee_name);
            }
            //exit;
            return redirect('/');
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
       return redirect('login');
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
                          dd($employee_names);
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
    {
        return view('conveyance');
     
    }
    // public function index()
    // {
    //      $pdf = PDF::loadView('conveyance');
    //        return $pdf->download('conveyance.pdf');
    // }

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
                IFNULL(SUM(leave_table.leave_applied),0) as count
                FROM
                leave_table
                WHERE
                leave_table.employee_id =  $leave_applicant_id 
                AND leave_table.`status` = 4
                GROUP BY leave_table.catagory
                "))->first();
      //dd($leave_count);

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
        //if(!empty($leave_count)){
          $available_leave_array[$leave->leave_category_id] = $leave->available_days;
        //}
        
      }

//dd($leave_categories);
      $availed_leave_array = [];
      if(!empty($leave_count)){
          $availed_leave_array[$leave_count->catagory] = $leave_count->count;
        }
      
      
      $pdf = PDF::loadView('view',[
        'leave_details'=>$leave_details,
        'available_leave_array'=>$available_leave_array,
        'availed_leave_array'=>$availed_leave_array]);

     return $pdf->download('Leave form of '.$leave_details->employee_name.'.pdf');
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
         // $employee = DB::table('debit')
         //        ->select('account_name','particulars',
         // 'taka',
         //  'total_taka',
         //   'taka_in_word',
         //    'received_by',
         //     'prepared_by',
         //      'checked_by',
         //           'approved_by'
         //    )
         //        ->get();
        return view('debit');
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
       $employee_name=session()->get('employee_name');
        $employee_id=session()->get('employee_id');
        $is_line_manager=session()->get('is_line_manager');

        $date = date('Y-m-d',strtotime($request->input('date')));
         $from = $request->input('from');
          $to = $request->input('to');
           $by = $request->input('by');
            $purpose = $request->input('purpose');
             $taka = $request->input('taka');
              $profile_image = $request->input('profile_image');

            $status='1';
        $is_line_manager== $status='2';
        if ( $request->hasFile('profile_image')){
                if ($request->file('profile_image')->isValid()){
                    $file = $request->file('profile_image');
                    $profile_image = $file->getClientOriginalName();
                    $file->move('images' , $profile_image);
                    $inputs = $request->all();
                    $inputs['path'] = $profile_image;
                }                
            }
              
        DB::table('conveyance')->insert(
            ['employee_id'=>$employee_id,
            'name' => $employee_name,
            'status' => $status,
            
        'date' => $date,
         'from' => $from,
          'to' => $to,
           'by' => $by,
            'purpose' => $purpose,
             'taka'=> $taka,
              'profile_image'=>$profile_image
                
            ]);
       return view('conveyance_input')->with('Success','Leave Inserted Successfully');
    }
     public function debit_submit(Request $request){

 
      $employee_name=session()->get('employee_name');
       $employee_id=session()->get('employee_id');
        $particulars = $request->input('particulars');
        $taka = $request->input('taka');
        $total_taka = $request->input('total_taka');
        $taka_in_word = $request->input('taka_in_word');
        $received_by = $request->input('received_by');
        $prepared_by = $request->input('prepared_by');
        $checked_by = $request->input('checked_by');
        $approved_by = $request->input('approved_by');
        $is_line_manager=session()->get('is_line_manager');

        $date = date('Y-m-d',strtotime($request->input('date')));
        
         $status='1';
        $is_line_manager== $status='2';
if ( $request->hasFile('profile_image')){
                if ($request->file('profile_image')->isValid()){
                    $file = $request->file('profile_image');
                    $profile_image = $file->getClientOriginalName();
                    $file->move('images' , $profile_image);
                    $inputs = $request->all();
                    $inputs['path'] = $profile_image;
                }                
            }
        DB::table('debit')->insert(
            ['employee_id'=>$employee_id,
              'account_name'=>$employee_name,
              'particulars' => $particulars,
            'taka' => $taka,
            'date'=>$date,
            'total_taka' => $total_taka,
            'taka_in_word' => $taka_in_word,
            'attachment'=>$profile_image

            ]);
        echo 'Inserted';
    }
    public function view_employee(){
        
        

        $employee=DB::table('employees')
              ->select('employees.employee_id','employees.employee_code','employees.employee_name',
                'employees.employee_email','department_table.department','designation_table.designation','employees.is_line_manager','employees.profile_image','employees.signature','line_manager.employee_name as line_manager_name')
               ->join('department_table', 'department_table.department_id', '=', 'employees.department')
                ->join('designation_table', 'designation_table.designation_id', '=', 'employees.designation')
                ->join('employees as line_manager','employees.line_manager_id', '=', 'line_manager.employee_id')
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
       
        $employee_code = $request->input('employee_code');
        $employee_email = $request->input('employee_email');
        $employee_name = $request->input('employee_name');
        $designation =$request->input('designation');
        $department = $request->input('department');
         // $profile_image = $request->input('profile_image');
          // $signature = $request->input('signature');
        $line_manager_id = $request->input('line_manager_id');
        $password = $request->input('password');
        $is_line_manager = $request->input('is_line_manager');
        $status = $request->input('status');

        $user_data = collect(\DB::select("SELECT profile_image ,signature
                                        FROM `employees` 
                                        WHERE employee_code = '$employee_code'"))->first();
       $profile_image = $user_data->profile_image;
       $signature = $user_data->signature;

        if ($status !=1 ) $status=0;
        
        if ( $request->hasFile('profile_image')){
                if ($request->file('profile_image')->isValid()){
                    $file = $request->file('profile_image');
                    $profile_image = $file->getClientOriginalName();
                    $file->move('images' , $profile_image);
                    $inputs = $request->all();
                    $inputs['path'] = $profile_image;
                }                
            }

       if ( $request->hasFile('signature')){
          if ($request->file('signature')->isValid()){
              $file = $request->file('signature');
              $signature = $file->getClientOriginalName();
              $file->move('images' , $signature);
              $inputs = $request->all();
              $inputs['path'] = $signature;           
          
          }
      }


        //dd($status);
         DB::table('employees')
         ->where('employee_code', $employee_code)
         ->update(
            [
            'employee_name' => $employee_name,
            'employee_email' => $employee_email,
            'designation' => $designation,
            'department' => $department,
            'line_manager_id' => $line_manager_id,
            'profile_image' => $profile_image,
            'signature' => $signature,            
            'status' => $status
            ]);
          
        return redirect('/view_employee')->with('success','Profile Updated Successfully!');
    }
     public function leave_log()
    {
      $employee_id = session()->get('employee_id');
      $leave_details= DB::SELECT(DB::RAW("SELECT
          leave_categories.leave_category,
          leave_table.start_date,
          leave_table.end_date,
          leave_table.leave_applied,
          leave_table.leave_type,
          leave_table.reason,
          `user`.employee_name,
          CASE WHEN leave_log.`status` = 1 THEN 'Accepted' ELSE 'Rejected' END AS leave_status
          FROM
          leave_log
          INNER JOIN leave_table ON leave_log.leave_id = leave_table.leave_id
          INNER JOIN employees AS `user` ON leave_log.user_id = `user`.employee_id
          INNER JOIN leave_categories ON leave_table.catagory = leave_categories.leave_category_id
          WHERE leave_table.employee_id = $employee_id "));

      return view('leave_log',['leave_details' =>$leave_details]);
    }
   
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
    // public function conveyance_for_received()
    // {$user_id = session()->get('employee_id');
    //  $conveyance=DB::table('conveyance')
    //                   ->select('conveyance.status','id','name','date','to','by','purpose','taka','received_by','prepared_by','checked_by','approved_by','conveyance_status.conveyance_status')
    //                   ->join('conveyance_status', 'conveyance_status.conveyance_status_id', '=', 'conveyance.status')
    //                    ->join('employees', 'employees.employee_id', '=', 'conveyance.id')
    //                   ->where('employees.line_manager_id',$user_id )
    //                   ->get();
    //  // $assignedDuty=DB::table('leave_table')
    //  //                  ->select('leave_table.status','leave_table.leave_id','leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','duty_assigned_to','employees.employee_name','leave_categories.leave_category')
    //  //                  ->join('employees', 'employees.employee_id', '=', 'leave_table.employee_id')
    //  //                  ->join('leave_categories', 'leave_table.catagory', '=', 'leave_categories.leave_category_id')
    //  //                  ->where('leave_table.duty_assigned_to',$user_id )
    //  //                  ->orderBy('leave_table.created','DESC')
    //  //                   ->get();
    //  //          return view('employees.leave_view_form',['assignedDuty'=>$assignedDuty]);
    //  //    // $status=DB::table('conveyance_status')
    //  //    //            ->select('conveyance_status.*')
    //  //    //            ->get();             
    //           return view('conveyance_view_received',['conveyance'=>$conveyance]);
      
    // } 
    public function conveyance_view_received()
    {

        $line_id = session()->get('employee_id');
       //dd($line_id);


      //$conveyance=[];
     $conveyance= DB::table('conveyance')
                      ->select('conveyance.status','conveyance.id','name','from','date',
                                'to','by','purpose','taka','conveyance.employee_id','employees.employee_id','employees.line_manager_id','employees.is_line_manager')
                      ->join('conveyance_status', 'conveyance_status.conveyance_status_id', '=', 'conveyance.status')
                       ->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                      // ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                       ->where('employees.line_manager_id',$line_id )
                      ->get();

             return view('conveyance_view_received',['conveyance'=>$conveyance]);
    }

   //   public function viewAssignedDuty()
   // {
   //  $user_id = session()->get('employee_id');
   //  $assignedDuty=DB::table('conveyance')
   //                    ->select('leave_table.status','leave_table.leave_id','leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','duty_assigned_to','employees.employee_name','leave_categories.leave_category')
   //                    ->join('employees', 'employees.employee_id', '=', 'leave_table.employee_id')
   //                    ->join('leave_categories', 'leave_table.catagory', '=', 'leave_categories.leave_category_id')
   //                    ->where('leave_table.duty_assigned_to',$user_id )
   //                    ->orderBy('leave_table.created','DESC')
   //                     ->get();
   //            return view('conveyance_view_received',['assignedDuty'=>$assignedDuty]);
   // }
   // public function accRejectDuty(Request $request){
      
      
   //    $leave_id = $request->input('leave_id');
   //    $status = $request->input('status');
   //    if($status == 1){
   //      $update_status = 2;
   //    }else{
   //      $update_status = 5;
   //    }
   //    DB::table('leave_table')
   //        ->where('leave_id',$leave_id)
   //        ->update(['status'=>$update_status]);

   //    $employee_id=session()->get('employee_id');
   //    DB::table('leave_log')
   //        ->insert(['user_id'=>$employee_id,'leave_id'=>$leave_id,'status'=>$status]);

   //    return $update_status;


   // }
    
    public function conveyance_for_received()
   {
    $line_id = session()->get('employee_id');
    $conveyance=DB::table('conveyance')
                      ->select('conveyance.status','conveyance.id','name','from',
                                'to','by','purpose','taka','conveyance.employee_id','employees.employee_id','employees.line_manager_id')
                      ->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                      ->join('conveyance_status', 'conveyance.status', '=', 'conveyance_status.conveyance_status_id')
                         ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                      //->where('employees.line_manager_id',$line_id )
                      
                       ->get();

              return view('conveyance_view_received',['conveyance'=> $conveyance]);
   }
   public function conveyancefunction(Request $request){
      
      
      $id = $request->input('id');
      $status = $request->input('status');
      if($status == 1){
        $update_status = 2;
      }else{
        $update_status = 5;
      }
      DB::table('conveyance')
          ->where('id',$id)
          ->update(['status'=>$update_status]);

             $employee_id=session()->get('employee_id');
                  DB::table('conveyance_log')
                  ->insert(['user_id'=>$employee_id,'conveyance_id'=>$id,'status'=>$status]);

                return $update_status;
      

   }
   public function conveyance_pdf($id)
    {

       $conveyance= DB::table('conveyance')
                      ->select('status','name','from','id','conveyance.date','to','by','purpose','taka','received_by','prepared_by','employee_id','checked_by','approved_by','profile_image')
                      ->where('id', $id)
                       //->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                       //->where('employees.line_manager_id',$line_id )
                     ->first()->employee_id;

      $leave_details = collect(\DB::SELECT("SELECT
              employees.employee_name,
              conveyance.id,
              conveyance.name,
              conveyance.date,
              conveyance.from,
              conveyance.to,
              conveyance.by,
              conveyance.purpose,
              conveyance.taka,
              conveyance.profile_image,
              conveyance.`status`,
              line_manager.signature AS line_manager_signature,
              employees.signature AS applicant_signature,
               hr.signature AS hr_signature
              FROM
              conveyance
              INNER JOIN employees ON employees.employee_id = conveyance.employee_id
              INNER JOIN employees AS line_manager ON employees.line_manager_id = line_manager.employee_id
               
              INNER JOIN employees AS hr ON 1=1 AND hr.department = 3
              
              INNER JOIN department_table ON employees.department = department_table.department_id
              INNER JOIN designation_table ON employees.designation = designation_table.designation_id
              INNER JOIN conveyance_status ON conveyance.status = conveyance_status.conveyance_status_id
              WHERE conveyance.id = $id
              "))->first();

     $pdf = PDF::loadView('conveyance',[
        'conveyance'=>$conveyance,'leave_details'=>$leave_details]);
      return $pdf->download('conveyance of '.$leave_details->employee_name.'.pdf');
      //return view('conveyance',['conveyance'=>$conveyance,'leave_details'=>$leave_details]);
    }
    public function conveyance_view_received_md()
    {
      $line_id = session()->get('employee_id');
       //dd($line_id);


      //$conveyance=[];
     $conveyance= DB::table('conveyance')
                      ->select('conveyance.status','conveyance.id','name','from','date',
                                'to','by','purpose','taka','conveyance.employee_id','employees.employee_id','employees.line_manager_id','employees.is_line_manager')
                      ->join('conveyance_status', 'conveyance_status.conveyance_status_id', '=', 'conveyance.status')
                       ->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                      // ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                       //->where('employees.line_manager_id',$line_id )
                       ->orderBy('conveyance.id','DESC')
                      ->get();
     
     
      return view('conveyance_view_received_md',['conveyance'=>$conveyance]);
    }
    public function mdfunction() 
   {
    
    $line_id = session()->get('employee_id');
    $conveyance=DB::table('conveyance')
                      ->select('conveyance.status','conveyance.id','name','from',
                                'to','by','purpose','taka','conveyance.employee_id','employees.employee_id','employees.line_manager_id')
                      ->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                      ->join('conveyance_status', 'conveyance.status', '=', 'conveyance_status.conveyance_status_id')
                         ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                      //->where('employees.line_manager_id',$line_id )
                      
                       ->get();
              

                        //dd($lineDuty[0]->status);
              return view('conveyance_view_received_md',['conveyance'=> $conveyance]);
              // return view('employees.lineleave_view_form',['lineDuty'=>$lineDuty]);
   }
    public function mdfunctionagain(Request $request){
      
      $id = $request->input('id');
      $status = $request->input('status');
      if($status == 1){
        $update_status = 3;
      }else{
        $update_status = 5;
      }
      DB::table('conveyance')
          ->where('id',$id)
          ->update(['status'=>$update_status]);

      $employee_id=session()->get('employee_id');
                  DB::table('conveyance_log')
                  ->insert(['user_id'=>$employee_id,'conveyance_id'=>$id,'status'=>$status]);

                return $update_status;
      // DB::table('leave_log')
      //     ->insert(['user_id'=>$employee_id,'leave_id'=>$leave_id,'status'=>$status]);

      return $update_status;

      
  
}
 public function myconveyance(Request $request){
      
      $id = $request->input('id');
      $status = $request->input('status');
      if($status == 1){
        $update_status = 4;
      }else{
        $update_status = 5;
      }
      DB::table('conveyance')
          ->where('id',$id)
          ->update(['status'=>$update_status]);

      $employee_id=session()->get('employee_id');
       DB::table('conveyance_log')
          ->insert(['user_id'=>$employee_id,'conveyance_id'=>$id,'status'=>$status]);

      // DB::table('leave_log')
      //     ->insert(['user_id'=>$employee_id,'leave_id'=>$leave_id,'status'=>$status]);

      return $update_status;

      
  
}
public function conveyance_for_employee()
    {    $line_id = session()->get('employee_id');

     
 $conveyance= DB::table('conveyance')
                      ->select('conveyance.status','name','from','id','conveyance.date','to','by','purpose','taka','received_by','prepared_by','conveyance.employee_id','checked_by','approved_by','conveyance.profile_image','employees.employee_id')
                      //->where('id', $id)
                       ->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                       ->where('employees.employee_id',$line_id )
                     ->first();
                 
     

      $leave_details = collect(\DB::SELECT("SELECT
              employees.employee_name,
              conveyance.id,
              conveyance.name,
              conveyance.date,
              conveyance.from,
              conveyance.to,
              conveyance.by,
              conveyance.purpose,
              conveyance.taka,
              conveyance.profile_image,
              conveyance.`status`,
              line_manager.signature AS line_manager_signature,
              employees.signature AS applicant_signature,
               hr.signature AS hr_signature
              FROM
              conveyance
              INNER JOIN employees ON employees.employee_id = conveyance.employee_id
              INNER JOIN employees AS line_manager ON employees.line_manager_id = line_manager.employee_id
               
              INNER JOIN employees AS hr ON 1=1 AND hr.department = 3
              
              INNER JOIN department_table ON employees.department = department_table.department_id
              INNER JOIN designation_table ON employees.designation = designation_table.designation_id
              INNER JOIN conveyance_status ON conveyance.status = conveyance_status.conveyance_status_id
              WHERE conveyance.id = id
              "))->first();

      
      
      // $pdf = PDF::loadView('conveyance',[
      //   'conveyance'=>$conveyance,'leave_details'=>$leave_details]);
      // return $pdf->download('conveyance of '.$leave_details->employee_name.'.pdf');
      return view('conveyance_for_employee',['conveyance'=>$conveyance,'leave_details'=>$leave_details]);
    }
    public function my_conveyance()
    {
       $employee_id = session()->get('employee_id');
      
      //$conveyance=[];
     $conveyance= DB::table('conveyance')
                      ->select('conveyance.status','conveyance.id','name','from','date',
                                'to','by','purpose','taka','conveyance.employee_id','employees.employee_id','employees.line_manager_id','employees.is_line_manager')
                      ->join('conveyance_status', 'conveyance_status.conveyance_status_id', '=', 'conveyance.status')
                       ->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                      // ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                       ->where('employees.employee_id',$employee_id )
                       ->orderBy('conveyance.id','DESC')
                      ->get();
     return view('my_conveyance',['conveyance'=>$conveyance]);
    }
    public function conveyance_log()
    {
      $employee_id = session()->get('employee_id');
      $conveyance= DB::SELECT(DB::RAW("SELECT
         
          conveyance_log.created,
          conveyance_log.status,
          conveyance_log.user_id,
          conveyance_log.conveyance_id,
          user.employee_name,
          CASE WHEN conveyance_log.`status` = 1 THEN 'Accepted' ELSE 'Rejected'

           END AS conveyance_status
          FROM
          conveyance_log
          INNER JOIN conveyance ON conveyance_log.conveyance_id = conveyance.id
          INNER JOIN employees AS user ON conveyance_log.user_id = `user`.employee_id
          INNER JOIN conveyance_status ON conveyance_log.status = conveyance_status.conveyance_status_id
          WHERE conveyance.employee_id = $employee_id "));
      // dd($conveyance);

      return view('conveyance_log',['conveyance' =>$conveyance]);
     
    }
    public function profile()
    {
       $employee_id = session()->get('employee_id');

       //dd($line_id);

       $profile_image = DB::table('employees')
              ->select('employees.profile_image')
             ->where('employees.employee_id',$employee_id )
              ->first()->profile_image;
             // dd($profile_image);
      return view ('profile',['profile_image'=>$profile_image]);
    }
    public function update_image(Request $request)
    {
      $employee_id = session()->get('employee_id');
       $password =  md5($request->input('password'));

        $profile_image = $request->input('profile_image');

        if ( $request->hasFile('profile_image')){
                if ($request->file('profile_image')->isValid()){
                    $file = $request->file('profile_image');
                    $profile_image = $file->getClientOriginalName();
                    $file->move('images' , $profile_image);
                }                
            }

      DB::table('employees')->where('employee_id', $employee_id)->update(array('profile_image' => $profile_image));

      return redirect('/profile')->with('success','Profile Updated Successfully!');
    }
    public function edit_profile($employee_code = 'nai')
      {
        $profile_image=DB::table('employees')
              ->select('profile_image','password')
               // ->join('department_table', 'department_table.department_id', '=', 'employees.department')
               //  ->join('designation_table', 'designation_table.designation_id', '=', 'employees.designation')
                ->where('employee_code',$employee_code)
              ->first();


              // dd($employee);
        return view('edit_profile',['profile_image' =>$profile_image
              ]);
      }
      public function change_password()
      {
        return view('change_password');
      }
       public function password()
    {
     
      return view ('password');
    }
    public function update_password(Request $request)
    {
      $employee_id = session()->get('employee_id');
       $password =  md5($request->input('password'));

DB::table('employees')->where('employee_id', $employee_id)->update(array('password' => $password));

      return redirect('/')->with('success','Password Updated Successfully!');
    }
    public function debit_view_line()
    {
      $line_id = session()->get('employee_id');
       //dd($line_id);


      //$conveyance=[];
     $debit= DB::table('debit')
                      ->select('debit.status','debit.debit_id','account_name','particulars','date',
                                'taka','total_taka','taka_in_word','debit.employee_id','employees.employee_id','employees.line_manager_id','employees.is_line_manager')
                      ->join('debit_status', 'debit_status.debit_status_id', '=', 'debit.status')
                       ->join('employees', 'employees.employee_id', '=', 'debit.employee_id')
                    // ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                       ->where('employees.line_manager_id',$line_id )
                      ->get();

     
             return view('debit_view_line',['debit'=>$debit]);
    }
    public function debit_function(Request $request){
      
      
      $debit_id = $request->input('debit_id');
      $status = $request->input('status');
      if($status == 1){
        $update_status = 2;
      }else{
        $update_status = 5;
      }
      DB::table('debit')
          ->where('debit_id',$debit_id)
          ->update(['status'=>$update_status]);

             // $employee_id=session()->get('employee_id');
             //      DB::table('conveyance_log')
             //      ->insert(['user_id'=>$employee_id,'conveyance_id'=>$id,'status'=>$status]);

                return $update_status;
      

   }
   public function debit_view_gm()
   {
     //$line_id = session()->get('employee_id');
       //dd($line_id);


      //$conveyance=[];
     $debit= DB::table('debit')
                      ->select('debit.status','debit.debit_id','account_name','particulars','date',
                                'taka','total_taka','taka_in_word','debit.employee_id','employees.employee_id','employees.line_manager_id','employees.is_line_manager')
                      ->join('debit_status', 'debit_status.debit_status_id', '=', 'debit.status')
                       ->join('employees', 'employees.employee_id', '=', 'debit.employee_id')
                    // ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                     //  ->where('employees.line_manager_id',$line_id )
                     ->orderBy('debit.debit_id','DESC')
                      ->get();
     

     
             return view('debit_view_gm',['debit'=>$debit]);

   }
   public function debit_function_check(Request $request){
      
      
      $debit_id = $request->input('debit_id');
      $status = $request->input('status');
      if($status == 1){
        $update_status = 3;
      }else{
        $update_status = 5;
      }
      DB::table('debit')
          ->where('debit_id',$debit_id)
          ->update(['status'=>$update_status]);

             // $employee_id=session()->get('employee_id');
             //      DB::table('conveyance_log')
             //      ->insert(['user_id'=>$employee_id,'conveyance_id'=>$id,'status'=>$status]);

                return $update_status;
      

   }
   public function debit_employee()
   {
     //$line_id = session()->get('employee_id');
       //dd($line_id);
 $employee_id = session()->get('employee_id');

      //$conveyance=[];
     $debit= DB::table('debit')
                      ->select('debit.status','debit.debit_id','account_name','particulars','date',
                                'taka','total_taka','taka_in_word','debit.employee_id','employees.employee_id','employees.line_manager_id','employees.is_line_manager')
                      ->join('debit_status', 'debit_status.debit_status_id', '=', 'debit.status')
                       ->join('employees', 'employees.employee_id', '=', 'debit.employee_id')
                    // ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                      ->where('employees.employee_id',$employee_id )
                     ->orderBy('debit.debit_id','DESC')
                      ->get();
     

      
      //$conveyance=[];
   
     
             return view('debit_employee',['debit'=>$debit]);

   }
    public function debit_function_letscheck(Request $request){
      
      
      $debit_id = $request->input('debit_id');
      $status = $request->input('status');
      if($status == 1){
        $update_status = 4;
      }else{
        $update_status = 5;
      }
      DB::table('debit')
          ->where('debit_id',$debit_id)
          ->update(['status'=>$update_status]);

             // $employee_id=session()->get('employee_id');
             //      DB::table('conveyance_log')
             //      ->insert(['user_id'=>$employee_id,'conveyance_id'=>$id,'status'=>$status]);

                return $update_status;
      

   }
    public function debit_pdf($debit_id)
    {

       $debit= DB::table('debit')
                      ->select('debit.status','debit.debit_id','account_name','particulars','date',
                                'taka','total_taka','taka_in_word','debit.employee_id','debit.attachment')
                      ->where('debit_id', $debit_id)
                       //->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                       //->where('employees.line_manager_id',$line_id )
                     ->first()->employee_id;

      $debit_details = collect(\DB::SELECT("SELECT
              employees.employee_name,
              debit.debit_id,
              debit.account_name,
              debit.date,
              debit.particulars,
              debit.taka,
              debit.total_taka,
              debit.taka_in_word,
              debit.taka,
              debit.attachment,
              debit.`status`,
              line_manager.signature AS line_manager_signature,
              employees.signature AS applicant_signature,
               hr.signature AS hr_signature
              FROM
              debit
              INNER JOIN employees ON employees.employee_id = debit.employee_id
              INNER JOIN employees AS line_manager ON employees.line_manager_id = line_manager.employee_id
               
              INNER JOIN employees AS hr ON 1=1 AND hr.department = 3
              
              INNER JOIN department_table ON employees.department = department_table.department_id
              INNER JOIN designation_table ON employees.designation = designation_table.designation_id
              INNER JOIN debit_status ON debit.status = debit_status.debit_status_id
              WHERE debit.debit_id = $debit_id
              "))->first();

     $pdf = PDF::loadView('debit',[
        'debit'=>$debit,'debit_details'=>$debit_details]);
      return $pdf->download('debit of '.$debit_details->employee_name.'.pdf');
      //return view('conveyance',['conveyance'=>$conveyance,'leave_details'=>$leave_details]);
    }
    public function test_page()
{
  
  

  $debit= DB::table('employees')
                      ->select('employees.employee_id','employees.line_manager_id','employees.employee_name')
                      ->get();
                      
  $data = [];
  $i = 0;
   foreach ($debit as $key => $value) {
      $data[$i]['employee_name'] = $value->employee_name;
      $data[$i]['employee_id'] = $value->employee_id;
      $data[$i]['line_manager_id'] = $value->line_manager_id;
      $i++;
    }
 // dd($data);
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$header = ['employee_name','employee_id','line_manager_id'];
$sheet->fromArray($header, null, 'A1');
$sheet->fromArray($data, null, 'A2');

//$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$time = date('Y-m-dHis');
$file_name = "hello world ".$time;
$writer->save($file_name.".xlsx");
}
 public function excels()
{
  $debit= DB::table('conveyance')
                      ->select('conveyance.status','conveyance.id','name','from','date',
                                'to','by','purpose','taka','conveyance.employee_id')
                                 ->get();

                      
  $data = [];
  $i = 0;
   foreach ($debit as $key => $value) {
      $data[$i]['status'] = $value->status;
      $data[$i]['name'] = $value->name;
      $data[$i]['purpose'] = $value->purpose;
      $i++;
    }
 // dd($data);
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$header = ['status','name','purpose'];
$sheet->fromArray($header, null, 'A1');
$sheet->fromArray($data, null, 'A2');

//$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$time = date('Y-m-dHis');
$file_name = "hello world ".$time;
$writer->save($file_name.".xlsx");
}
public function task()
{
  $employee_names = DB::table('employees')
                     ->select('employees.*')
                            ->where('status',1)
                            
                            ->get();

                            //dd($employee_names);
        
        return view('task',['employee_names'=>$employee_names]);
}
public function task_submit(Request $request){
      
     $employee_id=session()->get('employee_id');
     $employee_name = $request->input('employee_name');
     $task_name = $request->input('task_name');
     $task_type = $request->input('task_type');
     $date = date('Y-m-d',strtotime($request->input('date')));
    
     $comment = $request->input('comment');
    
         
        DB::table('leave_table')->insert(
            ['employee_id' => $employee_id,
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
        
      Session()->flash('Success', 'Leave Submitted successfully!');
      return redirect('/leave_form');
    }

 public function leave_log_excel()
{
   $employee_id = session()->get('employee_id');
   $leave_details= DB::SELECT(DB::RAW("SELECT
          leave_categories.leave_category,
          leave_table.start_date,
          leave_table.end_date,
          leave_table.leave_applied,
          leave_table.leave_type,
          leave_table.reason,
          `user`.employee_name,
          CASE WHEN leave_log.`status` = 1 THEN 'Accepted' ELSE 'Rejected' END AS leave_status
          FROM
          leave_log
          INNER JOIN leave_table ON leave_log.leave_id = leave_table.leave_id
          INNER JOIN employees AS `user` ON leave_log.user_id = `user`.employee_id
          INNER JOIN leave_categories ON leave_table.catagory = leave_categories.leave_category_id
          WHERE leave_table.employee_id = $employee_id "));

      
                      
  $data = [];
  $i = 0;
   foreach ($leave_details as $key => $value) {
      $data[$i]['leave_category'] = $value->leave_category;
      $data[$i]['start_date'] = $value->start_date;
      $data[$i]['end_date'] = $value->end_date;
      $data[$i]['leave_applied'] = $value->leave_applied;
      $data[$i]['leave_type'] = $value->leave_type;
      $data[$i]['reason'] = $value->reason;
      $data[$i]['employee_name'] = $value->employee_name;
      $data[$i]['leave_status'] = $value->leave_status;
      $i++;
    }
 // dd($data);
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$header = ['Leave Category','Start Date','End Date','Applied Leave(days)','Leave Type','Reason','Accepted by','Status'];
$sheet->fromArray($header, null, 'A3');
$sheet->fromArray($data, null, 'A4');
  $sheet->mergecells('A1:H1');
  //$sheet->setCellValue('A1', 'Hello World !');
$sheet->getStyle('A1:H9')->getAlignment()->applyFromArray( [ 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, 'textRotation' => 0] );
foreach(range('A','Z') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}
$sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2eb9d1');
//$sheet->setCellValue('A1', 'Hello World !');
$sheet->getStyle('A3:H3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('d1483f');

$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageMargins()->setTop(1);
$sheet->getPageMargins()->setRight(0.75);
$sheet->getPageMargins()->setLeft(0.75);
$sheet->getPageMargins()->setBottom(1);
$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'FFFF0000'],
        ],
    ],
];

$sheet->getStyle('A3:H9')->applyFromArray($styleArray);
// $sheet->getStyle('B9')->getBorders()->applyFromArray( [ 'allBorders' => [ 'borderStyle' => Border::BORDER_DASHDOT, 'color' => [ 'rgb' => '808080' ] ] ] );
// $sheet->getStyle('B2')->getBorders()->getTop()->applyFromArray( [ 'borderStyle' => Border::BORDER_DASHDOT, 'color' => [ 'rgb' => '808080' ] ] );
$writer = new Xlsx($spreadsheet);
$time = date('Y-m-dHis');
$file_name = "leave Log";
 
// Redirect output to a client’s web browser (Xlsx)
   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header('Content-Disposition: attachment;filename='.$file_name.'.xlsx');
   header('Cache-Control: max-age=0');
   // If you're serving to IE 9, then the following may be needed
   header('Cache-Control: max-age=1');
   // If you're serving to IE over SSL, then the following may be needed
   header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
   header('Pragma: public'); // HTTP/1.0

   //$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
   $writer->save('php://output');
   exit;

}
public function sidebar()
{
  $sidebar= DB::table('menu')
                      ->select('menu.name','menu.parent','menu.sub_menu')
                     ->where('parent','=','0')
                      ->get();
     
 $sub_menu=DB::table('menu')
               ->select('menu.name','menu.parent','menu.sub_menu','menu.menu_url','menu.sidebar_id')
               //->join('menu','menu.parent','=','menu.sidebar_id')
                     ->where('parent','=',DB::raw('sidebar_id'))
                      ->get();
     
    $leave_sub= DB::table('menu')
               ->select('menu.name','menu.parent','menu.sub_menu','menu.menu_url')
                     ->where('parent','=','2')
                      ->get();
     $conveyance_sub= DB::table('menu')
               ->select('menu.name','menu.parent','menu.sub_menu','menu.menu_url')
                     ->where('parent','=','3')
                      ->get();
                      //dd($sub_menu);
             return view('includes.sidebar',['sidebar'=>$sidebar,'sub_menu'=>$sub_menu,'leave_sub'=>$leave_sub,'conveyance_sub'=>$conveyance_sub]);
  
     
}
public function sidebar_menus()
{
  
  $main_menus = DB::table('menu')
                      ->select('menu.name','menu.menu_id','menu.sub_menu','menu.menu_url')
                     ->where('menu_type','=','1')
                      ->get();
     
  $sub_menus = DB::table('menu')
               ->select('menu.name','menu.parent','menu.sub_menu','menu.menu_url','menu.menu_id')
                     ->where('menu_type','=','2')
                    ->get();
      $html = '';
       foreach($main_menus as $main_menu){
                  if($main_menu->sub_menu == 1){
                  $html.= '<li>
                    <a href="index.html"><i class="fa fa-th-large"></i> 
                    <span class="nav-label">'.$main_menu->name.'</span> 

                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">';                       
                        
                    foreach($sub_menus as $sub_menu){
                      if($sub_menu->parent == $main_menu->menu_id){
                         $html.= '<li class="active"> 
                              <a href="'.url($sub_menu->menu_url).'">'. 
                              $sub_menu->name 
                              .'</a> </li>';                                
                          }
                        }
                        $html .= '</ul></li>';
                      } 
                else{
                $html.= '<li>
                    <a href="'.$main_menu->menu_url.'"><i class="fa fa-diamond"></i> <span class="nav-label">'.$main_menu->name.'</span></a>
                    </li>';
                  }
                }
                 

            echo $html;
  
     
}
public function conveyance_excel()
{
   $employee_id = session()->get('employee_id');
   $conveyance= DB::table('conveyance')
                      ->select('conveyance.status','conveyance.id','name','from','date',
                                'to','by','purpose','taka','conveyance.employee_id','employees.employee_id','employees.line_manager_id','employees.is_line_manager')
                      ->join('conveyance_status', 'conveyance_status.conveyance_status_id', '=', 'conveyance.status')
                       ->join('employees', 'employees.employee_id', '=', 'conveyance.employee_id')
                      // ->join('employees', 'employees.employee_id', '=', 'employees.is_line_manager')
                       ->where('employees.employee_id',$employee_id )
                       ->orderBy('conveyance.id','DESC')
                      ->get();

      
                      
  $data = [];
  $i = 0;
   foreach ($conveyance as $key => $value) {
    $data[$i]['name'] = $value->name;
      $data[$i]['date'] = $value->date;
      $data[$i]['from'] = $value->from;
      $data[$i]['to'] = $value->to;
      $data[$i]['by'] = $value->by;
      $data[$i]['purpose'] = $value->purpose;
      $data[$i]['taka'] = $value->taka;
      
      
      $i++;
    }
 // dd($data);
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$header = ['Employee Name','Date','From','To','By','Purpose','Taka'];
$sheet->fromArray($header, null, 'A3');
$sheet->fromArray($data, null, 'A4');
  $sheet->mergecells('A1:H1');
  //$sheet->setCellValue('A1', 'Hello World !');
$sheet->getStyle('A1:H9')->getAlignment()->applyFromArray( [ 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, 'textRotation' => 0] );
foreach(range('A','Z') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}
$sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2eb9d1');
//$sheet->setCellValue('A1', 'Hello World !');
$sheet->getStyle('A3:H3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('d1483f');

$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageMargins()->setTop(1);
$sheet->getPageMargins()->setRight(0.75);
$sheet->getPageMargins()->setLeft(0.75);
$sheet->getPageMargins()->setBottom(1);
$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => '34ebeb'],
        ],
    ],
];

$sheet->getStyle('A3:H9')->applyFromArray($styleArray);
// $sheet->getStyle('B9')->getBorders()->applyFromArray( [ 'allBorders' => [ 'borderStyle' => Border::BORDER_DASHDOT, 'color' => [ 'rgb' => '808080' ] ] ] );
// $sheet->getStyle('B2')->getBorders()->getTop()->applyFromArray( [ 'borderStyle' => Border::BORDER_DASHDOT, 'color' => [ 'rgb' => '808080' ] ] );
$writer = new Xlsx($spreadsheet);
$time = date('Y-m-dHis');
$file_name = "MY conveyance";
 
// Redirect output to a client’s web browser (Xlsx)
   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header('Content-Disposition: attachment;filename='.$file_name.'.xlsx');
   header('Cache-Control: max-age=0');
   // If you're serving to IE 9, then the following may be needed
   header('Cache-Control: max-age=1');
   // If you're serving to IE over SSL, then the following may be needed
   header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
   header('Pragma: public'); // HTTP/1.0

   //$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
   $writer->save('php://output');
   exit;

}
}