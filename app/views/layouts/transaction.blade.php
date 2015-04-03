<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('js/transactionValidations.js') }}
    {{HTML::style('css/transaction.css')}}
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
    <div class="master-card" id="master">
        <div class="input-card" id="transctionDIV">
           @section('mandatory-transaction')
           @show
        </div>
        </div>

        @section('other-transactions')
        @show
</body>