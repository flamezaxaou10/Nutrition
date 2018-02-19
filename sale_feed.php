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
  <form class="" action="#" method="post" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
  <div class="jumbotron">
      <p>การขายอาหารทางสายยาง</p>
      <?php
          $sql = "SELECT COUNT(salefeed_id) FROM sale_feed";
          $result = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($result);
          $num = sprintf("%04d",$row['COUNT(salefeed_id)'] + 1);
          $salefeed_id = "BF-$num";
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
      <h4>
        <style media="screen">
          td{
            padding-bottom : 20px;
          }
        </style>
         <table>
           <tr >
             <td>รหัสการขายอาหารทางสายยาง </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $salefeed_id; ?></td>
           </tr>
           <tr>
             <td>วันที่ขาย </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <?php echo $date; ?></td>
           </tr>
           <tr>
             <td>ชื่อผู้ป่วย </td>
             <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
             <td> <input type="text" name="customer" required><font color="red">&nbsp;*</font></td>
           </tr>
         </table>
    </h4>
    </div>
    <div class="modal-footer" style="padding-bottom : 0px;">
        <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"  >&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
    </div>
  </div>
  </form>
  <div class="text-right">
    <form class="" action="#" method="get">
      <b style="color:white;">ค้นหาชื่อผู้ป่วย : </b>
      <input type="search" name="search" value="">
      <input  class="btn btn-success" type="submit" name="" value="ค้นหา">
    </form>
  </div>
  <br>
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th><div align="center">ลำดับ</div></th>
      <th><div align="center">วันที่ขาย</th>
      <th><div align="center">รหัสการขาย</div></th>
      <th><div align="center">ผู้ป่วย</div></th>
      <th><div align = "center">ดูข้อมูล</div></th>
      <th><div align = "center">พิมพ์ใบสั่งยา</div></th>
    </tr>
  <?php
    $perpage = 20;
    if (isset($_GET['page']) && $_GET['page'] != 0) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }
    $start = ($page - 1) * $perpage;
    $table = "SELECT * FROM sale_feed ORDER BY sale_feed.salefeed_id DESC LIMIT {$start},{$perpage}";
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
      $table = "SELECT * FROM sale_feed WHERE customer LIKE '%$search%' ORDER BY sale_feed.salefeed_id DESC";
    }

    $result = mysql_query($table,$connect1);
    $i = 0;
    while ($row = mysql_fetch_array($result)){
      $id = $row['salefeed_id'];
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
      <td><?php echo $row['salefeed_id']; ?></td>
      <td><?php echo $row['customer']; ?></td>
      <td><div align = "center"><a data-toggle="modal" data-target="#myModal" OnClick="setModal('<?php echo $id; ?>')"  href="#myModal" ><img src='img/sssss.png' width=25></a></div></td>
      <td><div align = "center"><a target="_blank"  href="print_sale_feed.php?salefeed_id=<? echo $row['salefeed_id'];?>"><img src='img/print.png' width=25></a></div></td>
    </tr>
    <?php
    }
    ?>
  </table>
  <?php
    $sql2 = "SELECT * FROM sale_feed";
    $query2 = mysql_query($sql2, $connect1);
    $total_record = mysql_num_rows($query2);
    $total_page = ceil($total_record / $perpage);
   ?>
  <nav align="center" aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="sale_feed.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
      <?php for($i=1;$i<=$total_page;$i++){ ?>
       <li><a href="sale_feed.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
      <?php } ?>
      <li class="page-item"><a class="page-link" href="sale_feed.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
    </ul>
  </nav>
</div>
<?php include 'footer.php'; ?>
<?php
  if ($_POST) {
    $customer = $_POST['customer'];
    $sql = "INSERT INTO sale_feed VALUES('$salefeed_id','$datethis','$customer')";
    mysql_query($sql,$connect1);
    header("LOCATION:sale_feed_con.php?salefeed_id=$salefeed_id");
  }
 ?>

 <script type="text/javascript">
 function setModal(id){
   $('#test').load('select_sale_feed.php?id='+id);
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
