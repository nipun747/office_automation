<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class employeeController extends Controller
{
   public function viewAssignedDuty()
   {
   	$user_id = session()->get('employee_id');
   	$assignedDuty=DB::table('leave_table')
                      ->select('leave_table.status','leave_table.leave_id','leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','duty_assigned_to','employees.employee_name','leave_categories.leave_category')
                      ->join('employees', 'employees.employee_id', '=', 'leave_table.employee_id')
                      ->join('leave_categories', 'leave_table.catagory', '=', 'leave_categories.leave_category_id')
                      ->where('leave_table.duty_assigned_to',$user_id )
                       ->get();
              return view('employees.leave_view_form',['assignedDuty'=>$assignedDuty]);
   }
   public function accRejectDuty(Request $request){
   		
   		$leave_id = $request->input('leave_id');
   		$status = $request->input('status');
   		if($status == 1){
   			$update_status = 2;
   		}else{
   			$update_status = 5;
   		}
   		DB::table('leave_table')
   				->where('leave_id',$leave_id)
   				->update(['status'=>$update_status]);

   		return $update_status;

   }
   public function viewPendingLeave() 
   {
   	$line_id = session()->get('employee_id');
   	$lineDuty=DB::table('leave_table')
                      ->select('leave_table.status','leave_table.leave_id','leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','duty_assigned_to','employees.employee_name','leave_categories.leave_category')
                      ->join('employees', 'employees.employee_id', '=', 'leave_table.employee_id')
                      ->join('leave_categories', 'leave_table.catagory', '=', 'leave_categories.leave_category_id')
                      ->where('employees.is_line_manager',$line_id )
                       ->get();

                        // dd($lineDuty[0]->status);
              return view('employees.lineleave_view_form',['lineDuty'=>$lineDuty]);
              // return view('employees.lineleave_view_form',['lineDuty'=>$lineDuty]);
   }
    public function lineacceptRejectDuty(Request $request){
   		
   		$leave_id = $request->input('leave_id');
   		$status = $request->input('status');
   		if($status == 2){
   			$update_status = 3;
   		}else{
   			$update_status = 5;
   		}
   		DB::table('leave_table')
   				->where('leave_id',$leave_id)
   				->update(['status'=>$update_status]);

   		return $update_status;
	}

}

