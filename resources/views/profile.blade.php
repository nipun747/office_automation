@extends('layouts.app')
@section('content')
<img class="rounded-circle pp_img" style="height:500px;width:300px" src= "{{url('/images')}}/{{$profile_image}}">
<a href="{{url('update_image')}}"> <button class="btn btn-w-m btn-info">update </button></a>
@endsection
