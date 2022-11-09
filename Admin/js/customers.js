$(document).ready(function(){
    $("body").on('click','#editbtn',function(e){
        
        var CIDs = $(e.currentTarget).data('id');
        $.post("updatecustomer.php",{CID: CIDs},function(data,status){
            var res = JSON.parse(data);
            $("#CID_EDIT").val(res[0].CID);
            $("#C_FNAME_EDIT").val(res[0].C_FNAME);
            $("#C_LNAME_EDIT").val(res[0].C_LNAME);
          
        });

        $("#CustomerEditModal").modal("show");

    });

    $("body").on('click','#deletebtn',function(e){
        
        var CID_Delit = $(e.currentTarget).data('id');
        $("#CID_Delit").val(CID_Delit);
        $("#CustomerDeleteModal").modal("show");

    });

})