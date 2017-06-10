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
          $id_output = $_GET['id'];
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="<?php echo $id_output; ?>" readonly=""></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;: &nbsp;<input type="text" name="username" value="<? echo $_SESSION["Username"];?>" readonly=""></h4>
                      <h4> วันที่เบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input type="date" name="date" value="" required=""></h4>
           <div class="modal-footer">
             <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="mat_to_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<?php
  if ($_POST){
    $id_output = $_POST['id'];
    $date = $_POST['date'];



    header("location:out_to_stock.php?id=$id_output");
  }
 ?>

<div class="container">
  <div class="jumbotron">
    <h4>ประวัติการสั่งซื้อวัตถุดิบ</h4>
    <table class="table table-striped table-bordered">
      <tr class="warning">
        <th><div align="center">วันที่</div></th>
        <th><div align="center">รหัสใบสั่งซื้อ</div></th>
        <th><div align="center">ชื่อผู้สั่งซื้อ</div></th>
        <th><div align="center">ชื่อร้านค้า</div></th>
        <th><div align="center">ราคาทั้งหมด</div></th>
        <th><div align="center">แก้ไขข้อมูล</div></th>
        <th><div align="center">พิมพ์</div></th>
        <th><div align="center">ข้อมูล</div></th>
      </tr>
      <?php

          while ($objReSult = mysql_fetch_array($objQuery)) {
          $aa = $objReSult["id_mat"];
          $strDate=date('d-m-Y', strtotime($objReSult["date"]));
           $strYear = date("Y",strtotime($strDate))+543;
           $strMonth= date("n",strtotime($strDate));
           $strDay= date("j",strtotime($strDate));
           $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
           $strMonthThai=$strMonthCut[$strMonth];
           $date=$strDay." ".$strMonthThai." ".$strYear;

       ?>
       <tr class ="info">
       <td><div align = "center"><?php echo $date;?></div></td>
       <td><div align = "center"><? echo $objReSult["id_mat"];?></div></td>
       <td><div align = "center"><? echo $objReSult["user_name"];?></div></td>
       <td><div align = "center"><? echo $objReSult["res_name"];?></div></td>
       <td><div align = "right"><? echo number_format($objReSult["total_mat"],2);?></div></td>
       <?php
       if($objReSult["status"]==0){
        ?>
       <td><div align = "center"><a href="select_buymat.php?id=<? echo $objReSult['id_mat'];?>" onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
       <td><div align = "center"><p style="text-align:center;"><a href="suc_buymat.php?id=<? echo $objReSult['id_mat'];?>"><b><font color="blue"><img src='img/print.png' width=25></font></b></a></p></td>

      <?php
      }else{ ?>
      <td colspan=2><div align = "center"><img src='img/close.png' width=25></div></td>


        <?php
      }
      ?>
      <td><div align = "center"><a href="detailmat.php?id=<?php echo $aa ; ?>" ><img src='img/sssss.png' width=25></a></div></td>
      </tr>
      <?php
      } ?>
  </table>


  </div>
</div>
<?php include 'footer.php'; ?>
