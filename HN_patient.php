<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
include 'header.php';
?>
<div class="container">
		<div class="jumbotron">
      <br>
      <p>ข้อมูลผู้ป่วย</p>
      <div class="modal-body">
        <form  action="" method="post">
          <h4>
            ค้นหาจากชื่อ - นามสกุล :
            <input type="text" name="search" value="">
            <input type="submit" class="btn btn-success" value="ค้นหา">
          </h4>
        </form>
      </div>
    </div>
    <?php
      $perpage = 30;
      if (isset($_GET['page']) && $_GET['page'] != 0) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $start = ($page - 1) * $perpage;
      if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $table = "SELECT * FROM fpatient_info WHERE fname like '%$search%' LIMIT {$start},{$perpage}";
      } else {
        $table = "SELECT * FROM fpatient_info LIMIT {$start},{$perpage}";
      }
      $result = mysql_query($table,$connect2);
     ?>
    <div class="table">
      <table class="table table-striped table-bordered">
        <tr class="warning">
          <th><div align="center">ชื่อแผนก</div></th>
          <th><div align="center">รหัสผู้ป่วย</div></th>
          <th><div align="center">เลขที่ผู้ป่วยใน</div></th>
          <th><div align="center">ชื่อ</div></th>
          <th><div align="center">นามสกุล</div></th>
          <th><div align="center">น้ำหนัก</div></th>
          <th><div align="center">ส่วนสูง</div></th>
          <th><div align="center">ห้อง</div></th>
          <th><div align="center">เตียง</div></th>
          <th><div align="center">รหัสแผนก</div></th>>
        </tr>
        <?php
          while ($row = mysql_fetch_array($result)){
         ?>
         <tr class="info">
           <td><?php echo $row['clinicdescribe']; ?></td>
           <td><?php echo $row['hn']; ?></td>
           <td><?php echo $row['an']; ?></td>
           <td><?php echo $row['fname']; ?></td>
           <td><?php echo $row['lname']; ?></td>
           <td><?php echo $row['weight']; ?></td>
           <td><?php echo $row['height']; ?></td>
           <td><?php echo $row['roomno']; ?></td>
           <td><?php echo $row['bedno']; ?></td>
           <td><?php echo $row['clinic']; ?></td>
         </tr>
       <?php } ?>
      </table>
      <?php
        $sql2 = "SELECT * FROM fpatient_info";
        $query2 = mysql_query($sql2, $connect2);
        $total_record = mysql_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
       ?>
      <nav align="center" aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="HN_patient.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
          <?php for($i=1;$i<=$total_page;$i++){ ?>
           <li><a href="HN_patient.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>
          <li class="page-item"><a class="page-link" href="HN_patient.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
        </ul>
      </nav>
    </div>
</div>
<?php include 'footer.php' ?>
