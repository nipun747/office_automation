 <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="{{asset('assets/img/profile_small.jpg')}}"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">David Williams</span>
                            <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                            <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="active">
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Employee Panel</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         
                         @if(!session()->has('employee_name'))  <li><a href="{{url('login')}}">login</a></li> @endif
                        <li class="active"><a href="{{url('employees_form')}}">Employees Form</a></li>
                        <li><a href="{{url('view_employee')}}">view employee</a></li>  
                        <li><a href="{{url('department_form')}}">Department</a></li>
                        
                          

                          <li><a href="{{url('designation_form')}}">Designation</a></li>    
                      
                           
                        
                    </ul>
                </li>
                <li>
                     <li class="active">
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Leave Panel</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('leave_form')}}">Leave form</a></li>
                         
                          
                           <li><a href="{{url('hrviewLeave')}}">HR view leave</a></li>
                          <li><a href="{{url('viewPendingLeave')}}">Line Manager View Leave</a></li>
                          <li><a href="{{url('viewAssignedDuty')}}">Duty Assignee View Leave</a></li>

                          
                           <li><a href="{{url('leave_log')}}">Leave Log</a></li>
                           <li><a href="{{url('leave')}}">Leave</a></li>
                        
                    </ul>
                </li>
                <li>
                  <li class="active">
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Conveyance Panel</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                           <li><a href="{{url('conveyance_view_received')}}">conveyance checked by Line Manager</a></li>
                           <li><a href="{{url('conveyance_view_received_md')}}">conveyance approved by HR</a></li>
                           <li><a href="{{url('conveyance_input')}}">conveyance input</a></li>
                        
                        
                    </ul>
                </li>
                <li>
                    <li>
                  <li class="active">
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Debit Panel</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                       
                            <li><a href="{{url('debit')}}">debit pdf</a></li>
                             <li><a href="{{url('debit_input')}}">debit input</a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
                </li>
                
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">
                        @if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="{{asset('assets/img/a7.jpg')}}">
                                </a>
                                <div>
                                    <small class="float-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="{{asset('assets/img/a4.jpg')}}">
                                </a>
                                <div>
                                    <small class="float-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="{{asset('assets/img/profile.jpg')}}">
                                </a>
                                <div>
                                    <small class="float-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html" class="dropdown-item">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="float-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="profile.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="float-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="grid_options.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="float-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html" class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

                @if(session()->has('employee_name')) 
                      <li>
                        <a href="{{url('logout')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>

                @endif
               
                
            </ul>

        </nav>
        </div>