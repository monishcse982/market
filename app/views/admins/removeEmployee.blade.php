<!DOCTYPE html>
<html>
  <head>
            <meta charset="UTF-8">
            <title>REMOVE EMPLOYEE</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script type="text/javascript">  
                    $(document).ready(function(){
                        var letters = /[A-Za-z]/g;
                        $("#removeEmployee").click(function() {
                            if (!(letters.test($("#empName").val())))
                            {
                                $("#errmsg").html("Username must contain only english letters").show().fadeOut("slow");
                            }
                           $.ajax({
                                    type: "PUT",
                                    url: "http://localhost:8000/removeUser",
                                    data: {"username":$("#empName").val()},
                                    content_type: "application/json; charset=UTF-8"
                               }); 
                           location.reload();
                        });
                    });
            </script>
            <style>
                    body {
                        background: 
                        linear-gradient(27deg, #151515 5px, transparent 5px) 0 5px,
                        linear-gradient(207deg, #151515 5px, transparent 5px) 10px 0px,
                        linear-gradient(27deg, #222 5px, transparent 5px) 0px 10px,
                        linear-gradient(207deg, #222 5px, transparent 5px) 10px 5px,
                        linear-gradient(90deg, #1b1b1b 10px, transparent 10px),
                        linear-gradient(#1d1d1d 25%, #1a1a1a 25%, #1a1a1a 50%, transparent 50%, transparent 75%, #242424 75%, #242424);
                        background-color: #131313;
                        no-repeat center center fixed;
                        -webkit-background-size: cover;
                        -moz-background-size: cover;
                        -o-background-size: cover;
                        background-size: cover;
                        font-family: 'Roboto', sans-serif;
                    }
                    .login-card 
	            {
	                padding: 40px;
	                width: 300px;
	                background-color: transparent;
	                margin-left: 486px;
	                margin-top: 112px;
	                overflow: hidden;
	                position: absolute;
	                border: 2px double #6AFB92;
	                border-radius:95px;
	            }

	            .login-card:hover
	            {
	                border: 5px solid #6AFB92;
	            }
	            .login-card input[type=text]
	            {
	                height: 44px;
	                font-size: 18px;
	                width: 100%;
	                margin-bottom: 10px;
	                background: transparent;
	                border: transparent;
	                padding: 0 8px;
	                box-sizing: border-box;
	                -moz-box-sizing: border-box;
	                color: white;
	            }
	            .login-card input[type=button] 
	            {
	                width: 100%;
	                padding: 10px;
	                display: compact;
	                margin-bottom: 10px;
	                position: relative;
	                border-radius: 15px;
	            }
	             .login-card input[type=text]:hover
	             {
	                border: 2px solid #6AFB92;
	            }
	            .login-card input[type="button"]:hover 
	            {
	                border: 0;
	                text-shadow: 0 1px rgba(0,0,0,0.3);
	                background-color: darkred;
	            }
                    .logout-button
                    {
                    position:fixed;
                    top:5px;
                    right:5px;
                    padding: 8px;
                    padding-bottom: 2px;
                    border-radius:85px;
                    border: 0px;
                    color: #fff;
                    text-shadow: 0 px rgba(0,0,0,0.1);
                    background-color: grey;
                    }
                    
                    .logout-button:hover
                    {
                        background-color: #7D2B2D; 
                    }
                    .messages
                    {
                        background: slategrey;
                        color: #fff;
                        padding: 20px;
                        margin-bottom: 20px;
                        border-radius:95px;
                        text-align: center;
                    }
                     #errmsg
                    {
                    color: red;
                    }
            </style>
    </head>
<body>
 		@if(Session::has('messages'))
                       <div class="messages">
                            {{Session::get('messages')}}
                       </div>
                	@endif
	<div class="login-card">
		<input type="text" placeholder="Employee Name" id="empName">
		<span id="errmsg"></span>
		<input type="button" value="REMOVE" id="removeEmployee">
	</div>
	<a class="logout-button" href="http://localhost:8000" >LOGOUT</a>
</body>
</html>