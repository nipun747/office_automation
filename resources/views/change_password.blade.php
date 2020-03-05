@extends('layouts.app')
@section('content')

  
  
 
<form enctype="multipart/form-data" action="{{url('/update_image')}}" method="post">
  @csrf
 <div class="form-group">
  <div class="col-lg-12 row">
  <div class="col-lg-6">
  <div class="form-group">
    <label for="password">Old Password:</label>   
    <input type="text" name="password" class="form-control">
  </div>
  </div>
</div>
<div class="form-group">
  <div class="col-lg-12 row">
  <div class="col-lg-6">
  <div class="form-group">
    <label for="password">New Password:</label>   
    <input type="text" name="password" class="form-control">
  </div>
  </div>
</div>
     <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
  @endsection