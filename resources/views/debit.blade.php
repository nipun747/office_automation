<html>
<a href="{{url('debit_pdf')}}">Convert into PDF</a>
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
  <p style="text-align:left"><b>Account Name:</b></p><p style="text-align:right"><b>Date:</b></p>
  <table style="width:100%">
  
 <tr>
  <th style="text-align:center;" colspan="5" width="40%">particulars</th>
  <th width="20%">Taka</th>
  
 
 </tr>
 @foreach($employee as $employees)
 <tr>
  <td colspan="5" width="40%" height="200px">{{$employees->particulars}}</td>
  <td  height="40%">{{$employees->taka}}</td>

 </tr>
 
 <tr>
  <th style="text-align:right;" colspan="5">Total taka=</th>
  <td>{{$employees->total_taka}}</td>
 </tr>
 <tr>
  <th style="text-align:left;" colspan="5">Taka in Word:</th>
  <td>{{$employees->taka_in_word}}</td>
  
 </tr>
 @endforeach
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

</body>
</html>
