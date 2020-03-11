@extends('layouts.app')
@section('content')

 <style>
table, th, td {
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
table#t01 {
  width: 100%;    
  background-color: #f1f1c1;
}
i{
  cursor: pointer;
}
</style>
<body >
  <h3 style="text-align: center;">Debit</h3>
  <table class="table table-striped">
 
  <tr> 

    <th >Employee Name:</th>
  <th >Date</th>
  <th >Particulars</th>
  <th >Taka</th>
  <th >Total Taka</th>
  <th >Taka in Word</th>
  
 <th>action</th>
 <th>Download</th>
 </tr>
@foreach($debit as $debits)
  <tr>
 <td>{{$debits->account_name}}</td>
  <td >{{$debits->date}}</td>
  <td >{{$debits->particulars}}</td>
  <td >{{$debits->taka}}</td>
  <td >{{$debits->total_taka}}</td>
  <td >{{$debits->taka_in_word}}</td>
  
   @if($debits->status == 1)
    <td class="action_td{{$debits->debit_id}}"><a onclick="debit_function({{$debits->debit_id}},1)"><i  class="fa fa-check"></i></a><a onclick="debit_function({{$debits->debit_id}},0)"> <i class="fa fa-times"></i></a>
    </td>
    @elseif($debits->status == 2 || $debits->status == 3 || $debits->status == 4)
    <td><span class="label label-primary">Accepted</span></td>
     @elseif($debits->status == 5)
    <td><span class="label label-danger">Rejected</span></td>
    @endif
     <td><a href="{{url('/conveyance_pdf')}}/{{$debits->debit_id}}"><i class = "fa fa-download"></i><a></td>
 </tr>
 
 
 @endforeach
 
</table>

</body>
@endsection
@section('js')
<script type="text/javascript">
  function debit_function(debit_id,status){    
  
    $.ajax({
      url: "{{url('/debit_function')}}",
      type: 'GET',
      data: {debit_id:debit_id,status:status},
      success: function(response) {
        console.log(response);
            if(response == 2){
              $('.action_td'+debit_id).html('');
              $('.action_td'+debit_id).html('<span class="label label-primary">Accepted</span>');
            }else if(response == 5){
              $('.action_td'+debit_id).html('');
              $('.action_td'+debit_id).html('<span class="label label-danger">Rejected</span>');
            }else{

            }
      }
    });
}
</script>

@endsection