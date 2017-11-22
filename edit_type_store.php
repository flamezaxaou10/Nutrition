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
       <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
       <br>
      <p>จัดการข้อมูลประเภทร้านค้า</p>

  <div class="modal-body">
  <?php
  $id=$_GET['id'];
  $name=$_GET['id2'];
  $flag=0;
  if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    @include('conn.php');
    $strSQL = "SELECT * FROM typestore WHERE type_id <> '$id'";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $gname= $objReSult["type_name"];
     if($gname==$name){
       $flag=1;
     }
}
if($flag==0){
  @include('conn.php');
  $insert = "UPDATE typestore  SET  type_name='$name' WHERE type_id='$id'";
       $query = mysql_query($insert,$connect1);
            echo( "<script> alert('แก้ไขข้อมูลสำเร็จ');
            window.location='typestore.php';</script>");


  if(!$insert){
   echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
       </script>");
  }
}
  }

    ?>
         <form method="POST" action="#" onsubmit="return confirm('ต้องการแก้ไขข้อมูลนี้?');">

                    <h4> รหัสประเภทร้านค้า : &nbsp;<input type="text" name="id" value="<?php echo $id ; ?>" readonly ></h4>
                    <h4> ชื่อประเภทร้านค้า &nbsp;&nbsp;: &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" value="<?php echo $name; ?>"><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>

         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit"
            onclick="submitModal()"">&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="typestore.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไขข้อมูลนี้?')">ยกเลิก</button></a>
        </form>
</div>
 </div>
  </div>

<?php
@include('conn.php');
$strSQL = "SELECT * FROM typestore order by type_id";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสประเภทร้านค้า</div></th>
    <th><div align="center">ชื่อประเภทร้านค้า</div></th>
   <!-- <th><div align="center">แก้ไข</div></th>-->

  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["type_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["type_name"];?></div></td>
  <!--<td><div align = "center"><a href='edit_mat.php?id="<? echo $objReSult['mat_id']?>"&id2="<? echo $objReSult['mat_name']?>"' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>-->

    </tr>
  <?
}

?>
</table>
</div>




<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์  จันทร์กระจ่าง</a></p>
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>






</body>
</html>
