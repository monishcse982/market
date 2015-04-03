<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <title>ADD NEW USER</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script type="text/javascript">  
                    $(document).ready(function(){
                        var letters = /[A-Za-z]/g;
                        $("#addEmployee").click(function() {
                            if (!(letters.test($("#username").val())))
                            {
                                $("#errmsg").html("Username must contain only english letters").show().fadeOut("slow");
                            }
                            else if($("#username").val().length<6 || $("#password").val().length<6) 
                            {
                                $("#errmsg").html("Username and Password must be atleast 6 characters").show().fadeOut("slow");    
                            }
                           else if(!($("#password").val() == $("#passwordConfirm").val()))
                           {
                                $("#errmsg").html("Passwords Don't match").show().fadeOut("slow");
                           }
                           else
                           {
                               $.ajax({
                                        type: "PUT",
                                        url: "http://localhost:8000/addUser",
                                        data: {"username":$("#username").val(), "password":$("#password").val()},
                                        content_type: "application/json; charset=UTF-8"
                                   }); 
                               location.reload();
                            }
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

                    #errmsg
                    {
                    color: red;
                    }
                    .login-card {
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

                    .login-card:hover{
                        border: 5px solid #6AFB92;
                    }

                    .login-card h1 {
                        font-weight: 500;
                        text-align: center;
                        font-size: 40px;
                        color: #6AFB92;
                    }

                    .login-card input[type=submit] {
                        width: 100%;
                        display: compact;
                        margin-bottom: 10px;
                        position: relative;
                        border-radius: 15px;
                    }

                    .login-card input[type=text], input[type=password] {
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

                    .login-card input[type=text]:hover, input[type=password]:hover {
                        border: 2px solid #6AFB92;
                    }

                    .login {
                        text-align: center;
                        font-size: 14px;
                        font-family: 'Lato', 'Lato', sans-serif;
                        font-weight: 700;
                        height: 36px;
                        padding: 0 8px;
                    }

                    .login-submit {
                        border: 0;
                        color: #fff;
                        text-shadow: 0 1px rgba(0,0,0,0.1);
                        background-color: grey;
                    }

                    .login-submit:hover {
                        border: 0;
                        text-shadow: 0 1px rgba(0,0,0,0.3);
                        background-color: darkred;
                    }

                    .login-card a {
                        text-decoration: none;
                        color: #666;
                        font-weight: 400;
                        text-align: center;
                        display: inline-block;
                        opacity: 0.6;
                        transition: opacity ease 0.5s;
                    }

                    .login-card a:hover {
                        opacity: 1;
                    }
                     .messages{
                            background: slategrey;
                            color: #fff;
                            top:5px;
                            right:5px;
                            padding: 8px;
                            padding-bottom: 2px;
                            border-radius:85px;
                            border: 0px;
                            text-align: center;
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
            </style>
    </head>
    <body>
                @if(Session::has('messages'))
                       <div class="messages">
                            {{Session::get('messages')}}
                       </div>
                @endif
             <div class="login-card">
                     <input type="text" id="username" placeholder="Username">
                     <input type="password" id ='password' placeholder='password'>
                     <input type="password" id ='passwordConfirm' placeholder='password'>
                     <span id="errmsg"></span>
                     <input type="submit" value="ADD" id="addEmployee" class =  'login login-submit'>
             </div>
             <a class="logout-button" href="http://localhost:8000">LOGOUT</a>
        </body>
</html>