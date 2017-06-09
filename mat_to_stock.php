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
        <p>ข้อมูลการรับเข้า</p>
        <?php
          $num = 0;
          $sql = "SELECT COUNT(id_inputmat) FROM input_material";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
          $num = sprintf("%05d",$row['COUNT(id_inputmat)'] + 1);
          $id_detail = 'ipdetail-'.$num;
          $id_input = "IPMAT-$num";
          $sql = "SELECT * FROM input_material ORDER BY id_inputmat";
          $objQuery = mysql_query($sql,$connect1);
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="<?php echo $id_input; ?>" readonly=""></h4>
                      <h4> วันที่การรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="date" name="date" required></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="username" value="<? echo $_SESSION["Username"];?>" readonly=""></h4>
                      <h4>
                        รหัสการสั่งซื้อ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_mat">
                          <?php
                              $sql = "SELECT * FROM buymeterial WHERE status = '0'";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php echo $row['id_mat'] ?>"><?php echo $row['id_mat'] ?> <?php echo $row['res_name'] ?></option>
                          <?php
                              }
                           ?>
                        </select>
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="mat_to_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
    <?php
        if($_POST){
            $id_input = $_POST['id'];
            $id_mat = $_POST['id_mat'];
            do {
              $pname = $_POST['username'];
              $date = $_POST['date'];
              $id_stock = $_POST['id_stock'];
              $sql = "INSERT INTO input_material (id_inputmat,id_mat,username,date) VALUES ('$id_input','$id_mat','$pname','$date')";
              $objQuery = mysql_query($sql,$connect1);
              $num = sprintf("%05d",$row['COUNT(id_input)']++);
              $stockid = 'IPMAT-'.$num;
            } while (!$objQuery);

            // นำของใส่ detail_inputmat

            $sql = "SELECT * FROM input_material JOIN detail_buymat ON detail_buymat.id_mat = input_material.id_mat
                                                  LEFT JOIN feed ON feed.feed_id = detail_buymat.mat_id
                                                  LEFT JOIN material ON material.mat_id = detail_buymat.mat_id
                                                  WHERE detail_buymat.id_mat = '$id_mat'";
            $adddetail = mysql_query($sql,$connect1);

          while ($row = mysql_fetch_array($adddetail)) {
            $mat_id;
            $count = $row['count'];
            $unit = $row['unit_id'];
            if ($row['feed_id'] != NULL) {
              $mat_id = $row['feed_id'];
            }
            else {
              $mat_id = $row['mat_id'];
            }
            $sql = "INSERT INTO detail_inputmat (id_inputmat,mat_id,count,unit_id) VALUES ('$id_input','$mat_id','$count','$unit')";
            $detail = mysql_query($sql,$connect1);
          }

        }
     ?>
  </div>
<br>
<?php if ($_POST): ?>
<form action="" method="get">
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">ลำดับ</div></th>
    <th><div align="center">รหัสวัตถุดิบ</div></th>
    <th><div align="center">ชื่อวัตถุดิบ</div></th>
    <th><div align="center">จำนวน</div></th>
    <th><div align="center">หน่วยนับ</div></th>
    <th><div align="center">รหัสสต๊อก</div></th>
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
    <td><div align = "left"><? echo $objReSult["mat_id"];?></div></td>
    <td><div align = "left"><? echo $objReSult["mat_name"];?></div></td>
    <td><div align = "left"><? echo $objReSult["count"];?></div></td>
    <td><div align = "left"><? echo $objReSult["unit_name"];?></div></td>
    <td>
      <select class="" name="id_stock<?php echo $i; ?>" required>
        <option value="" disabled selected>เลือก สต๊อกที่เก็บ</option>
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
    </td>
  </tr>
  <input type="hidden" name="mat_id<?php echo $i; ?>" value="<?php echo $objReSult['mat_id']; ?>">
  <input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $objReSult['count']; ?>">
  <input type="hidden" name="unit_id<?php echo $i; ?>" value="<?php echo $objReSult['unit_id']; ?>">
  <?
  $i++;
}

?>
  <tr>
    <td colspan="6" class="text-right"><input type="submit" class="btn btn-success" value="เก็บใส่สต๊อก"></td>
  </tr>
</table>
</form>
<?php endif; ?>
</div>
<?php

    if ($_GET) {
      $id_mat0;
        $chk = "SELECT * FROM input_materail WHERE id_inputmat = '$id_input'";
        $result = mysql_query($sql,$connect1);
        while ($row = mysql_fetch_array($result)) {
          $id_mat0 = $row['id_mat'];
        }
        $sql = "SELECT * FROM detail_buymat WHERE id_mat = '$id_mat0'";
        $query = mysql_query($sql,$connect1);
        $i = 1;
        //นำของเข้า stock
         while ($row = mysql_fetch_array($query)) {
            $id_stock = $_GET["id_stock$i"];
            $count = $_GET["count$i"];
            $mat_id = $_GET["mat_id$i"];
            $unit = $_GET["unit_id$i"];
            $instock = "INSERT INTO stock_detail (stock_id,mat_id,count,unit_id) VALUES ('$id_stock','$mat_id','$count','$unit')";
            mysql_query($instock,$connect1);
            $i++;
        }
      echo( "<script> alert('เพิ่มข้อมูลลงสต๊อกสำเร็จ');</script>");
      echo( "<script>window.location='mat_to_stock.php';</script>");
    }

 ?>
<?php include 'footer.php'; ?>
