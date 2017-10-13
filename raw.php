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
    <p>ระบบจัดการวัตถุดิบที่ใช้ในการทำอาหาร</p>
    <?php
    $num = 0;
      $sql = "SELECT COUNT(id_raw) FROM raw_system";
      $objQuery = mysql_query($sql,$connect1);
      $row = mysql_fetch_array($objQuery);
      $num = sprintf("%02d",$row['COUNT(id_raw)'] + 1);
      $id_raw = "DMT-$num";
      date_default_timezone_set("Asia/Bangkok") ;
      $datethis = date("Y-m-d");
     ?>
     <form action="insert_raw.php" method="get">
      <div class="modal-body">
        <h4>
        <table>
          <tr >
            <td style="padding-bottom : 10px;">รหัสจัดการวัตถุดิบ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="text" name="id_raw" value="<?php echo $id_raw; ?>" readonly></td>
          </tr>
          <tr>
            <td style="padding-bottom : 10px;">เลือกเมนูอาหาร </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;">
              <select  name="raw">
                <?php
                  $sql = "SELECT * FROM menu";
                  $result = mysql_query($sql,$connect1);
                  while ($row = mysql_fetch_array($result)) { ?>
                    <option value="<?php echo $row['menu_name']; ?>"><?php echo $row['menu_name']; ?></option>
                <?php
                  }
                ?>

              </select>
            </td>
          </tr>
          <tr>
            <td style="padding-bottom : 10px;">วันที่ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="hidden" name="date" value="<?php echo $datethis; ?>"><?php echo $datethis; ?></td>
          </tr>
        </table>
        </h4>

      </div>
      <div class="modal-footer">
       <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="return confirm('ต้องการเพิ่มข้อมูลนี้?')"> &nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" >ย้อนกลับ</button></a>
     </div>
   </form>
  </div>
  <!----------------------------------------------------------------------------------->
  <?php
      $perpage = 10;
      if (isset($_GET['page']) && $_GET['page'] != 0) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $start = ($page - 1) * $perpage;
   ?>
  <div class="detail">
    <form class="" action="#" method="get">
      <div class="text-right">
        <b style="color : white;">ค้นหาเมนูอาหาร : </b><input type="search" name="search" value=""> <input type="submit" class="btn btn-success" value="ค้นหา" name = "submit"><br><br>
      </div>
    </form>
    <?php
        $sql = "SELECT * FROM raw_system ORDER BY id_raw DESC LIMIT {$start},{$perpage} ";
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql = "SELECT * FROM raw_system WHERE name_raw LIKE '%$search%' ORDER BY id_raw DESC ";
        }
     ?>
      <table  class="table table-striped table-bordered">
        <tr class="warning">
          <th>ลำดับ</th>
          <th>วันที่ทำรายการ</th>
          <th>รหัสจัดการวัตถุดิบ</th>
          <th>ชื่อเมนูอาหาร</th>
          <th>รายละเอียด</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
        </tr>
        <?php
          $result = mysql_query($sql,$connect1);
          $i=0;
            while ($row = mysql_fetch_array($result)){
              $i++;
        ?>
        <tr class="info">
          <td style="width:10%;"><?php echo $i; ?></td>
          <td style="width:10%;"><?php echo $row['date']; ?></td>
          <td style="width:15%;"><?php echo $row['id_raw']; ?></td>
          <td style="width:35%;"><?php echo $row['name_raw']; ?></td>
          <td style="width:10%;"><div align="center"><a data-toggle="modal" data-target="#myModal" OnClick="setRaw('<?php echo $row['id_raw']; ?>')"  href="#myModal"><img src="img/sssss.png" width="30px" hieght="30px" alt=""></a></div></td>
          <td style="width:10%;"><div align="center"><a href="insert_raw.php?id_raw=<?php echo $row['id_raw']; ?>" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><img src="img/edit.png" width="30px" hieght="30px" alt=""></a></div></td>
          <td style="width:10%;"><div align="center"><a href="delete_raw.php?id_raw=<?php echo $row['id_raw']; ?>" onclick="return confirm('ต้องการลบข้อมูลนี้?')"><img src="img/delete.png" width="30px" hieght="30px" alt=""></a></div></td>
        </tr>
        <?php
            }
         ?>

      </table>
      <?php
        $sql2 = "SELECT * FROM raw_system";
        $query2 = mysql_query($sql2, $connect1);
        $total_record = mysql_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
       ?>
      <nav align="center" aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="raw.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
          <?php for($i=1;$i<=$total_page;$i++){ ?>
           <li><a href="raw.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>
          <li class="page-item"><a class="page-link" href="raw.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
        </ul>
      </nav>
    </div>
</div>

<script type="text/javascript">
function setRaw(id_raw){
  $('#test').load('raw_detail.php?id_raw='+id_raw);
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
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
