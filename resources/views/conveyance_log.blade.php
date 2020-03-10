 @extends('layouts.app')
@section('content')
  
  


                            <div class="ibox-content">

                                <div class="activity-stream">
                                	@foreach($conveyance as $conveyance)
                                    <div class="stream">
                                        <div class="stream-badge">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                        <div class="stream-panel">
                                            <div class="stream-info">
                                                <a href="#">
                                                	
                                                    <img src="img/a5.jpg" />
                                                    <span>{{$conveyance->employee_name}}</span>
                                                    <span class="date">{{$conveyance->created}}</span>
                                                    <span class="date">{{$conveyance->conveyance_status}}</span>
                                                    
                                           
                                                </a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                                    		


@endsection