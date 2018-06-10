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
    <p>ระบบจัดการเบิกวัตถุดิบที่ใช้ในการทำอาหาร</p>
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
            <td style="padding-bottom : 10px;">รหัสการเบิกวัตถุดิบ </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;"> <input type="hidden" name="id_raw" value="<?php echo $id_raw; ?>"><?php echo $id_raw; ?></td>
            <td> <input type="hidden" name="date" value="<?php echo $datethis; ?>"></td>
          <tr>
            <td style="padding-bottom : 10px;">เลือกเมนูอาหาร </td>
            <td style="padding-bottom : 10px;">&nbsp; : &nbsp;</td>
            <td style="padding-bottom : 10px;">
              <select  name="raw" required>
                <option value="" selected disabled>--- เลือกเมนูอาหาร ---</option>
                <?php
                  $sql = "SELECT * FROM menu  ORDER BY menu_name";
                  $result = mysql_query($sql,$connect1);
                  while ($row = mysql_fetch_array($result)) {
                    $raw_name = $row['menu_name'];
                    // $chk = "SELECT * FROM raw_system WHERE name_raw = '$raw_name'";
                    // $rechk = mysql_query($chk,$connect1);
                    // $num = mysql_num_rows($rechk);
                    // $hide = '';
                    // if ($num > 0) {
                    //   $hide = 'style="display: none;"';
                    // }
                    // else {
                    //   $hide = '';
                    // }
                ?>
                    <option value="<?php echo $raw_name; ?>" <?php echo $hide ?>><?php echo $raw_name; ?></option>
                <?php
                  }

                ?>

              </select><font color="red">&nbsp;*</font>
            </td>
          </tr>
        </table>
        <?php
        date_default_timezone_set("Asia/Bangkok") ;
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
        <?php echo "วันที่เบิกวัตถุดิบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; " .$date; ?>
        </h4>

      </div>
      <div class="modal-footer">
       <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" > &nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" >ย้อนกลับ</button></a>
     </div>
   </form>
  </div>
  <!----------------------------------------------------------------------------------->
  <?php
      $perpage = 20;
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
        <tr class=" success" >
          <th><div align="center">ลำดับ</th>
          <th><div align="center">รหัสการเบิกวัตถุดิบ</th>
          <th><div align="center">วันที่เบิก</th>
          <th><div align="center">ชื่อเมนูอาหาร</th>
          <th><div align="center">รายละเอียด</th>
          <th><div align="center">แก้ไข</th>
          <th><div align="center">ลบ</th>
        </tr>
        <?php
          $result = mysql_query($sql,$connect1);
          $i=0;
            while ($row = mysql_fetch_array($result)){
              $i++;
              $strDate=date('d-m-Y', strtotime($row["date"]));
            		$strYear = date("Y",strtotime($strDate))+543;
            		$strMonth= date("n",strtotime($strDate));
            		$strDay= date("j",strtotime($strDate));
            		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            		$strMonthThai=$strMonthCut[$strMonth];
            		$date=$strDay." ".$strMonthThai." ".$strYear;
        ?>
        <?php if ($row['date'] == $datethis): ?>
          <tr class="warning ">
            <td style="width:10%;"><div align="center"><?php echo $i; ?></div></td>
            <td style="width:15%;"><?php echo $row['id_raw']; ?></td>
            <td><?php echo $date ?></td>
            <td style="width:35%;"><?php echo $row['name_raw']; ?></td>
            <td style="width:10%;"><div align="center"><a data-toggle="modal" data-target="#myModal" OnClick="setRaw('<?php echo $row['id_raw']; ?>')"  href="#myModal"><img src="img/sssss.png" width="30px" hieght="30px" alt=""></a></div></td>
            <td style="width:10%;"><div align="center"><a href="insert_raw.php?id_raw=<?php echo $row['id_raw']; ?>&edit" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><img src="img/edit.png" width="30px" hieght="30px" alt=""></a></div></td>
            <td style="width:10%;"><div align="center"><a href="delete_raw.php?id_raw=<?php echo $row['id_raw']; ?>" onclick="return confirm('ต้องการลบข้อมูลนี้?')"><img src="img/delete.png" width="30px" hieght="30px" alt=""></a></div></td>
          </tr>
        <?php else: ?>
          <tr class=" info">
            <td style="width:10%;"><div align="center"><?php echo $i; ?></div></td>
            <td style="width:15%;"><?php echo $row['id_raw']; ?></td>
            <td><?php echo $date ?></td>
            <td style="width:35%;"><?php echo $row['name_raw']; ?></td>
            <td style="width:10%;"><div align="center"><a data-toggle="modal" data-target="#myModal" OnClick="setRaw('<?php echo $row['id_raw']; ?>')"  href="#myModal"><img src="img/sssss.png" width="30px" hieght="30px" alt=""></a></div></td>
            <td style="width:10%;"><div align="center"><img src="img/close.png" width="30px" hieght="30px" alt=""></div></td>
            <td style="width:10%;"><div align="center"><img src="img/close.png" width="30px" hieght="30px" alt=""></div></td>
          </tr>
        <?php endif; ?>
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
          <li class="page-item"><a class="page-link" href="raw.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"> << </span></a></li>
          <?php for($i=1;$i<=$total_page;$i++){ ?>
           <li><a href="raw.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>
          <li class="page-item"><a class="page-link" href="raw.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true"> >> </span></a></li>
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
      <div id="test" class="modal-body"></div>
      <div class="text-right" style="margin-right:30px;">
        <button type="button" class="btn btn-success"name="button" onclick="prints('test')">พิมพ์</button>
        <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">ปิด</button>
      </div>
      <br>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>
<script type="text/javascript">
  function prints(divName) {
    var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

   document.body.innerHTML = originalContents;
   location.reload();
  }
</script>
