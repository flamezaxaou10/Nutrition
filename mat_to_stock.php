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
           &nbsp;&nbsp; <a href="stockanddetail.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
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
              $sql = "INSERT INTO input_material (id_inputmat,id_mat,username,date) VALUES ('$id_input','$id_mat','$pname','$date')";
              $objQuery = mysql_query($sql,$connect1);
            } while (!$objQuery);

            // นำของใส่ detail_inputmat

            $sql = "SELECT * FROM input_material JOIN detail_buymat ON detail_buymat.id_mat = input_material.id_mat
                                                  LEFT JOIN feed ON feed.feed_id = detail_buymat.mat_id
                                                  LEFT JOIN material ON material.mat_id = detail_buymat.mat_id
                                                  WHERE detail_buymat.id_mat = '$id_mat' AND input_material.id_inputmat = '$id_input'";
            $adddetail = mysql_query($sql,$connect1);

          while ($row = mysql_fetch_array($adddetail)) {
            $mat_id;
            $count = $row['count'];
            $unit = $row['unit_id'];
            if ($row['feed_id'] != NULL) {
              $mat_id = $row['feed_id'];
              $idstock = $row['id_stock2'];
            }
            else {
              $mat_id = $row['mat_id'];
              $idstock = $row['id_stock'];
            }
            $sql = "INSERT INTO detail_inputmat (id_inputmat,mat_id,count,unit_id,id_stock) VALUES ('$id_input','$mat_id','$count','$unit','$idstock')";
            $detail = mysql_query($sql,$connect1);
          }
          header("Location:insert_to_stock.php?id=$id_mat&idinputmat=$id_input");

        }
     ?>

  </div>
<br>
    <table class="table table-striped table-bordered">
      <tr class="warning">
        <th>วันที่</th>
        <th>รหัสการรรับเข้า</th>
        <th>รหัสเจ้าหน้าที่</th>
        <th>รหัสการสั่งซื้อ</th>
        <th>ดูข้อมูล</th>
      </tr>
    <?php
      $idedit = $id_input;
      $table = "SELECT * FROM input_material";
      $result = mysql_query($table,$connect1);
      while ($row = mysql_fetch_array($result)){
        $idedit = $row['id_inputmat'];
      ?>
      <tr class ="info">
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['id_inputmat']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['id_mat']; ?></td>
        <td><div align = "center"><a href="select_mat_to_stock.php?id=<?php echo $idedit; ?>" ><img src='img/sssss.png' width=25></a></div></td>
      </tr>
      <?php
      }
      ?>
    </table>
</div>

<?php include 'footer.php'; ?>
