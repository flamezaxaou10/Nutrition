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
  $id_output = $_GET['idoutputmat'];
 ?>
<div class="container">
  <div class="jumbotron">
    <div class="modal-body">
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
               <a href="out_to_stock.php?idoutputmat=<?php echo $id_output; ?>&id_stock=<?php echo $row['stock_id']; ?>"><input type="button" class="btn btn-danger" value="ย้อนกลับ"></a>
               <input type="submit" class="btn btn-success" name = "บันทึกข้อมูลการเบิก" value="บันทึกข้อมูลการเบิก">
             </td>
           </tr>
         </table>
         </form>
       </div>
     </div>
   </div>
</div>
<?php
    if ($_POST) {
      header("LOCATION:out_stock.php");
    }
 ?>
<?php include 'footer.php' ?>
