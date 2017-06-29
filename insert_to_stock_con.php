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
     <div class="modal-body">
        <div class="modal-body">
          <form action="" method="POST">
            <input type="hidden" name="stat" value="show">
          <table class="table table-striped table-bordered">
            <tr class="warning">
              <th><div align="center">ลำดับ</div></th>
              <th><div align="center">ประเภทวัตถุดิบ</div></th>
              <th><div align="center">ชื่อวัตถุดิบ</div></th>
              <th><div align="center">จำนวนที่รับ</div></th>
              <th><div align="center">หน่วยนับ</div></th>
              <th><div align="center">ลบ</div></th>
            </tr>

          <?
              $sql = "SELECT * FROM detail_inputmat LEFT JOIN feed ON feed.feed_id = detail_inputmat.mat_id
                                                  LEFT JOIN material ON material.mat_id = detail_inputmat.mat_id
                                                  JOIN unit ON unit.unit_id = detail_inputmat.unit_id
                                                  JOIN input_material ON input_material.id_inputmat = detail_inputmat.id_inputmat
                                                  JOIN stock ON detail_inputmat.id_stock = stock.id_stock
                                                  WHERE detail_inputmat.id_inputmat = '$id_input' AND detail_inputmat.stat = '1'";
              $objQuery = mysql_query($sql,$connect1);
              $i = 1;
              while ($objReSult = mysql_fetch_array($objQuery)) {

          ?>
            <tr class ="info">
              <td><div align = "center"><?php echo $i; ?></div></td>
              <td><div align = "center"><? echo $objReSult["name_stock"];?></div></td>
              <?php if ($objReSult['feed_id'] != NULL): ?>
                <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
              <?php else: ?>
                <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
              <?php endif; ?>
              <td><div align = "left"><? echo $objReSult["count"];?></div></td>
              <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
              <?php if ($objReSult['feed_id'] != NULL): ?>
                <input type="hidden" name="mat_id<?php echo $i; ?>" value="<?php echo $objReSult['feed_id']; ?>">
                <td align="center">
                  <a href='update_detail_inputmat.php?id=<?php echo $id_input; ?>&mat_id=<?php echo $objReSult['feed_id']; ?>&idbuy=<?php echo $id_mat; ?>&del=1&count=<? echo $objReSult["count"];?>'
                  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a>
                </td>
              <?php else: ?>
                <input type="hidden" name="mat_id<?php echo $i; ?>" value="<?php echo $objReSult['mat_id']; ?>">
                <td align="center">
                  <a href='update_detail_inputmat.php?id=<?php echo $id_input; ?>&mat_id=<?php echo $objReSult['mat_id']; ?>&idbuy=<?php echo $id_mat; ?>&del=1&count=<? echo $objReSult["count"];?>'
                  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a>
                </td>
              <?php endif; ?>
            </tr>

            <input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $objReSult['count']; ?>">
            <input type="hidden" name="unit_id<?php echo $i; ?>" value="<?php echo $objReSult['unit_id']; ?>">
            <?
            $i++;
          }

          ?>
              <input type="hidden" name="id_inputmat" value="<?php echo $id_input; ?>">
            <tr>
              <td colspan="7" class="text-right">
                <a href="insert_to_stock.php?id=<?php echo $id_mat; ?>&idinputmat=<?php echo $id_input; ?>"><input type="button" class="btn btn-danger" value="ย้อนกลับ"></a>
                <input type="submit" class="btn btn-success" name = "บันทึกข้อมูลการรับเข้า" value="บันทึกข้อมูลการรับเข้า">
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

              $id_mat0 = $_POST['id_inputmat'];
              $sql = "SELECT * FROM detail_inputmat WHERE id_inputmat = '$id_mat0' AND stat = '1'";
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
                    $balance = $rowchk['balance'] - $rowchk['count'];
                  }
                  $instock = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id,id_inputmat) VALUES ('$id_stock','$mat_id','$count','$unit','$id_input')";
                  mysql_query($instock,$connect1);
                  $i++;
              }

              // update สถานะการรับเข้า
              $flag;
              $chkstat = "SELECT * FROM detail_buymat WHERE id_mat = '$id_mat'";
              $rechkstat = mysql_query($chkstat,$connect1);
              while ($rowstat = mysql_fetch_array($rechkstat)) {
                if($rowstat['balance'] > 0) {
                  $flag = true;
                  break;
                }
              }
              if ($flag) {
                $upstat = "UPDATE input_material SET stat = '1' WHERE id_mat = '$id_mat' AND id_inputmat = '$id_input'";
                mysql_query($upstat,$connect1);
              }
              else {
                $upstat = "UPDATE input_material SET stat = '2' WHERE id_mat = '$id_mat' AND id_inputmat = '$id_input'";
                mysql_query($upstat,$connect1);
                $upstat = "UPDATE buymeterial SET status = '2' WHERE id_mat = '$id_mat'";
                mysql_query($upstat,$connect1);
              }


            echo( "<script> alert('เพิ่มข้อมูลลงสต๊อกสำเร็จ');</script>");
            echo( "<script>window.location='mat_to_stock.php';</script>");
          }
           ?>
<?php include 'footer.php'; ?>
