<!DOCTYPE html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ADMIN CONSOLE</title>
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

                    .master-card{
                       margin-top: 20px;
                    }
                    .control-card {
                        height: 205px;
                        width: 250px;
                        border: 7px solid;
                        border-radius: 100px;
                        margin: 2em;
                        opacity: 0.5;
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
                    .control-card:hover {
                        border-width: 9px;
                        opacity: 1.0;
                    }

                    .control-card h1 {
                        font-weight: 500;
                        text-align: center;
                        color: black;
                        font-size: 40px;
                        opacity: 1.0;
                    }

                    .newEmployee {
                        border-color: #6AFB92;
                        background-color: #E5E4E2;
                        -webkit-transform: translate3d(518px, -20px,0px);
                    }

                    .removeEmployee {
                        border-color: #FFDB58;
                        background-color: #E5E4E2;
                        left: 32px;
                        top: 269px;
                        -webkit-transform: translate3d(250px, -90px, 0px);
                    }

                    .restockProduct {
                        border-color: #F75E59;
                        background-color: #E5E4E2;
                        -webkit-transform: translate3d(789px, -320px, 0px);
                    }

                    .depRevokeProduct {
                        border-color: #9E7BFF;
                        background-color: #E5E4E2;
                        -webkit-transform: translate3d(518px, -360px, 0px);
                    }

                    .updateProduct {
                        border-color:  #F87217;
                        background-color:  #E5E4E2;
                        -webkit-transform: translate3d(687px, -580px, 0px);
                    }
                    .messages{
                        background: pink;
                        color: #fff;
                        padding: 20px;
                        margin-bottom: 20px;
                        border-radius:95px;
                        text-align: center;
                    }
            </style>
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