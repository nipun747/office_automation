<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apsis Automation | Login</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body  class="gray-bg">
    <form action="{{url('/login_form_submit')}}" method=post>
@csrf
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img src= "{{asset('assets/img/logo.png')}}">

            </div>
            <h3>Welcome to Apsis Automation</h3>
            <p>
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="text" name="employee_email" class="form-control" placeholder="Usercode" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
               
                
            </form>
            <p class="m-t"> <small>Apsis Solutions Ltd &copy; 2020</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>

    

</body>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        //alert("Settings page was loaded");
        //console.log("hii");
         $("h3").click(function(){
            $(this).fadeTo("slow",0.7);
          });
         $("p").click(function(){
            $(this).hide();
                });
         });

</script>



