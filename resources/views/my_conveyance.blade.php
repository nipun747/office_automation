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
  <h3 style="text-align: center;">Conveyance Sheet</h3>
  <table class="table table-striped">
 
  <tr> 

  <th >Employee Name:</th>
  <th >Date</th>
  <th >From</th>
  <th >To</th>
  <th >By</th>
  <th >Purpose</th>
  <th >Taka</th>
 <th>action</th>
 <th>Conveyance Log</th>
 <th>Download</th>
 </tr>
@foreach($conveyance as $employees)
  <tr>
 <td>{{$employees->name}}</td>
  <td >{{$employees->date}}</td>
  <td >{{$employees->from}}</td>
  <td >{{$employees->to}}</td>
  <td >{{$employees->by}}</td>
  <td >{{$employees->purpose}}</td>
  <td >{{$employees->taka}}</td>
  @if($employees->status == 3)
    <td class="action_td{{$employees->id}}"><a onclick="my_conveyance({{$employees->id}},1)"><i  class="fa fa-check"></i></a><a onclick="my_conveyance({{$employees->id}},0)"> <i class="fa fa-times"></i></a>
    </td>
    @elseif($employees->status == 4)
    <td><span class="label label-primary">Received</span></td>
     @elseif($employees->status == 5)
    <td><span class="label label-danger">Rejected</span></td>
    @else
    <td>-</td>
    @endif
    
  <td><a href="{{url('conveyance_log')}}/{{$employees->id}}"> <button class="btn btn-w-m btn-info">view </button></a> </td>
     <td><a href="{{url('/conveyance_pdf')}}/{{$employees->id}}"><i class = "fa fa-download"></i><a></td>
 </tr>
 
 @endforeach
 
</table>
<a class="btn btn-primary" href="{{url('/conveyance_excel')}}" role="button">Generate Excel</a>

</body>
@endsection
@section('js')
<script type="text/javascript">
  function my_conveyance(id,status){    
  
    $.ajax({
      url: "{{url('/myconveyance')}}",
      type: 'GET',
      data: {id:id,status:status},
      success: function(response) {
        console.log(response);
            if(response == 4){
              $('.action_td'+id).html('');
              $('.action_td'+id).html('<span class="label label-primary">Received</span>');
            }else if(response == 5){
              $('.action_td'+id).html('');
              $('.action_td'+id).html('<span class="label label-danger">Rejected</span>');
            }else{

            }
      }
    });
}
</script>

@endsection
  <!-- 
    @if($employees->status>= 1 && $employees->status<=2)
    <td><span class="label label-primary">On hold</span></td>
    @elseif($employees->status == 3)
    <td><span class="label label-primary">Accepted</span></td>
     @else($employees->status == 5)
    <td><span class="label label-danger">Rejected</span></td>
    @endif
    <td><a href="{{url('conveyance_log')}}/{{$employees->id}}"> <button class="btn btn-w-m btn-info">view </button></a> </td>
     <td><a href="{{url('/conveyance_pdf')}}/{{$employees->id}}"><i class = "fa fa-download"></i><a></td>
 </tr>
  -->
 

 


