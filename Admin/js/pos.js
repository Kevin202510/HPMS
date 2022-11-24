$(document).ready(function(){
    
    $( "#parkHere" ).prop( "disabled", true );

    $("body").on('click','#park',function(e){
        
        var PS_IDs = $(e.currentTarget).data('id');
        $.post("updateparkingslot.php",{PS_ID: PS_IDs},function(data,status){
            var res = JSON.parse(data);
            $("#PARKING_SLOT_ID").val(res[0].PS_ID);
            $("#PARKING_NAME").val(res[0].PARKING_NAME);
        });

        $("#parking_logsModal").modal("show");

    });

    $('#PLATE_NUMBER_SEARCH').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            getPLData();
        }
      });

    $("body").on('click','#parkout',function(e){    
        getPLData();
    });

    function getPLData(){
        let PLATE_NUMBER_SEARCHs = $("#PLATE_NUMBER_SEARCH").val();
        let statecount;
        $.post("updatepos.php",{PLATE_NUMBER: PLATE_NUMBER_SEARCHs},function(data,status){
            var res = JSON.parse(data);
            statecount = res.length;
            if(statecount>=1){
                $("#PARKING_LOGS_ID_PARKOUT").val(res[0].PL_ID)
                $("#PARKING_SLOT_ID_PARKOUT").val(res[0].PS_ID);
                $("#PARKING_NAME_PARKOUT").val(res[0].PARKING_NAME);
                $("#PLATE_NUMBER_PARKOUT").val(res[0].PLATE_NUMBER);
                $("#C_FNAME_PARKOUT").val(res[0].C_FNAME);
                $("#C_LNAME_PARKOUT").val(res[0].C_LNAME);
                var date1 = new Date(res[0].PARKING_TIME);
                $("#PARKING_TIME_PARKOUT").val(date1.toLocaleString());
                var date = new Date();
                $("#PARKING_TIME_OUT_PARKOUT").val(date.toLocaleString());

                var res = Math.abs(date1 - date) / 1000;
                var hours = Math.floor(res / 3600) % 24;  
                
                if(hours==0){
                    $("#TOTAL_HR_PARKOUT").val("0");
                    $("#BALANCE_PARKOUT").val(30);
                }else{
                    $("#TOTAL_HR_PARKOUT").val(hours);
                    $("#BALANCE_PARKOUT").val(hours*30);
                }

                $("#parkoutModal").modal("show");
            }else{
                alert("NO AVAILABLE DATA");
            }

        });
    }

    $("#PAYMENT_PARKOUT").change(function(){
        if(parseInt($("#PAYMENT_PARKOUT").val())>=parseInt($("#BALANCE_PARKOUT").val())){
            $( "#parkHere" ).prop( "disabled", false );
        }else{
            alert("kulang bayad mo");
        }
    });

    $("#savemona").click(function(){

        var date = new Date();

        var platenumber = $("#PLATE_NUMBER").val();
        var fullname = $("#C_FNAME").val()+" "+$("#C_LNAME").val();
        var dateandtime = date.toLocaleString();
        var prkingslot = $("#PARKING_NAME").val();

        var text = "HOTEL PARKING MANAGEMENT SYSTEM"+"\n\n"+"Vehicle Plate Number:"+platenumber+"\n\n"+"Vehicle Owner:"+fullname+"\n\n"+"Date & Time:"+dateandtime+"\n\n"+"Parking Slot Number:"+prkingslot;

        $.ajax({
            type: "POST",
            url: "posadd.php",
            data: $("#formkoto").serializeArray(),
            success: function(datas){
                printText(text);
                location.reload();
            },
          });

    });

    function printText(text) {
        fetch("http://localhost:3000/api", {
          // Adding method type
          method: "POST",
    
          // Adding body or contents to send
          body: JSON.stringify({
            content: text,
          }),
    
          // Adding headers to the request
          headers: {
            "Content-type": "application/json; charset=UTF-8",
          },
        });
      }
    

})