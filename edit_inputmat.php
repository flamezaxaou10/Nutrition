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
        <p>แก้ไขข้อมูลการรับเข้า</p>
        <?php
          $ID = $_GET['id'];

          $sql = "SELECT * FROM input_material WHERE id_inputmat = '$ID'";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="<?php echo $ID ?>" readonly=""></h4>
                      <h4> วันที่การรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="date" name="date" required value="<?php echo $row['date']; ?>"></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="username" value="<? echo $_SESSION["Username"];?>" readonly=""></h4>
                      <h4>
                        รหัสการสั่งซื้อ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_mat" required>
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
                      <h4>
                        รหัสการสต๊อก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_stock" required>
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
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit" > &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="mat_to_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
    <?php
        if($_POST){
            $id_input = $_POST['id'];
            do {
              $pname = $_POST['username'];
              $id_mat = $_POST['id_mat'];
              $date = $_POST['date'];
              $id_stock = $_POST['id_stock'];
              $sql = "UPDATE input_material SET id_mat = '$id_mat',date = '$date',id_stock = '$id_stock' WHERE id_inputmat = '$id_input'";
              $objQuery = mysql_query($sql,$connect1);

              // update detail

              $sqldetail = "SELECT * FROM input_material JOIN detail_buymat ON detail_buymat.id_mat = input_material.id_mat
                                                    LEFT JOIN feed ON feed.feed_id = detail_buymat.mat_id
                                                    LEFT JOIN material ON material.mat_id = detail_buymat.mat_id
                                                    WHERE input_material.id_inputmat = '$id_input'";
              $detail = mysql_query($sqldetail,$connect1);
              while ($row = mysql_fetch_array($detail)) {
              $mat_id;
              $count = $row['count'];
              $unit = $row['unit_id'];
              if ($row['feed_id'] != NULL) {
                $mat_id = $row['feed_id'];
              }
              else {
                $mat_id = $row['mat_id'];
              }
              $sql = "UPDATE detail_inputmat SET mat_id = '$mat_id',count = '$count',unit_id = '$unit' WHERE id_inputmat = '$ID'";
              $objQuery = mysql_query($sql,$connect1);
            }

            } while (!$objQuery);
          if(!$objQuery){
           echo( "<script> alert('ไม่สามารถแก้ไขข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
               </script>");
          }
          else {
            echo( "<script> alert('แก้ไขข้อมูลสำเร็จ');</script>");
            echo( "<script>window.location='mat_to_stock.php';</script>");
          }
        }
     ?>
  </div>

<br>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสการรับเข้า</div></th>
    <th><div align="center">Username</div></th>
    <th><div align="center">รหัสการสั่งซื้อ</div></th>
    <th><div align="center">วันที่รับเข้า</div></th>
    <th><div align="center">รหัสสต๊อก</div></th>
  </tr>

<?
  $sql = "SELECT * FROM input_material";
  $objQuery = mysql_query($sql,$connect1);
  while ($objReSult = mysql_fetch_array($objQuery)) {

?>
  <tr class ="info">
    <td><div align = "center"><?php echo $objReSult["id_inputmat"];?></div></td>
    <td><div align = "left"><? echo $objReSult["username"];?></div></td>
    <td><div align = "left"><? echo $objReSult["id_mat"];?></div></td>
    <td><div align = "left"><? echo $objReSult["date"];?></div></td>
    <td><div align = "left"><? echo $objReSult["id_stock"];?></div></td>
    </tr>
  <?
}

?>
</table>
</div>

<?php include 'footer.php'; ?>
