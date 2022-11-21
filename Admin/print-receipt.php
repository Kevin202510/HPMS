
<?php
   include_once("../Classes/CRUDAPI.php");
   $crudapi = new CRUDAPI();
   ?>
   
   <!DOCTYPE html>
   <html>
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>VPS</title>
       <link href="css/bootstrap.min.css" rel="stylesheet">
       <link href="css/font-awesome.min.css" rel="stylesheet">
       <link href="css/datatable.css" rel="stylesheet">
       <link href="css/datepicker3.css" rel="stylesheet">
       <link href="css/styles.css" rel="stylesheet">
       
       <!--Custom Font-->
       <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   
   </head>
   <body>
   
           <div class="col-lg-2"></div>
       <div class="col-lg-8">
           <div class="row">
               
           </div><!--/.row-->
           <?php
           $id=$_GET['ID'];
           $query = "SELECT * FROM `parking_logs` LEFT JOIN parking_slot ON parking_slot.PS_ID = parking_logs.PARKING_SLOT_ID";
           $result = $crudapi->getData($query);
           foreach ($result as $key => $data){?>
                   
                   <div  id="exampl">
         <table id="dom-jqry" class="table table-striped table-bordered">
           <tr>
             <th colspan="4" style="text-align: center; font-size:22px;"> Hotel Parking System Receipt</th>
           </tr>
   
           <tr>
   
           <th>Full name</th>
                 <td><?php  echo $data["C_FNAME"]." ".$data["C_LNAME"]?></td>
                          
   
             <th>Plate Number</th>
                 <td><?php  echo $data["PLATE_NUMBER"]?></td>
                 </tr>
   
                 <tr>
             <th>Time Entry</th>
                 <td><?php  echo $data["PARKING_TIME"]?></td>
           
             <th>Time Exit</th>
                 <td><?php  echo $data["PARKING_TIME_OUT"]?></td>
                 </tr>
   
                 <tr>
                 <th>Payment</th>
                   <td><?php  echo $data["PAYMENT"]?></td>
               
           </tr>
        
            
   
         <?php } ?>
           <tr>
             <td colspan="4" style="text-align:center; cursor:pointer"><i class="fa fa-print fa-4x" aria-hidden="true" OnClick="CallPrint(this.value)"  ></i></td>
           </tr>
       </table>
       
     </div>
   
     <script>
     function CallPrint(strid) {
       var prtContent = document.getElementById("exampl");
       var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
       WinPrint.document.write(prtContent.innerHTML);
       WinPrint.document.close();
       WinPrint.focus();
       WinPrint.print();
       WinPrint.close();
     }
   </script> 
           
   
           
       </div>	<!--/.main-->
       <div class="col-lg-2"></div>
       
       <script src="js/jquery-1.11.1.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
       <script src="js/chart.min.js"></script>
       <script src="js/chart-data.js"></script>
       <script src="js/easypiechart.js"></script>
       <script src="js/easypiechart-data.js"></script>
       <script src="js/jquery.dataTables.min.js"></script>
       <script src="js/dataTables.bootstrap4.min.js"></script>
       <script src="js/bootstrap-datepicker.js"></script>
       <script src="js/custom.js"></script>
       <script>
           window.onload = function () {
           var chart1 = document.getElementById("line-chart").getContext("2d");
           window.myLine = new Chart(chart1).Line(lineChartData, {
           responsive: true,
           scaleLineColor: "rgba(0,0,0,.2)",
           scaleGridLineColor: "rgba(0,0,0,.05)",
           scaleFontColor: "#c5c7cc"
           });
   };
       </script>
   
       <script>
           $(document).ready(function() {
       $('#example').DataTable();
   } );
       </script>
           
   </body>
   </html>
   
   