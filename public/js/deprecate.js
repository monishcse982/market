
$(document).ready(function(){
    var letters = /[0-9]/;
    $("#deprecate").click(function() {
        if (!(letters.test($("#productID").val())))
        {
            $("#errmsg").html("productID must be integer only").show().fadeOut("slow");
        }
        else 
        {
            $.ajax({
                type: "PUT",
                url: "http://localhost:8000/deprecate",
                data: {"username":$("#productID").val()},
                content_type: "application/json; charset=UTF-8"
            });
            location.reload();
        } 
    });

    $("#revoke").click(function() {
        if (!(letters.test($("#productID").val())))
        {
            $("#errmsg").html("productID must be integer only").show().fadeOut("slow");
        }
        else {
        $.ajax({
            type: "PUT",
            url: "http://localhost:8000/revoke",
            data: {"username":$("#productID").val()},
            content_type: "application/json; charset=UTF-8"
        });
        } 
    });
});