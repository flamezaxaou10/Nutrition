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
           <form method="GET" action="#">
                        รหัสสต๊อกและชื่อสต๊อก &nbsp;: &nbsp;
                        <select class="" name="id_stock" required>
                          <?php
                              $sql = "SELECT * FROM stock";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                                if ($_GET['id_stock'] == $row['id_stock']) {
                                  $selected = "selected";
                                }
                                else {
                                  $selected = "";
                                }
                          ?>
                                <option value="<?php echo $row['id_stock']; ?>" <?php echo $selected; ?> ><?php echo $row['id_stock'] ?> <?php echo $row['name_stock'] ?></option>
                          <?php
                              }
                           ?>
                        </select>
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="ตรวจสอบ" name = "submit" onclick=""> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="stockanddetail.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการตรวจสอบข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
    </div>
  </div>
<?php if ($_GET): ?>

<?php
    $ID = $_GET['id_stock'];
    $sql = "SELECT * FROM stock WHERE id_stock = '$ID'";
    $query = mysql_query($sql,$connect1);
    $result = mysql_fetch_array($query);
 ?>
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th colspan="4"><div class="text-center">รหัสสต๊อก <?php echo $_GET['id_stock']; ?> : <?php echo $result['name_stock']; ?></div></th>
  </tr>
  <tr class="warning">
    <th><div align="center">ลำดับ</div></th>
    <th><div align="center">วัตถุดิบ</div></th>
    <th><div align="center">จำนวน</div></th>
    <th><div align="center">หน่วยนับ</div></th>
  </tr>

<?

  $sql = "SELECT SUM(count),stock_detail.mat_id,mat_name,feed_name,unit_name FROM stock_detail LEFT JOIN material ON stock_detail.mat_id = material.mat_id
                                      LEFT JOIN feed ON stock_detail.mat_id = feed.feed_id JOIN unit ON unit.unit_id = stock_detail.unit_id
                                      WHERE stock_id = '$ID' GROUP BY mat_name";
  if ($ID == 'MT-06') {
    $sql = "SELECT SUM(count),stock_detail.mat_id,mat_name,feed_name,unit_name FROM stock_detail LEFT JOIN material ON stock_detail.mat_id = material.mat_id
                                        LEFT JOIN feed ON stock_detail.mat_id = feed.feed_id JOIN unit ON unit.unit_id = stock_detail.unit_id
                                        WHERE stock_id = '$ID' GROUP BY feed_name";
  }
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
    <td><div align = "right"><? echo $objReSult["SUM(count)"];?></div></td>
    <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
    </tr>
  <?
}

?>
</table>
<?php endif; ?>
</div>

<?php include 'footer.php' ?>
