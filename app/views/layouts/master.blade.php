<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{HTML::style('css/base.css')}}
    <title>
    	@section('title')
    	@show
    </title>
</head>
<body>
     <div class="errors">
     @section('errors')
     @show
     </div>
    <div class="login-card">
            <h1> @section('body-title') @show</h1>
    <div class="data">
    	@section('body-content')
        	 @show
    </div>
    </div>
</body>
</html>