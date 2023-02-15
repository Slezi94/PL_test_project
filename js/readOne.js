$('document').ready(function() {
    $('.edit').on('click', function(){
        var id = $(".project-id").val();
        var action = "readOne";

        $.ajax({
            url:"./crud.php",
            method: "GET",
            data:{
                id:id,
                action: action
            },
            dataType: "json",
            success: function(data){
                
                console.log(data);
                /* if(data == ""){
                    $("#success-alert").css("display", "block");
                    $("#success-message").html("Projekt sikeresen felvéve!");
                } */
                /* $("#error-alert").css("display", "block");
                $("#error-message").html(data); */
                
            }
        });
    });
});