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

        <p>ข้อมูลการรับวัตถุดิบเข้าคลัง</p>
        <?php
          $num = 0;
          $sql = "SELECT COUNT(id_inputmat) FROM input_material";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
          $num = sprintf("%05d",$row['COUNT(id_inputmat)'] + 1);
          $id_detail = 'ipdetail-'.$num;
          $id_input = "IPMAT-$num";
          $sql = "SELECT * FROM input_material ORDER BY input_material.id_inputmat DESC";
          $objQuery = mysql_query($sql,$connect1);
          date_default_timezone_set("Asia/Bangkok") ;
          $datethis = date("Y-m-d");
          $strDate=date('d-m-Y');
            $strYear = date("Y",strtotime($strDate))+543;
            $strMonth= date("n",strtotime($strDate));
            $strDay= date("j",strtotime($strDate));
            $strDays= date("l",strtotime($strDate));
            $strDayCut = Array("Monday"=>"วันจันทร์ที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกร์ที่","Saturday"=>"วันเสาร์ที่","Sunday"=>"วันอาทิตย์ที่");
            $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
            $strMonthThai=$strMonthCut[$strMonth];
            $strDaysThai = $strDayCut[$strDays];
            $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
         ?>
    <div class="modal-body">
           <form method="POST" action="#" >
                      <h4> รหัสการรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $id_input; ?><input type="hidden" name="id" value="<?php echo $id_input; ?>" readonly="" required></h4>
                      <h4> วันที่การรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $date; ?><input type="hidden" name="date" required value="<?php echo $datethis; ?>" readonly></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<? echo $_SESSION["Username"];?>&nbsp;<input type="hidden" name="username" value="<? echo $_SESSION["Username"];?>" readonly="" required></h4>
                      <h4>
                        รหัสการสั่งซื้อ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_mat" required id="id_mat">
                          <option  value="" disabled selected >--------เลือกใบสั่งซื้อ---------</option>
                          <?php
                              $sql = "SELECT * FROM buymeterial WHERE status = '0' ORDER BY id_mat DESC" ;
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php echo $row['id_mat'] ?>"><?php echo $row['id_mat'] ?> <?php echo $row['res_name'] ?></option>
                          <?php
                              }
                           ?>
                        </select> <i style="color:red;">*</i>
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" > &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="stockanddetail.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
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
            $balance = $row['count'];
            $unit = $row['unit_id'];
            if ($row['feed_id'] != NULL) {
              $mat_id = $row['feed_id'];
              $idstock = $row['id_stock2'];
            }
            else {
              $mat_id = $row['mat_id'];
              $idstock = $row['id_stock'];
            }
            $sql = "INSERT INTO detail_inputmat (id_inputmat,mat_id,count,unit_id,id_stock) VALUES ('$id_input','$mat_id','0','$unit','$idstock')";
            $detail = mysql_query($sql,$connect1);
          }
          header("Location:insert_to_stock.php?id=$id_mat&idinputmat=$id_input");

        }
     ?>

  </div>
<br>
    <table class="table table-striped table-bordered">
      <tr class="warning">
        <th>ลำดับ</th>
        <th>วันทีรับเข้า</th>
        <th>รหัสการรับเข้า</th>
        <th>รหัสการสั่งซื้อ</th>
        <th>เจ้าหน้าที่</th>
        <th><div align = "center">สถานะ</div></th>
        <th><div align = "center">รายละเอียด</div></th>
      </tr>
    <?php
      $perpage = 20;
      if (isset($_GET['page']) && $_GET['page'] != 0) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $start = ($page - 1) * $perpage;
      $idedit = $id_input;
      $table = "SELECT * FROM input_material ORDER BY input_material.id_inputmat DESC LIMIT {$start},{$perpage}";
      $result = mysql_query($table,$connect1);
      $i = 0;
      while ($row = mysql_fetch_array($result)){
        $idedit = $row['id_inputmat'];
        $i++;
        $strDate=date('d-m-Y', strtotime($row["date"]));
          $strYear = date("Y",strtotime($strDate))+543;
          $strMonth= date("n",strtotime($strDate));
          $strDay= date("j",strtotime($strDate));
          $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
          $strMonthThai=$strMonthCut[$strMonth];
          $date=$strDay." ".$strMonthThai." ".$strYear;
      ?>
      <tr class ="info">
        <td><?php echo $i; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $row['id_inputmat']; ?></td>
        <td><?php echo $row['id_mat']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td align="center">
          <?php if ($row['stat'] == 1): ?>
            รับไม่ครบ
          <?php elseif ($row['stat'] == 2): ?>
            <div style="color:green;">รับครบ</div>
          <?php endif; ?>
        </td>
        <td><div align = "center"><a data-toggle="modal" data-target="#myModal" OnClick="setModal('<?php echo $idedit; ?>')"  href="#myModal" ><img src='img/sssss.png' width=25></a></div></td>
      </tr>
      <?php
      }
      ?>
    </table>
    <?php
      $sql2 = "SELECT * FROM input_material";
      $query2 = mysql_query($sql2, $connect1);
      $total_record = mysql_num_rows($query2);
      $total_page = ceil($total_record / $perpage);
     ?>
    <nav align="center" aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="mat_to_stock.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
        <?php for($i=1;$i<=$total_page;$i++){ ?>
         <li><a href="mat_to_stock.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li class="page-item"><a class="page-link" href="mat_to_stock.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
      </ul>
    </nav>
</div>

<?php include 'footer.php'; ?>
<script type="text/javascript">
function setModal(id){
  $('#test').load('select_mat_to_stock.php?id='+id);
}

</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div id="test"></div>
      <div class="text-right" style="margin-right:30px;">
        <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">ปิด</button>
      </div>
      <br>
    </div>
  </div>
</div>
