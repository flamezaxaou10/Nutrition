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
    <br>
   <p>ข้อมูลรายละเอียดการรับวัตถุดิบเข้าคลัง</p>
   
    <div class="modal-body">
       <div class="modal-body">
            <?php
              $sql = "SELECT * FROM input_material WHERE id_inputmat = '$id_input'";
              $result = mysql_query($sql,$connect1);
              $row = mysql_fetch_array($result);
              $strDate=$row['date'];
                $strYear = date("Y",strtotime($strDate))+543;
                $strMonth= date("n",strtotime($strDate));
                $strDay= date("j",strtotime($strDate));
                $strDays= date("l",strtotime($strDate));
                $strDayCut = Array("Monday"=>"วันจันทรที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกรที่","Saturday"=>"วันเสารที่","Sunday"=>"วันอาทิตย์ที่");
                $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                $strMonthThai=$strMonthCut[$strMonth];
                $strDaysThai = $strDayCut[$strDays];
                $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
              ?>
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $id_input; ?></h4>
                      <h4> รหัสการสั่งซื้อ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; <?php echo $row['id_mat']; ?> </h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<? echo $_SESSION["fnname"];?></h4>
                      <h4> วันที่การรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $date; ?></h4>
          </form>
      </div>
      <table class="table table-striped table-bordered">
        <tr class="warning">
          <th><div align="center">ลำดับ</div></th>
          <th><div align="center">รหัสวัตถุดิบ</div></th>
          <th><div align="center">ชื่อวัตถุดิบ</div></th>
          <th><div align="center">จำนวนที่สั่งซื้อ</div></th>
          <th><div align="center">จำนวนคงเหลือ</div></th>
          <th><div align="center">หน่วยนับ</div></th>
          <th><div align="center">จำนวนที่รับ</div></th>
          <th><div align="center">เพิ่ม</div></th>
        </tr>


      <?
          $sql = "SELECT * FROM detail_buymat LEFT JOIN feed ON feed.feed_id = detail_buymat.mat_id
                                              LEFT JOIN material ON material.mat_id = detail_buymat.mat_id
                                              JOIN unit ON unit.unit_id = detail_buymat.unit_id
                                              WHERE detail_buymat.id_mat = '$id_mat' ";
          $objQuery = mysql_query($sql,$connect1);
          $i = 1;
          while ($objReSult = mysql_fetch_array($objQuery)) {

      ?>
        <tr class ="info">
          <td><div align = "center"><?php echo $i; ?></div></td>
          <?php if ($objReSult['feed_id'] != NULL): ?>
            <td><div align = "center"><? echo $objReSult["feed_id"];?></div></td>
          <td><div align = "center"><? echo $objReSult["feed_name"];?></div></td>
          <?php else: ?>
            <td><div align = "left"><? echo $objReSult["mat_id"];?></div></td>
            <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
          <?php endif; ?>
          <td><div align = "right"><? echo $objReSult["count"];?></div></td>
          <td><div align = "right"><? echo $objReSult["balance"];?></div></td>
          <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
          <form class="" action="update_detail_inputmat.php" method="GET">
          <td align="center">
            <?php if ($objReSult["balance"] <= 0): ?>
              <input type="number" name="count" min="1" max="<?php echo $objReSult["balance"];?>" disabled>
            <?php else: ?>
              <input type="number" name="count" min="1" max="<?php echo $objReSult["balance"];?>" required>
            <?php endif; ?>
          </td>
          <?php if ($objReSult['feed_id'] != NULL): ?>
            <input type="hidden" name="mat_id" value="<?php echo $objReSult['feed_id']; ?>">
            <td align="center">
              <input type="submit" class="btn btn-success" value="รับ +">
            </td>
          <?php else: ?>
            <input type="hidden" name="mat_id" value="<?php echo $objReSult['mat_id']; ?>">
            <td align="center">
              <input type="submit" class="btn btn-success" value="รับ +">
            </td>
          <?php endif; ?>
            <input type="hidden" name="id" value="<?php echo $id_input; ?>">
            <input type="hidden" name="idbuy" value="<?php echo $id_mat; ?>">
        </tr>
        </form>
        <?
        $i++;
        $balance = $objReSult['balance'];
      }

      ?>
      <form class="" action="update_detail_inputmat.php" method="GET">
        <tr>
          <?php if ($balance > 0): ?>
            <td colspan="8" class="text-right"><input type="submit" class="btn btn-success" name = "All" value="รับทั้งหมด"></td>
          <?php else: ?>
            <td colspan="8" class="text-right"><input type="submit" class="btn btn-success" name = "All" value="รับทั้งหมด" disabled></td>
          <?php endif; ?>
        </tr>
        <input type="hidden" name="id" value="<?php echo $id_input; ?>">
        <input type="hidden" name="idbuy" value="<?php echo $id_mat; ?>">
      </form>
      </table>
      <form  action="insert_to_stock_con.php?id=<?php echo $id_mat; ?>&idinputmat=<?php echo $id_input; ?>" method="post">
        <div align = "right"><a href="delete_inputmat.php?idinputmat=<?php echo $id_input; ?>"><input type="button" class="btn btn-danger" value="ยกเลิก"></a>
        <input type="submit" class="btn btn-success" value="เสร็จสิ้น">
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
