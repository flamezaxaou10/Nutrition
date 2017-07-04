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
          $id_output = $_GET['idoutputmat'];
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="GET" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการเบิก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $id_output; ?><input type="hidden" name="id" value="<?php echo $id_output; ?>" readonly=""></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;: &nbsp;<? echo $_SESSION["Username"];?></h4>
                      <h4>
                        <script type="text/javascript">
                            function selectmat(el){
                              var text = el.options[el.selectedIndex].value;
                              var count0 = text.substring(0, 5);
                              document.getElementById("count").innerHTML = text;
                            }
                        </script>
                        รหัสวัตถุดิบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="mat_id" required onchange="selectmat(this);">
                          <option >เลือกประเภทวัตถุดิบ</option>
                          <?php

                              $sql = "SELECT DISTINCT * FROM stock";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php $row['id_stock']; ?>" >
                                  <?php echo $row['id_stock']; ?> // <?php echo $row['name_stock']; ?>
                                </option>
                          <?php
                              }
                           ?>
                        </select>
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="mat_to_stock.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <table class="table table-striped table-bordered">
    <tr class="warning">
      <th>ลำดับ</th>
      <th>รหัสวัตถุดิบ</th>
      <th>ชื่อวัตถุดิบ</th>
      <th>จำนวน</th>
      <th>หน่วยนับ</th>
      <th>จำนวนที่เบิก</th>
      <th>เบิก</th>
    </tr>
  </table>
</div>
<?php
    if($_POST){
      $mat_id = $_GET['mat_id'];
      $sql = "SELECT * FROM stock_detail WHERE mat_id = '$mat_id' GROUP BY mat_id";
    }
 ?>
<?php include 'footer.php' ?>
