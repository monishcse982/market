<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        {{ HTML::script('js/jquery.js') }}
        {{ HTML::script('js/addEmployee.js') }}
        {{HTML::style('css/base.css')}}
            <title>ADD NEW USER</title>
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
                     <input type="submit" value="ADD" id="addEmployee" class='login login-submit'>
             </div>
             <a class="logout-button" href="http://localhost:8000">LOGOUT</a>
        </body>
</html>