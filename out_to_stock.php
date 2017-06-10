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
          $id_output = $_GET['id'];
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="<?php echo $id_output; ?>" readonly=""></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;: &nbsp;<input type="text" name="username" value="<? echo $_SESSION["Username"];?>" readonly=""></h4>
                      <h4>
                        รหัสวัตถุดิบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="mat_id" required>
                          <?php
                              $sql = "SELECT DISTINCT * FROM stock_detail LEFT JOIN material ON stock_detail.mat_id = material.mat_id
                                                                          LEFT JOIN feed ON stock_detail.mat_id = feed.feed_id
                                                                          GROUP BY stock_detail.mat_id";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                              <?php if ($row['feed_id'] == NULL): ?>
                                <option value="<?php echo $row['mat_id'] ?>"><?php echo $row['mat_id'] ?> <?php echo $row['mat_name'] ?> จำนวนที่เหลือ : <?php echo $row['count']; ?></option>
                              <?php else: ?>
                                <option value="<?php echo $row['feed_id'] ?>"><?php echo $row['feed_id'] ?> <?php echo $row['feed_name'] ?> จำนวนที่เหลือ : <?php echo $row['count']; ?></option>
                              <?php endif; ?>

                          <?php
                              }
                           ?>
                        </select>
                      </h4>
                      <h4>จำนวน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;<input type="number" name="count" min="0" required placeholder="จำนวนที่จะเบิก"></h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="mat_to_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
</div>
<div class="container">
    <div class="modal-footer"></div>
        <form method="post" action="#">
        <input type="hidden" name="sum" value="<?php echo $sum; ?>">
         <div class="text-right">

           <input type="submit" class="btn" name="submit2" value="ยืนยันการเบิก" onclick="return confirm('ยืนยันการเบิก ?')">
            <br><br>
         </div>
       </form>
    <table class="table table-striped table-bordered">
      <tr class="warning">
        <th align=center>ลำดับ</th>
        <th align=center>รหัสวัตถุดิบ</th>
        <th align=center>ชื่อวัตถุดิบ</th>
        <th align=center>จำนวน</th>
        <th align=center>หน่วยนับ</th>
        <th align=center>แก้ไข</th>
        <th align=center>ลบ</th>
      </tr>
      <?php if ($_POST): ?>

      <?php
      $id = $_POST['id'];
      $username = $_POST['username'];
      $mat_id = $_POST['mat_id'];
      $count = $_POST['count'];
      $no=1;
      $strSQL = "";

      $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
      while ($objReSult = mysql_fetch_array($objQuery)) {
        ?>
        <tr class ="info">
          <td align=center><?php echo $no ?></td>
          <td align=center><?php echo $objReSult["id_detail"]; ?></td>
          <td align=center><?php echo $objReSult["feed_name"]; ?></td>
          <td align=right><?php echo $objReSult["count"]; ?></td>
          <td align=center><?php echo $objReSult["unit_name"]; ?></td>
          <td align=right><?php echo number_format($objReSult["price"],2); ?></td>
          <td><div align = "center"><a href="edit_feed.php?id=<? echo $objReSult['id_detail'];?>&id2=<? echo $id;?>" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
          <td><div align = "center"><a href='delete_feed.php?id=<? echo $objReSult['id_detail'];?>&id2=<? echo $id;?>'
          onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>
        </tr>

        <?php

$no++;

      }


      $sql  = "update `cpa`.`buymeterial` set `total_mat`='".$sum."' where id_mat = '".$id."'";
      $result  = mysql_query($sql);
      if(!$result){
        die('ไม่สามารแก้ไขข้อมูลได้ เกิดข้อผิิดพลาดบางประการ'.mysql_error());
      }
       ?>

  <?php endif; ?>
       </table>
      </div>


  <div class="modal-footer"></div>

</div>
</div>
<?php include 'footer.php' ?>
