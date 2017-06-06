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
        <p>ตรวจสอบสต๊อก</p>
        <?php
          $num = 0;
          $sql = "SELECT COUNT(id_stock) FROM stock";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
          $num = sprintf("%05d",$row['COUNT(id_stock)'] + 1);
          $id_detail = 'ipdetail-'.$num;
          $sql = "SELECT * FROM stock ORDER BY id_stock";
          $objQuery = mysql_query($sql,$connect1);
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="GET" action="#">
                        รหัสการับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_stock">
                          <?php
                              $sql = "SELECT * FROM stock";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php echo $row['id_stock'] ?>"><?php echo $row['id_stock'] ?> <?php echo $row['name_stock'] ?></option>
                          <?php
                              }
                           ?>
                        </select>
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="ตรวจสอบสต๊อก" name = "submit" onclick=""> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="mat_to_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
  </div>
<?php if ($_GET): ?>
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th colspan="4"><div class="text-center">รหัสสต๊อก <?php echo $_GET['id_stock']; ?></div></th>
  </tr>
  <tr class="warning">
    <th><div align="center">ลำดับ</div></th>
    <th><div align="center">วัสถุดิบ</div></th>
    <th><div align="center">จำนวน</div></th>
    <th><div align="center">หน่วยนับ</div></th>
  </tr>

<?
  $ID = $_GET['id_stock'];
  $sql = "SELECT SUM(count),stock_detail.mat_id,mat_name,feed_name,unit_name FROM stock_detail LEFT JOIN material ON stock_detail.mat_id = material.mat_id
                                      LEFT JOIN feed ON stock_detail.mat_id = feed.feed_id JOIN unit ON unit.unit_id = stock_detail.unit_id
                                      WHERE stock_id = '$ID' GROUP BY stock_detail.mat_id";
  $objQuery = mysql_query($sql,$connect1);
  $i = 1;
while ($objReSult = mysql_fetch_array($objQuery)) {

?>
  <tr class ="info">
    <td><div class="text-center"><?php echo $i++; ?></div></td>
    <?php if ($objReSult["feed_name"] != NULL): ?>
      <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
    <?php else: ?>
      <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
    <?php endif; ?>
    <td><div align = "left"><? echo $objReSult["SUM(count)"];?></div></td>
    <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
    </tr>
  <?
}

?>
</table>
<?php endif; ?>
</div>

<?php include 'footer.php' ?>
