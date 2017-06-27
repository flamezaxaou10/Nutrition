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
         <table  class="table table-striped table-bordered">
           <tr class="warning">
             <th><div align="center">ลำดับ</div></th>
             <th><div align="center">รหัสวัตถุดิบ</div></th>
             <th><div align="center">ชื่อวัตถุดิบ</div></th>
             <th><div align="center">จำนวนที่สั่งซื้อ</div></th>
             <th><div align="center">หน่วยนับ</div></th>
             <th><div align="center">จำนวนที่รับ</div></th>
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
             <td>
               <input type="number" name="count<?php echo $i; ?>">
             </td>
           </tr>
           <?php if ($objReSult['feed_id'] != NULL): ?>
             <input type="hidden" name="mat_id<?php echo $i; ?>" value="<?php echo $objReSult['feed_id']; ?>">
           <?php else: ?>
             <input type="hidden" name="mat_id<?php echo $i; ?>" value="<?php echo $objReSult['mat_id']; ?>">
           <?php endif; ?>
           <input type="hidden" name="count2<?php echo $i; ?>" value="<?php echo $objReSult['count']; ?>">
           <input type="hidden" name="unit_id<?php echo $i; ?>" value="<?php echo $objReSult['unit_id']; ?>">
           <input type="hidden" name="id_mat" value="<?php echo $id_mat; ?>">
           <?
           $i++;
         }

         ?>
           <tr>
             <td colspan="6" class="text-right"><input type="submit" class="btn btn-success" value="บันทึกการรับเข้า"></td>
           </tr>
         </table>
        </div>
    </div>
  </div>
</div>
<?php
if ($_POST) {

    $id_mat0 = $_POST['id_mat'];
    $sql = "SELECT * FROM detail_buymat WHERE id_mat = '$id_mat0'";
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
