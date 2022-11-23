<?php
    include_once("../Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HPMS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<style>
  @media print{
    .hidden-print,
    .hidden-print * {
      display: none !important;
    }
  }
  </style>
</head>
<body>

		<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="row">
			
		</div><!--/.row-->
 <?php   

$PARKING_SLOT_ID= $_GET['ID'];
$query = "SELECT * FROM `parking_logs` LEFT JOIN parking_slot ON parking_slot.PS_ID = parking_logs.PARKING_SLOT_ID WHERE PS_ID='$PARKING_SLOT_ID'";
$result = $crudapi->getData($query);
$number = 1;
foreach ($result as $key => $data) {
?>
<tr>
  <td><?php echo $data["C_FNAME"]." ".$data["C_LNAME"] ?></td><br>
  <td><?php echo $data["PLATE_NUMBER"] ?></td><br>
  <td><?php echo date_format(date_create($data["PARKING_TIME"]),"M-d-y H:i:s A"); ?></td><br>
  <td><?php echo date_format(date_create($data["PARKING_TIME_OUT"]),"M-d-y H:i:s A") ?></td><br>
  <td><?php echo $data["PAYMENT"] ?></td>
  <br>

 <!-- <button onclick="windowPrint();">Print</button>-->

  <button onclick="printReceipt();" id="btnPrint" class="hidden-print">Print</button>

</td>
</tr>

      <?php } ?>
    
<script>
 
  
  const RECEIPT = {
    width: 28,
  };
  
  const printReceipt = (text) => {
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
  };
  
  const centerAlign = (text) => {
    if (text.length > RECEIPT.width) return text.substring(0, RECEIPT.width - 1);
  
    let space = Math.floor((RECEIPT.width - text.length) / 2);
  
    return " ".repeat(space) + text;
  };
  
  const rightAlign = (text) => {
    if (text.length > RECEIPT.width) return text.substring(0, RECEIPT.width - 1);
  
    return text.padStart(RECEIPT.width);
  };
  
  const printLine = () => "-".repeat(RECEIPT.width);
  const nextLine = () => "\n";
  const printTransaction = (transaction) => {
    let header = [
      `HOTEL PARKING `,
      `MANAGEMENT SYSTEM`,
      `GEN. TINIO, N.E.`,
    ]
      .map((text) => centerAlign(text))
      .join("\n");
  
    let footer = [`THANK YOU! COME AGAIN!`, `WE'RE HAPPY TO SERVE U!`]
      .map((text) => centerAlign(text))
      .join("\n");
  
    let content = [
      header,
      printLine(),
      `QTY ITEM NAME         SUBTOTAL`,
      printLine(),
      printItems(transaction),
      printLine(),
      printBreakdown(transaction),
      printLine(),
      footer,
    ].join("   \n");
    content = [
      `<p style="text-align: center;">
        <img style="height: 50px;" src="http://localhost/pos/heart.jpg" />
      </p>`,
      content,
    ].join("\n");
    printReceipt(content);
  };

  const $btnPrint = document.querySelector("#btnPrint");
  $btnPrint.addEventlistener("click",()=>{

  });
  
    </script>
 
	
		
</body>
</html>

