$(document).ready(function(){
    $("body").on('click','#editbtn',function(e){
        
        var USER_IDs = $(e.currentTarget).data('id');
        $.post("updateuser.php",{USER_ID: USER_IDs},function(data,status){
            var emp = JSON.parse(data);
            $("#USER_ID_EDIT").val(emp[0].USER_ID);
            $("#FNAME_EDIT").val(emp[0].FNAME);
            $("#LNAME_EDIT").val(emp[0].LNAME);
            $("#ADDRESS_EDIT").val(emp[0].ADDRESS);
            $("#CONTACT_EDIT").val(emp[0].CONTACT);
            $("#USERNAME_EDIT").val(emp[0].USERNAME);
            $("#PASSWORD_EDIT").val(emp[0].PASSWORD);
        });

        $("#usersEditModal").modal("show");

    });

    $("body").on('click','#deletebtn',function(e){
        
        var USER_ID_DELETE = $(e.currentTarget).data('id');
        $("#USER_ID_DELETE").val(USER_ID_DELETE);
        $("#usersDeleteModal").modal("show");

    });

})