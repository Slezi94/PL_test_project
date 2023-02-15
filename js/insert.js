$("document").ready(function(){
    $("#save").on("click", function(){

        var title = $("#title").val();
        var description = $("#description").val();
        var status = $("#status-insert").val();
        var owner = $("#owner").val();
        var email = $("#email").val();
        var action = "insert";
    
        $.ajax({
            url:"crud.php",
            method: "POST",
            data:{
                title: title,
                description: description,
                status: status,
                owner: owner,
                email: email,
                action: action
            },
            dataType: "json",
            success: function(data){
                $("#createform")[0].reset();
                console.log(data);
                if(data.length == 0){
                    $("#success-alert").css("display", "block");
                    $("#success-message").html("Projekt sikeresen felvéve!");
                }else{
                    $("#error-alert").css("display", "block");
                    $("#error-message").html(data);
                }
            }
        });
    });
});