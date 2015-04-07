$(document).ready(function() {
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
                                });
                }
        });


        $("#productID").on('input',function() {
                if (letters.test($("#productID").val()))
                {
                        alert("productID should only be an integer");
                        $('#productID').val("");
                } 
        });

        $("#timePeriod").on('input',function() {
                if (letters.test($("#timePeriod").val()))
                {
                        alert("timePeriod should only be an integer");
                        $('#timePeriod').val("");
                } 
        });
});