@extends('layouts.app')
@section('content')
@if(Session::has('employee_name'))
    @foreach(Session::get('employee_name') as $employee_name)
        {{$employee_name['employee_id']}}
        {{$employee_name['employee_name']}}
        
    @endforeach
@endif
@endsection