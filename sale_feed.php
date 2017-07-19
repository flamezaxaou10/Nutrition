<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];
include 'header.php';
?>
<div class="container">
  <div class="jumbotron">
      <p>การขายอาหารทางสายยาง</p>
      <?php
          $sql = "SELECT COUNT(salefeed_id) FROM sale_feed";
          $result = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($result);
          $num = sprintf("%04d",$row['COUNT(salefeed_id)'] + 1);
          $salefeed_id = "BF-$num";
          date_default_timezone_set("Asia/Bangkok") ;
          $datethis = date("Y-m-d");
       ?>
    <div class="modal-body">
      <h4>
        <style media="screen">
          td{
            padding-bottom : 20px;
          }
        </style>
         <table>
           <tr >
             <td>รหัสการขายอาหารทางสายยาง </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $salefeed_id; ?></td>
           </tr>
           <tr>
             <td>รหัสพนักงาน </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $username ;?></td>
           </tr>
           <tr>
             <td>วันที่ขาย </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $datethis; ?></td>
           </tr>
         </table>
    </h4>
    </div>
    <div class="modal-footer" style="padding-bottom : 0px;">
      <form class="" action="#" method="post">
        <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()">
        <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
      </form>
    </div>
  </div>
  <br>
  <div class="text-right">
    <input type="search" name="search" value=""> <input  class="btn btn-success" type="submit" name="" value="ค้นหา">
  </div>
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th>ลำดับ</th>
      <th>วันทีขาย</th>
      <th>รหัสการขายอาหารสายยาง</th>
      <th>เจ้าหน้าที่</th>
      <th><div align = "center">ดูข้อมูล</div></th>
      <th><div align = "center">พิมพ์ใบเสร็จรับเงิน</div></th>
    </tr>
  <?php
    $idedit = $id_output;
    $table = "SELECT * FROM sale_feed ORDER BY sale_feed.salefeed_id DESC";
    $result = mysql_query($table,$connect1);
    $i = 0;
    while ($row = mysql_fetch_array($result)){
      $id = $row['id_outputmat'];
      $i++;
    ?>
    <tr class ="info">
      <td><?php echo $i; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td><?php echo $row['salefeed_id']; ?></td>
      <td><?php echo $row['username']; ?></td>
      <td><div align = "center"><a href="select_sale_feed.php?id=<?php echo $id; ?>" ><img src='img/sssss.png' width=25></a></div></td>
      <td><div align = "center"><a target="_blank"  href="print_sale_feed.php?id=<? echo $row['salefeed_id'];?>"><img src='img/print.png' width=25></a></div></td>
    </tr>
    <?php
    }
    ?>
  </table>
</div>
<?php include 'footer.php'; ?>
<?php
  if ($_POST) {
    $sql = "INSERT INTO sale_feed VALUES('$salefeed_id','$username','$datethis')";
    mysql_query($sql,$connect1);
    header("LOCATION:sale_feed_con.php?salefeed_id=$salefeed_id");
  }
 ?>
