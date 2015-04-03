<!DOCTYPE html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ADMIN CONSOLE</title>
            {{HTML::style('css/adminsConsole.css')}}
    </head>

    <body>
        <div class="master-card">
            <div class="control-card newEmployee" id="newEmployee">
            <a href="http://localhost:8000/add"><h1>ADD EMPLOYEE</h1></a>
            </div>

            <div class="control-card removeEmployee" id="removeEmployee">
            <a href="http://localhost:8000/remove"><h1>REMOVE EMPLOYEE</h1></a>
            </div>

            <div class="control-card restockProduct" id="restockProduct">
            <a href="http://localhost:8000/reorder"><h1>ORDER STOCK</h1></a>
            </div>
            
             <div class="control-card depRevokeProduct" id="depRevokeProduct">
            <a href="http://localhost:8000/dep"><h1><pre>DEPRECATE<br> OR REVOKE<br>PRODUCT</pre></h1></a>
            </div>

        </div>
        <a class="logout-button" href="http://localhost:8000">LOGOUT</a>
    </body>
</html>