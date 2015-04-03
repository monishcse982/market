<!DOCTYPE html>
<html>
  <head>
            <meta charset="UTF-8">
            <title>REMOVE EMPLOYEE</title>
            {{ HTML::script('js/jquery.js') }}
            {{ HTML::script('js/addEmployee.js') }}
            {{HTML::style('css/base.css')}}
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
    	<a class="logout-button" href="http://localhost:8000"> LOGOUT </a>
    </body>
</html>