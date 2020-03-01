@extends('layouts.app')
@section('content')

 <style>
table, th, td {
  border: 1px solid black;
   border-collapse:collapse;
}
</style> 

<body >
  <h3 style="text-align: center;">Conveyance Sheet</h3>
  <table style="width:100%"
 >
 <tr>
  <th >Employee Name:</th>
  <th colspan="14">@if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif</th>
 </tr>
 <tr>
   
  <th >Date</th>
  <th >From</th>
  <th >To</th>
  <th >By</th>
  <th >Purpose</th>
  <th >Taka</th>
 <th>action</th>
 </tr>
@foreach($conveyance as $employees)
  <tr>
 
  <td >{{$employees->date}}</td>
  <td >{{$employees->from}}</td>
  <td >{{$employees->to}}</td>
  <td >{{$employees->by}}</td>
  <td >{{$employees->purpose}}</td>
   <td >{{$employees->taka}}</td>
   @if($employees->status == 1)
    <td class="action_td{{$employees->id}}"><a onclick="conveyance_function({{$employees->id}},1)"><i  class="fa fa-check"></i></a><a onclick="conveyance_function({{$employees->id}},0)"> <i class="fa fa-times"></i></a>
    </td>
    @elseif($employees->status == 2)
    <td><span class="label label-primary">Accepted</span></td>
     @else($employees->status == 3)
    <td><span class="label label-danger">Rejected</span></td>
    @endif
 </tr>
 
 
 @endforeach
 
</table><br><br><br><br>
<p><b><u>Received by:</u></b></p><br><br>
  <p><b><u>Prepared by:</u>@if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif</b></p><br><br>
  <p><b><u>Checked by</u></b></p><br><br>
  <p><b><u>Approved by</u></b></p><br><br>

</body>
@endsection
@section('js')
<script type="text/javascript">
  function conveyance_function(id,status){    
  
    $.ajax({
      url: "{{url('/conveyancefunction')}}",
      type: 'GET',
      data: {id:id,status:status},
      success: function(response) {
            if(response == 2){
              $('.action_td'+id).html('');
              $('.action_td'+id).html('<span class="label label-primary">Accepted</span>');
            }else if(response == 3){
              $('.action_td'+id).html('');
              $('.action_td'+id).html('<span class="label label-danger">Rejected</span>');
            }else{

            }
      }
    });
}
</script>
@endsection