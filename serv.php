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
			 <h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>
      <p>ข้อมูลการจัดส่งอาหาร<p>
		</div>
</div>
<div class="container">
<?php
@include('conn.php');
$strSQL = "SELECT * FROM order_food inner join type_food on order_food.id_type = type_food.id_type";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
?>
<table class="table table-striped table-bordered">
	<tr class="warning">
		<th><div align="center">ID ORDER</div></th>
		<th><div align="center">AMOUNT</div></th>
    <th><div align="center">AMOUNT EXTRA</div></th>
    <th><div align="center">EXTRA DETAIL</div></th>
    <th><div align="center">ID TYPE</div></th>
    <th><div align="center">TYPE ORDER</div></th>
	</tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
	# code...
?>
	<tr class ="info">
	<td><div align = "center"><?php echo $objReSult["id_order"];?></div></td>
	<td><div align = "center"><? echo $objReSult["amount"];?></div></td>
  <td><div align = "center"><? echo $objReSult["amount_extra"];?></div></td>
  <td><div><? echo $objReSult["extra_detail"];?></div></td>
  <td><div align = "center"><? echo $objReSult["id_type"];?></div></td>
  <td><div align = "center"><? echo $objReSult["type_name"];?></div></td>
	</tr>
	<?
}
?>
</table>
</div>

<div class="row">
  <div class="col-md-2 col-xs-2"></div>
  <div class="col-md-2 col-xs-2"></div>
  <div class="col-md-2 col-xs-2"></div>
  <div class="col-md-2 col-xs-2"></div>
  <div class="col-md-2 col-xs-2">
    <input type="submit" name="modal" id="submit" class="btn btn-lg btn-success" value="บันทึกข้อมูล" data-toggle="modal" href="#myModal1">
  </div>
</div>

<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</a></p>
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

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">จำนวนอาหาร</h4>
      </div>
<!-- สั่งอาหาร -->


      <div class="modal-body">
        <div class="row">
          <div class="col-md-5 col-xs-5">
           <h4 class="modal-title">อาหารธรรมดา (สามัญ)</h4><br>
          จำนวนอาหาร : &nbsp;<input type="text" name="amount_order" placeholder="จำนวนอาหาร"> <br><br>

          <form method="POST">
             เฉพาะโรค :
              <select id="dep" name="dep"     onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
              <option value="o">-------แสดงทั้งหมด-------</option>
           <br><br>

                <?
                    @include('conn.php');
                    $strSQL = "SELECT DISTINCT id_type, type_name FROM type_food";
                    $objQuery = mysql_query($strSQL, $connect1) or die("Error Query [".$strSQL."]");
                    while ($objReSult = mysql_fetch_array($objQuery)) {

                  ?>
                     <option value=<?echo $objReSult["id_type"];?>><?echo $objReSult["type_name"];?></option>
                     <?
                      }
                     ?>
                </select><br><br>


                 มื้อ<br><div class="radio">
          <label><input type="radio" name="optradio">เช้า</label>
          </div>
          <div class="radio">
          <label><input type="radio" name="optradio">กลางวัน</label>
          </div>
         <div class="radio">
          <label><input type="radio" name="optradio">เย็น</label>
          </div>

          </div>
          <div class="col-md-5 col-xs-5">
          จำนวนอาหารพิเศษ &nbsp;<input type="text" name="amount_order_extra" placeholder="จำนวนอาหารพิเศษ">
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <input type="submit" class="btn btn-success btn-lg" name="submit" value="OK">
        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>
