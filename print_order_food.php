<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
?>
<?php
  $hn = $_GET['hn'];
  $date = $_GET['date'];
  $eats = $_GET['eats'];
  $sql = "SELECT * FROM order_food WHERE hn = '$hn' AND date_order = '$date' AND eats = '$eats'";
  $res = mysql_query($sql,$connect1);
  $row = mysql_fetch_array($res);
  $strDate=date('d-m-Y', strtotime($date));
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    $dates=$strDay." ".$strMonthThai." ".$strYear;
  switch ($eats) {
    case '4':
      $eat = "มื้อเช้า / $dates";
      break;
    case '5':
      $eat = "มื้อกลางวัน / $dates";
      break;
    case '6':
      $eat = "มื้อเย็น / $dates";
      break;
  }
 ?>
 <br><br><br>
 <br>
 <style media="screen,print" >
   td{
     padding: 5px;
   }
   .card{
     border: 2px black solid;
     padding: 20px;
     width: 80%;
     margin: auto;
   }
   .text-right{
     float: right;
   }
 </style>
 <body>
   <div class="col-md-6 card">
     <div class="text-left">
         <span >อาหารเฉพาะโรค</span>
         <span style="float:right;"><?php echo $eat; ?></span>
     </div>
     <center>
     <table width="80%">
       <tr>
         <td><b>ตึก</b> <?php echo $row['dep_name']; ?></td>
         <td><b>ห้อง</b> <?php echo $row['roomno']; ?></td>
       </tr>
       <tr>
         <td></td>
         <td><b>เตียง</b> <?php echo $row['bedno']; ?></td>
       </tr>
       <tr>
         <td><b>ชื่อ</b> <?php echo $row['fname']; ?></td>
         <td><b>นามสกุล</b> <?php echo $row['lname']; ?></td>
       </tr>
       <tr>
         <td colspan="2"><b>ชนิดของอาหาร</b> <?php echo $row['type_food']; ?></td>
       </tr>
     </table>
   </center>
   </div>
 </body>
 <script type="text/javascript">
   window.print();
 </script>
