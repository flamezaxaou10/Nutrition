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
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;: &nbsp;<? echo $_SESSION["fnname"];?></h4>
                      <h4>
                        รหัสวัตถุดิบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_stock" required >
                          <option value=""  disabled selected >เลือกประเภทวัตถุดิบ</option>
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
      </div>
      <?php
          if ($_GET && isset($_GET['id_stock'])):
            $ID = $_GET['id_stock'];
        ?>
        <table class="table table-striped table-bordered">
          <tr class="warning">
            <?php
                $sel = "SELECT * FROM stock WHERE id_stock = '$ID'";
                $select = mysql_query($sel,$connect1);
                $st = mysql_fetch_array($select);
             ?>
            <th><div align="center"><?php echo $ID; ?> : <?php echo $st['name_stock']; ?></div></th>
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
            $sql = "SELECT SUM(count),stock_detail.mat_id,mat_name,feed_name,unit_name,stock_detail.unit_id FROM stock_detail LEFT JOIN material ON stock_detail.mat_id = material.mat_id
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
        <form class="" action="update_detail_outputmat.php" method="GET">
          <tr class ="info">
            <td><div class="text-center"><?php echo $i++; ?></div></td>
            <td><div class="text-center"><?php echo $objReSult['mat_id']; ?></div></td>
            <?php if ($objReSult["feed_name"] != NULL): ?>
              <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
            <?php else: ?>
              <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
            <?php endif; ?>
            <td><div align = "left"><? echo $objReSult["SUM(count)"];?></div></td>
            <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
            <td><div align = "center"><input type="number" name="count" min="1" max="<? echo $objReSult["SUM(count)"];?>" required></div></td>
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
  </div>
</div>
<div class="container">
  <div class="jumbotron">
       <div class="modal-body">
         <form action="#" method="POST">
           <input type="hidden" name="stat" value="show">
         <table class="table table-striped table-bordered">
           <tr class="warning">
             <th><div align="center">ลำดับ</div></th>
             <th><div align="center">ประเภทวัตถุดิบ</div></th>
             <th><div align="center">ชื่อวัตถุดิบ</div></th>
             <th><div align="center">จำนวนที่เบิก</div></th>
             <th><div align="center">หน่วยนับ</div></th>
             <th><div align="center">ลบ</div></th>
           </tr>

         <?
             $sql = "SELECT d.mat_id,f.feed_id,f.feed_name,m.mat_name,SUM(count),u.unit_name,u.unit_id FROM detail_outputmat d LEFT JOIN material m ON d.mat_id = m.mat_id
                                                      LEFT JOIN feed f ON d.mat_id = f.feed_id
                                                      JOIN unit u ON d.unit_id = u.unit_id
                                                      WHERE d.id_outputmat = '$id_output' GROUP BY mat_id";
             $objQuery = mysql_query($sql,$connect1);
             $i = 1;
             while ($objReSult = mysql_fetch_array($objQuery)) {

         ?>
           <tr class ="info">
              <?php $mat = $objReSult["mat_id"]; ?>
             <?php
                $sqlb = "SELECT stock_detail.stock_id,stock.name_stock FROM stock_detail JOIN stock ON stock_detail.stock_id = stock.id_stock WHERE mat_id = '$mat' GROUP BY mat_id";
                $query = mysql_query($sqlb,$connect1);
                $row = mysql_fetch_array($query);
              ?>
             <td><div align = "center"><?php echo $i; ?></div></td>
             <td><div align = "center"><? echo $row["name_stock"];?></div></td>
             <?php if ($objReSult['feed_id'] != NULL): ?>
               <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
             <?php else: ?>
               <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
             <?php endif; ?>
             <td><div align = "left"><? echo $objReSult["SUM(count)"];?></div></td>
             <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
               <td align="center">
                 <a href="delete_detail_outputmat.php?idoutputmat=<?php echo $id_output; ?>&mat_id=<?php echo $mat; ?>&count=<?php echo $objReSult["SUM(count)"]; ?>&stock_id=<?php echo $row['stock_id']; ?>&unit_id=<?php echo $objReSult["unit_id"]; ?>"
                 onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a>
               </td>
           </tr>
           <?
           $i++;
         }
         ?>
           <tr>
             <td colspan="7" class="text-right">
               <a href="delete_out_stock.php?idoutputmat=<?php echo $id_output; ?>"><input type="button" class="btn btn-danger" value="ยกเลิก"  onclick="return confirm('ยืนยันการยกเลิกข้อมูล')"></a>
               <input type="submit" class="btn btn-success" name = "บันทึกข้อมูลการเบิก" value="บันทึกข้อมูลการเบิก">
             </td>
           </tr>
         </table>
         </form>
       </div>
   </div>
</div>
<?php
    if($_POST){
      header("LOCATION:check_out_stock.php?id_output=$id_output");
    }
 ?>
<?php include 'footer.php' ?>
