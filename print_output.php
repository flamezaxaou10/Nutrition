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
$id_output = $_GET['id'];
?>
<div class="container">
  <div class="jumbotron">
    <div class="modal-body">
      <p>รายละเอียดการเบิก</p>
      <br>
        <?php
            $sql = "SELECT * FROM output_material WHERE id_outputmat = '$id_output'";
            $query = mysql_query($sql,$connect1);
            $row = mysql_fetch_array($query);

         ?>
             <h4> รหัสการเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $id_output; ?></h4>
             <h4> วันที่การเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $row['date']; ?></h4>
             <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp; : <? echo $row['user'];?></h4>
       <div class="modal-body">
         <table  class="table table-striped table-bordered">
           <tr class="warning">
             <th>ลำดับ</th>
             <th>ประเภทวัตถุดิบ</th>
             <th>ชื่อวัตถุดิบ</th>
             <th>จำนวน</th>
             <th>คงเหลือในคลัง</th>
             <th>หน่วยนับ</th>
           </tr>
           <?php

               $sql = "SELECT d.mat_id,f.feed_id,f.feed_name,m.mat_name,d.count,u.unit_name FROM detail_outputmat d LEFT JOIN material m ON d.mat_id = m.mat_id
                                                        LEFT JOIN feed f ON d.mat_id = f.feed_id
                                                        JOIN unit u ON d.unit_id = u.unit_id
                                                        WHERE d.id_outputmat = '$id_output'";
               $objQuery = mysql_query($sql,$connect1);
               $i = 1;
               while ($objReSult = mysql_fetch_array($objQuery)) {

           ?>
           <tr class ="info">
             <?php $mat = $objReSult["mat_id"]; ?>
             <?php
                $sqlb = "SELECT SUM(count),stock.name_stock FROM stock_detail JOIN stock ON stock_detail.stock_id = stock.id_stock WHERE mat_id = '$mat' GROUP BY mat_id";
                $query = mysql_query($sqlb,$connect1);
                $row = mysql_fetch_array($query);
              ?>
             <td><div align = "center"><?php echo $i; ?></div></td>
             <td><div align = "left"><? echo $row["name_stock"];?></div></td>
             <?php if ($objReSult['feed_id'] != NULL): ?>
               <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
             <?php else: ?>
               <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
             <?php endif; ?>
             <td><div align = "left"><? echo $objReSult["count"];?></div></td>
             <td><div align = "left"><? echo $row["SUM(count)"];?></div></td>
             <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
           </tr>
           <?
           $i++;
         }
         ?>
         </table>
       </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  window.print();
</script>
