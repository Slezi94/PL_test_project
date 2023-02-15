$('document').ready(function() {
    $('#update').on('click', function(){
        var id = $('#project-id').val();
        var title = $("#title").val();
        var description = $("#description").val();
        var status = $("#status-update").val();
        var owner = $("#owner").val();
        var email = $("#email").val();
        var action = "update";

        $.ajax({
            url:"crud.php",
            method: "POST",
            data:{
                id:id,
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
                if(data.length == 0){
                    $("#success-alert").css("display", "block");
                    $("#success-message").html("Projekt sikeresen frissítve!");
                }else{
                    $("#error-alert").css("display", "block");
                    $("#error-message").html(data);
                }
            }
        });
    });
});