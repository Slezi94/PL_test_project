$(document).ready(function(){
    $('#filter').change(function(){
        $status = $("#filter").val();
        window.location = "index.php?status=" + $status;
    });


});