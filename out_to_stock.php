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
        <p>ข้อมูลการเบิกวัตถุดิบ</p>
        <?php
          $id_output = $_GET['idoutputmat'];
         ?>
    <div class="modal-body">
       <div class="modal-body">
                  <form class="" action="#" method="get">
                      <h4> รหัสการเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $id_output; ?><input type="hidden" name="idoutputmat" value="<?php echo $id_output; ?>" readonly=""></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;: &nbsp;<? echo $_SESSION["Username"];?></h4>
                      <h4>
                        รหัสวัตถุดิบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_stock" required >
                          <option >เลือกประเภทวัตถุดิบ</option>
                          <?php

                              $sql = "SELECT DISTINCT * FROM stock";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php echo $row['id_stock']; ?>" >
                                  <?php echo $row['id_stock']; ?> // <?php echo $row['name_stock']; ?>
                                </option>
                          <?php
                              }
                           ?>
                        </select> <input type="submit" value="เปิด" class="btn btn-success">
                      </h4>
                    </form>
          <form method="GET" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เสร็จสิ้น" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="delete_out_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<div class="container">
<?php
    if ($_GET && isset($_GET['id_stock'])):
      $ID = $_GET['id_stock'];
  ?>
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th><div align="center"><?php echo $ID; ?></div></th>
    </tr>
    <tr class="warning">
      <th>ลำดับ</th>
      <th>รหัสวัตถุดิบ</th>
      <th>ชื่อวัตถุดิบ</th>
      <th>จำนวน</th>
      <th>หน่วยนับ</th>
      <th>จำนวนที่เบิก</th>
      <th>เบิก</th>
    </tr>
    <?php
      $sql = "SELECT stock_detail.count,stock_detail.mat_id,mat_name,feed_name,unit_name,stock_detail.unit_id FROM stock_detail LEFT JOIN material ON stock_detail.mat_id = material.mat_id
                                          LEFT JOIN feed ON stock_detail.mat_id = feed.feed_id JOIN unit ON unit.unit_id = stock_detail.unit_id
                                          WHERE stock_id = '$ID' GROUP BY stock_detail.mat_id";
      $objQuery = mysql_query($sql,$connect1);
      $i = 1;
    while ($objReSult = mysql_fetch_array($objQuery)) {

  ?>
  <form class="" action="update_detail_outputmat.php" method="GET">
    <tr class ="info">
      <td><div class="text-center"><?php echo $i++; ?></div></td>
      <td><div class="text-center"><?php echo $objReSult['mat_id']; ?></div></td>
      <?php if ($objReSult["feed_name"] != NULL): ?>
        <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
      <?php else: ?>
        <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
      <?php endif; ?>
      <td><div align = "left"><? echo $objReSult["count"];?></div></td>
      <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
      <td><div align = "center"><input type="number" name="count" min="1" max="<? echo $objReSult["count"];?>" required></div></td>
      <td><div align = "center">
              <button type="submit" name="button" class = "btn btn-success">เบิก +</button>
              <input type="hidden" name="mat_id" value="<?php echo $objReSult['mat_id']; ?>">
              <input type="hidden" name="id_stock" value="<?php echo $ID; ?>">
              <input type="hidden" name="idoutputmat" value="<?php echo $id_output; ?>">
              <input type="hidden" name="unit_id" value="<?php echo $objReSult["unit_id"]; ?>">
          </div>
      </td>
    </tr>
    </form>
    <?
  }
  ?>
  </table>
<?php endif; ?>
</div>
<?php
    if($_POST){
      $mat_id = $_GET['mat_id'];
      $sql = "SELECT * FROM stock_detail WHERE mat_id = '$mat_id' GROUP BY mat_id";
    }
 ?>
<?php include 'footer.php' ?>
