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
      <p>ข้อมูลอาหารทางสายยาง</p>

  <div class="modal-body">
  <?php
  $perpage = 20;
  if (isset($_GET['page']) && $_GET['page'] != 0) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }
  $start = ($page - 1) * $perpage;
  $flag=0;
  if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $feed = $_POST['store'];
    $id_stock = $_POST['stock'];
    $price = $_POST['price'];
    @include('conn.php');

    $strSQL = "SELECT * FROM feed";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $gname= $objReSult["feed_name"];
     $rname= $objReSult["res_id"];
     if($gname==$name&&$rname==$feed){
       $flag=1;
     }
}
if($flag==0){
  @include('conn.php');
  $insert = "INSERT INTO feed  VALUES  ('$id','$name','$feed','$id_stock','$price')";
       $query = mysql_query($insert,$connect1);
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');</script>");


  if(!$insert){
   echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
       </script>");
  }
}
  }
    @include('conn.php');
    $strSQL = "SELECT MAX(feed_id) FROM feed";
    $objQuery = mysql_query($strSQL, $connect1);
    while ($objReSult = mysql_fetch_array($objQuery)) {
     $result= $objReSult["MAX(feed_id)"];
     $ina="";
       for($a=0;$a<Strlen($result);$a++){
       if($a>=2)$ina =$ina.intval($result[$a])  ;
       }
       $id= "F-".sprintf("%02d", $ina+1);
}
    ?>
         <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">

                    <h4> รหัสอาหารทางสายยาง : &nbsp;<input type="text" name="id" value="<?php echo $id; ?>" readonly=""></h4>
                    <h4> ชื่ออาหารทางสายยาง &nbsp;&nbsp;: &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"><font color="red">&nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่ออาหารทางสายยางนี้มีในระบบแล้ว</font>"; ?></h4>
                    <h4>ประเภทวัตถุดิบ :  &nbsp;&nbsp;
                      <select name="stock">
                        <option>------กรุณาเลือกประเภทวัตถุดิบ-----</option>
                    <?php
                      $sql = "SELECT * FROM stock";
                      $result = mysql_query($sql, $connect1);
                      while ($row = mysql_fetch_array($result)){
                    ?>
                      <option value="<?php echo $row['id_stock']; ?>"><?php echo $row['name_stock']; ?></option>
                    <?php
                      }
                     ?>
                     </select>
                     <font color="red">&nbsp;*</font>
                    </h4>
                     <?php
                       $strSQL = "SELECT * FROM restaurant where type = '2'";
                       $objQuery = mysql_query($strSQL, $connect1);
                    ?>
                    <h4> ตัวแทนจำหน่ายอาหารทางสายยาง :
                      <select name = "store">
                        <option>------กรุณาเลือกตัวแทนจำหน่าย-----</option>
                      <?
                    @include('conn.php');

                    $strSQL = "SELECT * FROM restaurant where type='FYST02'";
                    $objQuery = mysql_query($strSQL, $connect1);

                    while ($objReSult = mysql_fetch_array($objQuery)) {
                      if ($_POST["dep"] == $objReSult['res_id']) {
                        # code...
                        $sel = "selected";
                      }
                      else
                      {
                        $sel = "";
                      }
                  ?>
                <option value="<? echo $objReSult["res_id"];?>" <? echo $sel; ?> > <? echo $objReSult["res_name"];?></option>
                <?
                }
                ?>
                </select><font color="red">&nbsp;*</font>
                </h4>
                <h4>
                  ราคาต่อหน่วย : <input type="number" name="price" value=""> บาท<font color="red">&nbsp;*</font>
                </h4>

                     <!--<input type="submit" name="search" value="Search"/>-->
                  </h4>
         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"
            onclick="submitModal()">&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>

        </form>
        </div>
  </div>
  </div>
  <form method="post" action="#" class="text-right">

  <font color=white>ค้นหาจากชื่ออาหารทางสายยาง : </font></label> <input type="text" name="sen" >
   <!--<input type="hidden" name="selected_text" id="selected_text" value="" />-->

     <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
</form>
<?php
@include('conn.php');
$see=$_POST["sen"];
$strSQL = "SELECT * FROM feed a join restaurant b on a.res_id = b.res_id JOIN stock ON a.id_stock2 = stock.id_stock where feed_name like '%$see%' order by feed_id  LIMIT {$start},{$perpage}";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
$num=mysql_num_rows($objQuery);
if($num==0){
  echo"<script language=\"JavaScript\">";

echo"alert('ไม่พบข้อมูล')";

echo"</script>";

}
?>
<br>
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสอาหารทางสายยาง</div></th>
    <th><div align="center">ชื่ออาหารทางสายยาง</div></th>
    <th><div align="center">ตัวแทนจำหน่ายอาหารทางสายยาง</div></th>
    <th><div align="center">ประเภทวัตถุดิบ</div></th>
    <th><div align="center">ราคาต่อหน่วย</div></th>
    <th><div align="center">แก้ไขข้อมูล</div></th>
    <th><div align="center">ลบข้อมูล</div></th>

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
  <td><? echo $objReSult["price"];?></td>
  <td><div align = "center">
    <a href=edit_feed2.php?feed_id=<?php echo $objReSult['feed_id']; ?>&feed_name=<?php echo $objReSult['feed_name']; ?>&id_stock=<?php echo $objReSult['id_stock']; ?>&price=<?php echo $objReSult['price']; ?>
    onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b>
    </a>
  </td>
  <td><div align = "center"><a href='delete_feed2.php?id=<? echo $objReSult['feed_id'];?>'
  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>

    </tr>
  <?
}

?>
</table>
<?php
  $sql2 = "SELECT * FROM feed";
  $query2 = mysql_query($sql2, $connect1);
  $total_record = mysql_num_rows($query2);
  $total_page = ceil($total_record / $perpage);
 ?>
<nav align="center" aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="feed.php?page=<?php echo ($page-1); ?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
    <?php for($i=1;$i<=$total_page;$i++){ ?>
     <li><a href="feed.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    <li class="page-item"><a class="page-link" href="feed.php?page=<?php echo ($page+1); ?>" aria-label="Next"><span aria-hidden="true">>></span></a></li>
  </ul>
</nav>
</div>



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
<?php include 'footer.php'; ?>
