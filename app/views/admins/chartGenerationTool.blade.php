<!DOCTYPE html>
<html>
  <head>
            <meta charset="UTF-8">
            <title>REPORT GENERATION</title>
            {{ HTML::script('js/jquery.js') }}
            {{ HTML::script('js/addEmployee.js')}}
            {{HTML::style('css/base.css')}}
    </head>
    <body>
     		@if(Session::has('messages'))
                           <div class="messages">
                                {{Session::get('messages')}}
                           </div>
                @endif
    	  {{Form::open(array('url' => 'generate', 'class' => 'login-card','method' => 'PUT', 'name' => 'generateCharte')) }}

                {{ Form::text('productID',Input::old('productID'),array('placeholder'=>'productID')) }}
                {{ Form::text('timePeriod',Input::old('timePeriod'),array('placeholder' => 'timePeriod')) }}

                {{Form::submit('SUBMIT',array('class' => 'login login-submit'))}}
            {{Form::close()}}
    	<a class="logout-button" href="http://localhost:8000"> LOGOUT </a>
    </body>
</html>



<!--
<div class="login-card">
                     <input type="text" id="productID" placeholder="productID">
                     <input type="text" id ='timePeriod' placeholder='timePeriod'>
                     <span id="errmsg"></span>
                     <input type="submit" value="GENERATE" id="generateChart" class='login login-submit'>
             </div>
!>