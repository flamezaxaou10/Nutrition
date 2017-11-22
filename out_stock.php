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
          $num = 0;
          $sql = "SELECT COUNT(id_outputmat) FROM output_material";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
          $num = sprintf("%05d",$row['COUNT(id_outputmat)'] + 1);
          $id_output = "OPMAT-$num";
          $sql = "SELECT * FROM output_material ORDER BY output_material.date DESC";
          $objQuery = mysql_query($sql,$connect1);
          date_default_timezone_set("Asia/Bangkok") ;
          $datethis = date("Y-m-d H:i:s");
         ?>
    <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $id_output; ?><input type="hidden" name="id" value="<?php echo $id_output; ?>" readonly=""></h4>
                      <h4> วันที่การเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $datethis; ?><input type="hidden" name="date" required value="<?php echo $datethis; ?>" > </h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp; : <? echo $_SESSION["Username"];?><input type="hidden" name="username" value="<? echo $_SESSION["Username"];?>" readonly=""></h4>

           <div class="modal-footer" style="padding-bottom : 0px;">
              <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" > &nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
            </div>
          </form>
    </div>
    <?php
        if($_POST){
            $id_output = $_POST['id'];
            $id_mat = $_POST['id_mat'];
            do {
              $pname = $_POST['username'];
              $date = $_POST['date'];
              $sql = "INSERT INTO output_material (id_outputmat,user,date) VALUES ('$id_output','$pname','$date')";
              $objQuery = mysql_query($sql,$connect1);
            } while (!$objQuery);
            header("Location:out_to_stock.php?idoutputmat=$id_output");
          }

     ?>

  </div>
<br>
    <table class="table table-striped table-bordered">
      <tr class="warning">
        <th>ลำดับ</th>
        <th>วันทีเบิก</th>
        <th>รหัสการเบิก</th>
        <th>เจ้าหน้าที่</th>
        <th><div align = "center">ดูข้อมูล</div></th>
        <th><div align = "center">พิมพ์</div></th>
      </tr>
    <?php
      $perpage = 20;
      if (isset($_GET['page']) && $_GET['page'] != 0) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $start = ($page - 1) * $perpage;

      $idedit = $id_output;
      $table = "SELECT * FROM output_material ORDER BY output_material.id_outputmat DESC LIMIT {$start},{$perpage}";
      $result = mysql_query($table,$connect1);
      $i = 0;
      while ($row = mysql_fetch_array($result)){
        $id = $row['id_outputmat'];
        $i++;
      ?>
      <tr class ="info">
        <td><?php echo $i; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['id_outputmat']; ?></td>
        <td><?php echo $row['user']; ?></td>
        <td><div align = "center"><a href="select_mat_out_stock.php?id=<?php echo $id; ?>" ><img src='img/sssss.png' width=25></a></div></td>
        <td><div align = "center"><a target="_blank"  href="print_output.php?id=<? echo $row['id_outputmat'];?>"><img src='img/print.png' width=25></a></div></td>
      </tr>
      <?php
      }
      ?>
    </table>
    <?php
      $sql2 = "SELECT * FROM output_material";
      $query2 = mysql_query($sql2, $connect1);
      $total_record = mysql_num_rows($query2);
      $total_page = ceil($total_record / $perpage);
     ?>
    <nav align="center" aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="out_stock.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
        <?php for($i=1;$i<=$total_page;$i++){ ?>
         <li><a href="out_stock.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li class="page-item"><a class="page-link" href="out_stock.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
      </ul>
    </nav>
</div>

<?php include 'footer.php'; ?>
