function removeRecord(callingElement) //To remove record from the transacion list
    {
        $(callingElement).parent().remove();
    }

$(document).ready(function(){
    $("#insertRecord").click(function() {
        $("#master").append("<div class=\"input-card\" id=\"transctionDIV\">" +
        "<pre>" +
            "<input type=\"text\" placeholder=\"productID\" id= \"prod\"class=\"prod-text-card\">   <"+ "input type=\"text\" placeholder=\"quantity\" name = \"qty1\"class=\"qty-text-card\"> <" + "input type=\"button\"  name=\"del \" value =\"DELETE\" class=\"button-card\" onclick=\"removeRecord(this)\">" + 
        "</pre>" +
    "</div>"
    );
 });

$("#submitData").click(function () {
        var prodArray = [];
        var qtyArray = [];

        $(".prod-text-card").each(function() {
            prodArray.push(this.value);
        });

        $(".qty-text-card").each(function() {
            qtyArray.push(this.value);
        });

        $.ajax({
            type: "PUT",
            url: "http://localhost:8000/users",
            data: {"products":prodArray, "quantity":qtyArray},
             success: success,
            content_type: "application/json; charset=UTF-8"
       });       
});


function success(data)
{
    $("#editPage").html(data); 
}
    });