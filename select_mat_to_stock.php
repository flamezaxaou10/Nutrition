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
    <div class="modal-body">
       <div class="modal-body">
         <p>รายละเอียดการรับเข้า</p>
         <table  class="table table-striped table-bordered">
           <tr class="warning">
             <th>ลำดับ</th>
             <th>ประเภทวัตถุดิบ</th>
             <th>ชื่อวัตถุดิบ</th>
             <th>จำนวน</th>
             <th>หน่วยนับ</th>
           </tr>
           <?php
              $id_mat = $_GET['id'];
               $sql = "SELECT * FROM detail_inputmat d LEFT JOIN material m ON d.mat_id = m.mat_id
                                                        LEFT JOIN feed f ON d.mat_id = f.feed_id
                                                        JOIN unit u ON d.unit_id = u.unit_id
                                                        JOIN stock s ON d.id_stock = s.id_stock
                                                        WHERE d.id_inputmat = '$id_mat'";
               $objQuery = mysql_query($sql,$connect1);
               $i = 1;
               while ($objReSult = mysql_fetch_array($objQuery)) {

           ?>
           <tr class ="info">
             <td><div align = "center"><?php echo $i; ?></div></td>
             <td><div align = "left"><? echo $objReSult["name_stock"];?></div></td>
             <?php if ($objReSult['feed_id'] != NULL): ?>
               <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
             <?php else: ?>
               <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
             <?php endif; ?>
             <td><div align = "left"><? echo $objReSult["count"];?></div></td>
             <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
           </tr>
           <?
           $i++;
         }
         ?>
         </table>
       </div>
    </div>
    <div class="modal-footer">
     <a href="mat_to_stock.php"><input type="submit" class="btn btn-danger" value="ย้อนกลับ" name = "submit"></a>
   </div>
  </div>
</div>
<?php include 'footer.php'; ?>
