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
    <br>
    <p>ระบบจัดการวัตถุดิบที่ใช้ในการทำอาหาร</p>
    <?php
      date_default_timezone_set("Asia/Bangkok") ;
      $datethis = date("Y-m-d");
     ?>
     <form class="" action="raw_detail.php" method="post">
      <div class="modal-body">
        <h4>
        <table>
          <tr >
            <td style="padding-bottom : 10px;">รหัสจัดการวัตถุดิบ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="text" name="id_raw" value=""></td>
          </tr>
          <tr>
            <td style="padding-bottom : 10px;">ชื่อเมนูอาหาร </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="text" name="name_raw" value=""></td>
          </tr>
          <tr>
            <td style="padding-bottom : 10px;">วันที่ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="date" name="date" value="<?php echo $datethis; ?>"></td>
          </tr>
        </table>
        </h4>

      </div>
      <div class="modal-footer">
       <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="return confirm('ต้องการเพิ่มข้อมูลนี้?')"> &nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" >ย้อนกลับ</button></a>
     </div>
   </form>
  </div>
  <table  class="table table-striped table-bordered">
    <tr class="warning">
      <th>ลำดับ</th>
      <th>ชื่อเมนูอาหาร</th>
      <th>รายละเอียด</th>
      <th>แก้ไข</th>
      <th>ลบ</th>
    </tr>

    <tr class="info">
      <td></td>
    </tr>
  </table>
</div>

<?php include 'footer.php'; ?>
