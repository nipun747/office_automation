@extends('layouts.app')
@section('content')

<div class="col-lg-12">
   
<form action="{{url('/designation_form_submit')}}" method="post">
  
  @csrf
    <div class="col-lg-6 offset-lg-3">
  <h4 class="text-center">Leave Management</h4>
</div>
 
  
    
 
   <div class="form-group">
     <label for="designation">Designation:</label>
    
   
 <select name="designation" class="form-control">
  @foreach($designations as $designation)
  <option value = "{{$designation->designation_id}}">{{$designation->designation}}</option>
  @endforeach
  </select>
  

  </div>
   
   <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
@endsection