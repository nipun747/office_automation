@extends('layouts.app')
@section('content')

<img class=" pp_img" style="height:300px;width:300px" src= "{{url('/images')}}/{{$profile_image}}">
<a href="{{url('edit_profile')}}"> <button class="btn btn-w-m btn-info">update </button></a>

@endsection
