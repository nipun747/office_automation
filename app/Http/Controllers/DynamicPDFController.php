<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class DynamicPDFController extends Controller
{
    function index()
    {
        $employee = DB::table('employees')
                ->select('employee_name','designation','department','line_manager_id')
                ->get();
       $designation = DB::table('designation_table')
                ->select('designation')
                ->get();
        $catagory=DB::table('leave_table')
              ->select('leave_table.catagory','leave_type','start_date','end_date','leave_applied','reason','remarks','duty_assigned_to')
               ->join('employees', 'employees.employee_id', '=', 'leave_table.duty_assigned_to')
              ->get();
    	$customer_data=$this->get_customer_data();
    	return view('employee_view_form',['employee'=>$employee,'designation'=>$designation,'catagory'=>$catagory,'customer_data'=>$customer_data]);
    }
    function get_customer_data()
    {
    	$customer_data=DB::table('employees')
    	               ->limit(10)
    	               ->get();
    	               return $customer_data;
    }
    function pdf()
    {
    	//dd($this->convert_customer_data_to_html());
    	$pdf=\App::make('dompdf.wrapper');
    	//$pdf->loadHTML($this->convert_customer_data_to_html());
    	// dd($pdf);
    	//return  $pdf->stream();    	

    	$pdf = PDF::loadView('pdf_test');
		return $pdf->download('invoice.pdf');
    }
    function convert_customer_data_to_html()
    {
    	$customer_data=$this->get_customer_data();
    	$output='
  <table>  	
   <tr>
    <th>Employee Name</th>
    <th>Designation</th>
    <th>Department</th>
    <th>Line Manager</th>
      
  </tr>
';
  foreach($customer_data as $employees)
 {
 	$output .=
 	"<tr>
  <td>$employees->employee_name</td>
    <td>$employees->designation</td>
    <td>$employees->department</td>
    <td>$employees->line_manager_id</td>
  </tr>";
 }
 $output .='</table>';
 return $output;
 


    }
}
