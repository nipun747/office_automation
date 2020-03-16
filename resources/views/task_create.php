@extends('layouts.app')
@section('content')

  
  
 
<form enctype="multipart/form-data" action="{{url('/employee_form_submit')}}" method="post">
  @csrf
    <label for="create">Create Project:</label>
          <input type="text" name="employee_code" class="form-control">
        </div>
      </div>
      <div class="col-2 form-group has-feedback">
  <label> Assign Members</label>
<select name="employee_name" class="form-control">
  @foreach($employee_names as $employee_name)
  <option value = "{{$employee_name->employee_id}}">{{$employee_name->employee_name}}</option>
  @endforeach
  </select><br>
</div>
</div>

    <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>



@endsection
