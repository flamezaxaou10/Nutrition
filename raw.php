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
    $num = 0;
      $sql = "SELECT COUNT(id_raw) FROM raw_system";
      $objQuery = mysql_query($sql,$connect1);
      $row = mysql_fetch_array($objQuery);
      $num = sprintf("%02d",$row['COUNT(id_raw)'] + 1);
      $id_raw = "DMT-$num";
      date_default_timezone_set("Asia/Bangkok") ;
      $datethis = date("Y-m-d");
     ?>
     <form action="insert_raw.php" method="get">
      <div class="modal-body">
        <h4>
        <table>
          <tr >
            <td style="padding-bottom : 10px;">รหัสจัดการวัตถุดิบ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="text" name="id_raw" value="<?php echo $id_raw; ?>" readonly></td>
          </tr>
          <tr>
            <td style="padding-bottom : 10px;">เลือกเมนูอาหาร </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;">
              <select  name="raw">
                <?php
                  $sql = "SELECT * FROM menu";
                  $result = mysql_query($sql,$connect1);
                  while ($row = mysql_fetch_array($result)) { ?>
                    <option value="<?php echo $row['menu_name']; ?>"><?php echo $row['menu_name']; ?></option>
                <?php
                  }
                ?>

              </select>
            </td>
          </tr>
          <tr>
            <td style="padding-bottom : 10px;">วันที่ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="date" name="date" value="<?php echo $datethis; ?>" readonly></td>
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
  <!----------------------------------------------------------------------------------->
  <div class="detail">
    <?php
        $sql = "SELECT * FROM raw_system ORDER BY id_raw DESC";
        $result = mysql_query($sql,$connect1);
     ?>
    <form class="" action="#" method="get">
      <div class="text-right">
        <b style="color : white;">ค้นหาเมนูอาหาร : <input type="search" name="search" value=""></b> <input type="submit" class="btn btn-success" value="ค้นหา" name = "submit"><br><br>
      </div>
      <table  class="table table-striped table-bordered">
        <tr class="warning">
          <th>ลำดับ</th>
          <th>วันที่ทำรายการ</th>
          <th>รหัสจัดการวัตถุดิบ</th>
          <th>ชื่อเมนูอาหาร</th>
          <th>รายละเอียด</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
        </tr>
        <?php
          $i=0;
            while ($row = mysql_fetch_array($result)){
              $i++;
        ?>
        <tr class="info">
          <td style="width:10%;"><?php echo $i; ?></td>
          <td style="width:10%;"><?php echo $row['date']; ?></td>
          <td style="width:15%;"><?php echo $row['id_raw']; ?></td>
          <td style="width:35%;"><?php echo $row['name_raw']; ?></td>
          <td style="width:10%;"></td>
          <td style="width:10%;"></td>
          <td style="width:10%;"></td>
        </tr>
        <?php
            }
         ?>

      </table>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
