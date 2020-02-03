@extends('layouts.app')
@section('content')

<div class="col-lg-12">
   
<form action="{{url('/department_form_submit')}}" method="post">
  
  @csrf
    <div class="col-lg-6 offset-lg-3">
  <h4 class="text-center">Leave Management</h4>
</div>

  
   
 
   
    <div class="form-group">
    <label for="department">Department:</label>
   
     <select name="department" class="form-control">
  @foreach($departments as $department)

<option value="{{$department->department_id}}">{{$department->department}}</option>
  @endforeach
    </select>
  </div>
   <div class="form-group">
    <label for="department_lead">Department Lead:</label>
    <input type="int" name="department_lead" class="form-control">
  </div>
  
   <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
@endsection