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
      <p>แก้ไขข้อมูลอาหารทางสายยาง</p>

  <div class="modal-body">
  <?php
  $id=$_GET['feed_id'];
  $name=$_GET['feed_name'];
  $id_stock = $_GET['id_stock'];
  $price = $_GET['price'];
  $res_id = $_GET['res_id'];
  $flag=0;
  if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $res=$_POST['store'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    @include('conn.php');
    $strSQL = "SELECT * FROM feed WHERE feed_id <> '$id'";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $gname= $objReSult["feed_name"];
     if($gname==$name){
       $flag=1;
     }
}
if($flag==0){
  @include('conn.php');
  $insert = "UPDATE feed  SET  feed_name='$name',res_id='$res',id_stock2 = '$stock',price = '$price' WHERE feed_id='$id'";
       $query = mysql_query($insert,$connect1);
            echo( "<script> alert('แก้ไขข้อมูลสำเร็จ');
            window.location='feed.php';</script>");


  if(!$insert){
   echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
       </script>");
  }
}
  }

    ?>
         <form method="POST" action="#" onsubmit="return confirm('ต้องการแก้ไขข้อมูลนี้?');">

                    <h4> รหัสอาหารทางสายยาง &nbsp;: &nbsp;<input type="text" name="id" value="<?php echo $id ; ?>" readonly ></h4>
                    <h4> ชื่ออาหารทางสายยาง &nbsp;: &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}" value="<?php echo $name; ?>"><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>
                    <h4>ประเภทวัตถุดิบ&nbsp; :  &nbsp;&nbsp;
                      <select name="stock" required>
                        <option value="MT-06"  selected>อาหารทางสายยาง</option>
                     </select>
                     <font color="red">&nbsp;*</font>
                    </h4>
                    <?php
                       $strSQL = "SELECT * FROM restaurant where type = 'FYST02'";
                       $objQuery = mysql_query($strSQL, $connect1);
                    ?>
                    <h4> ตัวแทนจำหน่ายอาหารทางสายยาง &nbsp;: &nbsp;
                      <select name = "store" required>
                        <option value=""  disabled selected>------กรุณาเลือกร้านค้า-----</option>
                      <?php while ($objReSult = mysql_fetch_array($objQuery)) {
                        if ($objReSult['res_id'] == $res_id) {
                          $select = "selected";
                        }
                        else {
                          $select = "";
                        }
                        ?>
                        <option value="<?php echo $objReSult['res_id'];?>" <?php echo $select; ?> >
                        <?php echo $objReSult['res_name'];?>
                        </option>
                      <?php }?>
                      </select><font color="red"> &nbsp;*</font>
                    </h4>
                    <h4>
                      ราคาต่อหน่วย : <input type="number" name="price" value="<?php echo $price; ?>"> บาท<font color="red"> &nbsp;*</font>
                    </h4>

         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit"
            >&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="feed.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการแก้ไขข้อมูลนี้?')">ยกเลิก</button></a>
        </form>
</div>
 </div>
  </div>

<?php
@include('conn.php');
$strSQL = "SELECT * FROM feed a join restaurant b on a.res_id = b.res_id JOIN stock ON a.id_stock2 = stock.id_stock where feed_name like '%$see%' order by feed_id";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
?>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสอาหารทางสายยาง</div></th>
    <th><div align="center">ชื่ออาหารทางสายยาง</div></th>
    <th><div align="center">ร้านค้า</div></th>
    <th><div align="center">ประเภทวัตถุดิบ</div></th>
    <th><div align="center">ราคาต่อหน่วย</div></th>
   <!-- <th><div align="center">แก้ไข</div></th>-->

  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["feed_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["feed_name"];?></div></td>
  <td><div align = "left"><? echo $objReSult["res_name"];?></div></td>
  <td><div align = "left"><? echo $objReSult["name_stock"];?></div></td>
  <td><div align = "left"><? echo $objReSult["price"];?></div></td>
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
