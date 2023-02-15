$('document').ready(function() {
    $('.delete').on('click', function(){
        var div = $(this).closest('.project');
        var id = $(this).data('id');
        var action = "delete";
        $.ajax({
            url:"crud.php",
            method: "POST",
            data:{
                id:id,
                action: action
            },
            dataType: "text",
            success: function(data){
                div.remove();
            }
        });
    });
});