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
    <p>แก้ไขข้อมูลการรับเข้า</p>
    <?php
        $id_input = $_GET['id'];
        $str = "SELECT * FROM input_material WHERE id_inputmat =  '$id_input'";
        $restr = mysql_query($str,$connect1);
        $rowstr = mysql_fetch_array($restr);
     ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสการรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="<?php echo $id_input; ?>" readonly=""></h4>
                      <h4> วันที่การรับเข้า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="date" name="date" value="<?php echo $rowstr['date']; ?>" required><i style="color : red">*</i></h4>
                      <h4> รหัสเจ้าหน้าที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="username" value="<? echo $_SESSION["Username"];?>" readonly=""></h4>
                      <h4>
                        รหัสการสั่งซื้อ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                        <select class="" name="id_mat">
                          <?php
                              $sql = "SELECT * FROM buymeterial WHERE status = '0'";
                              $select = mysql_query($sql,$connect1);
                              while ($row = mysql_fetch_array($select)) {
                          ?>
                                <option value="<?php echo $row['id_mat'] ?>"><?php echo $row['id_mat'] ?> <?php echo $row['res_name'] ?></option>
                          <?php
                              }
                           ?>
                        </select><i style="color : red">*</i>
                      </h4>
           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="stockanddetail.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<?php
  if($_POST){
    $date = $_POST['date'];.
    $user  = $_POST['username'];
    $id_mat = $_POST['id_mat'];

    $update = "UPDATE input_material SET date = '$date',id_mat = '$id_mat' ,username = '$user' WHERE id_inputmat = '$id_input'";
    mysql_query($update,$connect1);
    header("Location:edit_mat_to_stock_con.php?id=$id_input");
  }
 ?>
<?php include 'footer.php' ?>
