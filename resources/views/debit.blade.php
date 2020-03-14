<html>
 <style>
table, th, td {
  border: 1px solid black;
   border-collapse:collapse;
   text-align: center;
}
.signTable th,.signTable td{
  border: 0px !important;
}
</style> 

<body style="width:90%">
  <h3 style="text-align:center;">Debit Voucher</h3>
  <p style="text-align:left"><b>Account Name:{{$debit_details->account_name}}</b></p><p style="text-align:right"><b>Date:{{date('d M Y',strtotime($debit_details->date))}}</b></p>
  <table style="width:100%">
  
 <tr>
  <th style="text-align:center;" colspan="5" width="40%">particulars</th>
  <th width="20%">Taka</th>
  
 
 </tr>

 <tr>
  <td colspan="5" width="40%" height="200px">{{$debit_details->particulars}}</td>
  <td  height="40%">{{$debit_details->taka}}</td>

 </tr>
 
 <tr>
  <th style="text-align:right;" colspan="5">Total taka=</th>
  <td>{{$debit_details->total_taka}}</td>
 </tr>
 <tr>
  <th style="text-align:left;" colspan="5">Taka in Word:</th>
  <td>{{$debit_details->taka_in_word}}</td>
  
 </tr>
 
  </table><br><br><br><br>

<table class="signTable" style="width: 100%;border:0px !important;">
  <tr>
    <td>
    
    </td>
    <td>
      </td>
      <td>
      
    
    </td>
    <td>
     
    </td>
  </tr>
  <tr>
    <td>
    @if($debit_details->status==4)
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$debit_details->applicant_signature}}">
    @endif
    </td>
    <td>
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$debit_details->applicant_signature}}"></td>
      <td>
      
     @if($debit_details->status>1 && $debit_details->status<5)
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$debit_details->line_manager_signature}}">@endif
    </td>
    <td>
      @if($debit_details->status==3 || $debit_details->status==4)
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$debit_details->hr_signature}}">
      @endif
    </td>
  </tr>
  <tr>

    <td>---------------------------</td>
    <td>---------------------------</td>
    <td>---------------------------</td>
    <td>---------------------------</td>
  </tr>

  <tr>
    <th>Received by : </th>
    <th>Prepared By :</th>
    <th>Checked by : </th>
    <th>Approved by : </th>
  </tr>
</table>
<br>
<h4><u>Attachment</u></h4>
<img style="height:200px;width:150px" src="{{url('/images')}}/{{$debit_details->attachment}}">

</body>
</html>
