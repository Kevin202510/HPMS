$(document).ready(function(){
    $("body").on('click','#editbtn',function(e){
        
        var PS_IDs = $(e.currentTarget).data('id');
        $.post("updateparkingslot.php",{PS_ID: PS_IDs},function(data,status){
            var res = JSON.parse(data);
            $("#PS_ID_EDIT").val(res[0].PS_ID);
            $("#PARKING_NAME_EDIT").val(res[0].PARKING_NAME);
            $("#DESCRIPTION_EDIT").val(res[0].DESCRIPTION);
        });

        $("#parkingslotEditModal").modal("show");

    });

    $("body").on('click','#deletebtn',function(e){
        
        var PS_ID_DELETE = $(e.currentTarget).data('id');
        $("#PS_ID_DELETE").val(PS_ID_DELETE);
        $("#parkingslotDeleteModal").modal("show");

    });

})