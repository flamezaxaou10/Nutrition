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
<?php
  $id_mat = $_GET['id'];
  $id_input = $_GET['idinputmat'];
 ?>
<div class="container">
  <div class="jumbotron">
    <div class="modal-body">
       <div class="modal-body">
            <?php
              $sql = "SELECT * FROM input_material WHERE id_inputmat = '$id_input'";
              $result = mysql_query($sql,$connect1);
              $row = mysql_fetch_array($result);
             ?>
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $id_input; ?></h4>
                      <h4> รหัสการสั่งซื้อ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; <?php echo $row['id_mat']; ?> </h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<? echo $_SESSION["Username"];?></h4>
                      <h4> วันที่การรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row['date']; ?></h4>
          </form>
      </div>
      <table class="table table-striped table-bordered">
        <tr class="warning">
          <th><div align="center">ลำดับ</div></th>
          <th><div align="center">รหัสวัตถุดิบ</div></th>
          <th><div align="center">ชื่อวัตถุดิบ</div></th>
          <th><div align="center">จำนวนที่สั่งซื้อ</div></th>
          <th><div align="center">หน่วยนับ</div></th>
          <th><div align="center">จำนวนที่รับ</div></th>
          <th><div align="center">เพิ่ม</div></th>
        </tr>


      <?
          $sql = "SELECT * FROM detail_buymat LEFT JOIN feed ON feed.feed_id = detail_buymat.mat_id
                                              LEFT JOIN material ON material.mat_id = detail_buymat.mat_id
                                              JOIN unit ON unit.unit_id = detail_buymat.unit_id
                                              WHERE detail_buymat.id_mat = '$id_mat'";
          $objQuery = mysql_query($sql,$connect1);
          $i = 1;
          while ($objReSult = mysql_fetch_array($objQuery)) {

      ?>
        <tr class ="info">
          <td><div align = "center"><?php echo $i; ?></div></td>
          <?php if ($objReSult['feed_id'] != NULL): ?>
            <td><div align = "left"><? echo $objReSult["feed_id"];?></div></td>
            <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
          <?php else: ?>
            <td><div align = "left"><? echo $objReSult["mat_id"];?></div></td>
            <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
          <?php endif; ?>
          <td><div align = "left"><? echo $objReSult["count"];?></div></td>
          <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
          <form class="" action="update_detail_inputmat.php" method="GET">
          <td align="center">
            <input type="number" name="count" min="0" max="<?php echo $objReSult["count"];?>" required>
          </td>
          <?php if ($objReSult['feed_id'] != NULL): ?>
            <input type="hidden" name="mat_id" value="<?php echo $objReSult['feed_id']; ?>">
            <td align="center">
              <input type="submit" class="btn btn-success" value="เพิ่ม +">
            </td>

          <?php else: ?>
            <input type="hidden" name="mat_id" value="<?php echo $objReSult['mat_id']; ?>">
            <td align="center">
              <input type="submit" class="btn btn-success" value="เพิ่ม +">
            </td>
          <?php endif; ?>
            <input type="hidden" name="id" value="<?php echo $id_input; ?>">
            <input type="hidden" name="idbuy" value="<?php echo $id_mat; ?>">
        </tr>
        </form>
        <?
        $i++;
      }

      ?>
      <form class="" action="update_detail_inputmat.php" method="GET">
        <tr>
          <td colspan="7" class="text-right"><input type="submit" class="btn btn-success" name = "All" value="เพิ่มทั้งหมด"></td>
        </tr>
        <input type="hidden" name="id" value="<?php echo $id_input; ?>">
        <input type="hidden" name="idbuy" value="<?php echo $id_mat; ?>">
      </form>
      </table>
    </div>
  </div>

  <form action="" method="POST">
    <input type="hidden" name="stat" value="show">
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th><div align="center">ลำดับ</div></th>
      <th><div align="center">ประเภทวัตถุดิบ</div></th>
      <th><div align="center">ชื่อวัตถุดิบ</div></th>
      <th><div align="center">จำนวนที่รับ</div></th>
      <th><div align="center">หน่วยนับ</div></th>
      <th><div align="center">ลบ</div></th>
    </tr>


  <?
      $sql = "SELECT * FROM detail_inputmat LEFT JOIN feed ON feed.feed_id = detail_inputmat.mat_id
                                          LEFT JOIN material ON material.mat_id = detail_inputmat.mat_id
                                          JOIN unit ON unit.unit_id = detail_inputmat.unit_id
                                          JOIN input_material ON input_material.id_inputmat = detail_inputmat.id_inputmat
                                          JOIN stock ON detail_inputmat.id_stock = stock.id_stock
                                          WHERE detail_inputmat.id_inputmat = '$id_input' AND stat = '1'";
      $objQuery = mysql_query($sql,$connect1);
      $i = 1;
      while ($objReSult = mysql_fetch_array($objQuery)) {

  ?>
    <tr class ="info">
      <td><div align = "center"><?php echo $i; ?></div></td>
      <td><div align = "center"><? echo $objReSult["name_stock"];?></div></td>
      <?php if ($objReSult['feed_id'] != NULL): ?>
        <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
      <?php else: ?>
        <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
      <?php endif; ?>
      <td><div align = "left"><? echo $objReSult["count"];?></div></td>
      <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
      <?php if ($objReSult['feed_id'] != NULL): ?>
        <input type="hidden" name="mat_id<?php echo $i; ?>" value="<?php echo $objReSult['feed_id']; ?>">
        <td align="center">
          <a href='update_detail_inputmat.php?id=<?php echo $id_input; ?>&mat_id=<?php echo $objReSult['feed_id']; ?>&idbuy=<?php echo $id_mat; ?>&del=1'
          onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a>
        </td>
      <?php else: ?>
        <input type="hidden" name="mat_id<?php echo $i; ?>" value="<?php echo $objReSult['mat_id']; ?>">
        <td align="center">
          <a href='update_detail_inputmat.php?id=<?php echo $id_input; ?>&mat_id=<?php echo $objReSult['mat_id']; ?>&idbuy=<?php echo $id_mat; ?>&del=1'
          onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a>
        </td>
      <?php endif; ?>
    </tr>

    <input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $objReSult['count']; ?>">
    <input type="hidden" name="unit_id<?php echo $i; ?>" value="<?php echo $objReSult['unit_id']; ?>">
    <?
    $i++;
  }

  ?>
      <!-- <input type="hidden" name="idinputmat" value="<?php echo $id_input; ?>">
      <input type="hidden" name="id" value="<?php echo $id_mat; ?>"> -->
      <input type="hidden" name="id_inputmat" value="<?php echo $id_input; ?>">
    <tr>
      <td colspan="7" class="text-right"><input type="submit" class="btn btn-success" name = "บันทึกข้อมูลการรับเข้า" value="บันทึกข้อมูลการรับเข้า"></td>
    </tr>
  </table>
  </form>
</div>

  <?php
  if ($_POST) {

      $id_mat0 = $_POST['id_inputmat'];
      $sql = "SELECT * FROM detail_inputmat WHERE id_inputmat = '$id_mat0' AND stat = '1'";
      $query = mysql_query($sql,$connect1);
      $i = 1;
      //นำของเข้า stock
       while ($row = mysql_fetch_array($query)) {
          $count = $_POST["count$i"];
          $mat_id = $_POST["mat_id$i"];
          $unit = $_POST["unit_id$i"];

          $chk = "SELECT * FROM detail_inputmat WHERE mat_id = '$mat_id'";
          $chkstock = mysql_query($chk,$connect1);
          while($rowchk = mysql_fetch_array($chkstock)){
            $id_stock = $rowchk['id_stock'];
          }
          $instock = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$id_stock','$mat_id','$count','$unit')";
          mysql_query($instock,$connect1);
          $i++;
      }
    echo( "<script> alert('เพิ่มข้อมูลลงสต๊อกสำเร็จ');</script>");
    echo( "<script>window.location='mat_to_stock.php';</script>");
  }
   ?>

<?php include 'footer.php'; ?>
