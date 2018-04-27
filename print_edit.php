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
      <p>แก้ไขข้อมูลการจัดเมนูอาหาร</p>
      <br>

      <div style="float:left; font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ : &nbsp;</div><div style="float:left; font-size: 1.2em;">&nbsp;
           <?php
           $strDate=$_POST['daytime'];
             $strYear = date("Y",strtotime($strDate))+543;
             $strMonth= date("n",strtotime($strDate));
             $strDay= date("j",strtotime($strDate));
             $strDays= date("l",strtotime($strDate));
             $strDayCut = Array("Monday"=>"วันจันทรที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกรที่","Saturday"=>"วันเสารที่","Sunday"=>"วันอาทิตย์ที่");
             $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
             $strMonthThai=$strMonthCut[$strMonth];
             $strDaysThai = $strDayCut[$strDays];
             $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;
 ?>
     <? echo $date;?></div>
<br />
<div style="float:left; font-size: 1.2em;">เจ้าหน้าที่</div>
<div style="float:left; font-size: 1.2em;">&nbsp;</div>
<br />

<div style="float:left; font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าหน้าที่ : &nbsp; </div>
<div style="float:left; font-size: 1.2em;">&nbsp;
  <?php echo $_SESSION["fnname"];?>&nbsp;<?php echo $_SESSION["lnname"];?>
</div>
<br />
<form method="post" action="print_edit_re.php">

<?php

  $day= $_POST["daytime"];
  ?>
  <input type="hidden" name="daytime" value="<?php echo $day; ?>">
  <?php

@include('conn.php');
$strSQL = "SELECT * FROM detailmenu where dm_date='$day'";
$objQuery = mysql_query($strSQL, $connect1);
$num=mysql_num_rows($objQuery);
if($num==0){
  echo"<script language=\"JavaScript\">";

echo"alert('ไม่มีข้อมูลในระบบ')";

echo"</script>";
echo( "<script>window.location='editdetailorder.php';</script>");
}
while ($objReSult = mysql_fetch_array($objQuery)) {
  $p=$objReSult['print'];
  $m1=$objReSult['mspec'];
  $s1=array();
  $str="";
  for($i=0;$i<strlen($m1);$i++){
    if($m1[$i]==" "){
      array_push($s1,$str);
      $str="";
    }
    else{
      $str=$str.$m1[$i];
    }
  }
    array_push($s1,$str);

    $m2=$objReSult['msta'];
    $s2=array();
    $str="";
    for($i=0;$i<strlen($m2);$i++){
      if($m2[$i]==" "){
        array_push($s2,$str);
        $str="";
      }
      else{
        $str=$str.$m2[$i];
      }
    }
      array_push($s2,$str);



      $m3=$objReSult['maut'];
      $s3=array();
      $str="";
      for($i=0;$i<strlen($m3);$i++){
        if($m3[$i]==" "){
          array_push($s3,$str);
          $str="";
        }
        else{
          $str=$str.$m3[$i];
        }
      }
        array_push($s3,$str);

        $m4=$objReSult['lpspec'];
        $s4=array();
        $str="";
        for($i=0;$i<strlen($m4);$i++){
          if($m4[$i]==" "){
            array_push($s4,$str);
            $str="";
          }
          else{
            $str=$str.$m4[$i];
          }
        }
          array_push($s4,$str);


          $m5=$objReSult['lpsta'];
          $s5=array();
          $str="";
          for($i=0;$i<strlen($m5);$i++){
            if($m5[$i]==" "){
              array_push($s5,$str);
              $str="";
            }
            else{
              $str=$str.$m5[$i];
            }
          }
            array_push($s5,$str);


            $m6=$objReSult['lpaut'];
            $s6=array();
            $str="";
            for($i=0;$i<strlen($m6);$i++){
              if($m6[$i]==" "){
                array_push($s6,$str);
                $str="";
              }
              else{
                $str=$str.$m6[$i];
              }
            }
              array_push($s6,$str);


              $m7=$objReSult['lsspec'];
              $s7=array();
              $str="";
              for($i=0;$i<strlen($m7);$i++){
                if($m7[$i]==" "){
                  array_push($s7,$str);
                  $str="";
                }
                else{
                  $str=$str.$m7[$i];
                }
              }
                array_push($s7,$str);



                $m8=$objReSult['lssta'];
                $s8=array();
                $str="";
                for($i=0;$i<strlen($m8);$i++){
                  if($m8[$i]==" "){
                    array_push($s8,$str);
                    $str="";
                  }
                  else{
                    $str=$str.$m8[$i];
                  }
                }
                  array_push($s8,$str);




                  $m9=$objReSult['lsaut'];
                  $s9=array();
                  $str="";
                  for($i=0;$i<strlen($m9);$i++){
                    if($m9[$i]==" "){
                      array_push($s9,$str);
                      $str="";
                    }
                    else{
                      $str=$str.$m9[$i];
                    }
                  }
                    array_push($s9,$str);


                    $m10=$objReSult['epspec'];
                    $s10=array();
                    $str="";
                    for($i=0;$i<strlen($m10);$i++){
                      if($m10[$i]==" "){
                        array_push($s10,$str);
                        $str="";
                      }
                      else{
                        $str=$str.$m10[$i];
                      }
                    }
                      array_push($s10,$str);

                      $m11=$objReSult['epsta'];
                      $s11=array();
                      $str="";
                      for($i=0;$i<strlen($m11);$i++){
                        if($m11[$i]==" "){
                          array_push($s11,$str);
                          $str="";
                        }
                        else{
                          $str=$str.$m11[$i];
                        }
                      }
                        array_push($s11,$str);


                        $m12=$objReSult['epaut'];
                        $s12=array();
                        $str="";
                        for($i=0;$i<strlen($m12);$i++){
                          if($m12[$i]==" "){
                            array_push($s12,$str);
                            $str="";
                          }
                          else{
                            $str=$str.$m12[$i];
                          }
                        }
                          array_push($s12,$str);

                          $m13=$objReSult['esspec'];
                          $s13=array();
                          $str="";
                          for($i=0;$i<strlen($m13);$i++){
                            if($m13[$i]==" "){
                              array_push($s13,$str);
                              $str="";
                            }
                            else{
                              $str=$str.$m13[$i];
                            }
                          }
                            array_push($s13,$str);


                            $m14=$objReSult['essta'];
                            $s14=array();
                            $str="";
                            for($i=0;$i<strlen($m14);$i++){
                              if($m14[$i]==" "){
                                array_push($s14,$str);
                                $str="";
                              }
                              else{
                                $str=$str.$m14[$i];
                              }
                            }
                              array_push($s14,$str);




                              $m15=$objReSult['esaut'];
                              $s15=array();
                              $str="";
                              for($i=0;$i<strlen($m15);$i++){
                                if($m15[$i]==" "){
                                  array_push($s15,$str);
                                  $str="";
                                }
                                else{
                                  $str=$str.$m15[$i];
                                }
                              }
                                array_push($s15,$str);
$comment=$objReSult['comment'];
}
 ?>
  <div class="modal-body">
<input type="hidden" name="print" value="<?php echo $p ;?>">
        <table class="table table-striped table-bordered" border="1" width="100%">
          <tr class="warning">
            <?php

            date_default_timezone_set('Africa/Lagos');
            $date=date("Y-m-d");


            if($date>$_POST['daytime']){
              ?><center><h4><font color=red>***ข้อมูลก่อนหน้าอาจถูกนำไปใช้แล้ว***</font></h1></center>

                <?php
            } ?>
            <th></th><th></th><th><div align="center">พิเศษ</div></th><th><div align="center">สามัญ</div</th><th><div align="center">เจ้าหน้าที่</div</th>
          </tr>
          <tr class ="info">
            <td align="center"><b>เช้า</td>
            <td></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list1[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m1);$z++){if($s1[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list2[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m2);$z++){if($s2[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list3[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m3);$z++){if($s3[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td rowspan="2" align="center"><b>กลางวัน</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                    <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list4[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m4);$z++){if($s4[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list5[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m5);$z++){if($s5[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list6[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m6);$z++){if($s6[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                      <?php
                      $i = 0;
                    $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list7[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m7);$z++){if($s7[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list8[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m8);$z++){if($s8[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      </td>
          </tr>
          <tr class ="info">
            <td td rowspan="2" align="center"><b>เย็น</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                      <?php
                      $i = 0;
                    $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list10[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m10);$z++){if($s10[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP001'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list11[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m11);$z++){if($s11[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td rolspan=2>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list12[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m12);$z++){if($s12[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                     <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list13[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m13);$z++){if($s13[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
            <td>
                      <?php
                      $i = 0;
                      $strSQL = "SELECT * FROM menu WHERE id_type='TYP002'";
                      $objQuery = mysql_query($strSQL, $connect1);
                      while ($objReSult = mysql_fetch_array($objQuery)) {
                      ?>
                     <input type="checkbox" name="check_list14[]" value="<?php echo $objReSult['menu_name'];?>" <?php for($z=0;$z<strlen($m14);$z++){if($s14[$z]==$objReSult['menu_name']) echo "checked";} ?>> <label style="font-size: 13px;"><?php echo $objReSult['menu_name'];?></label><br/>
                     <?php $i++;
                     }?></td>
                     <td></td>
          </tr>
        </table>
        <h4>หมายเหตุ</h4>
        <textarea class="form-control" rows="3" id="detail" name="deta"  data-validation="required"><?php echo $comment; ?></textarea><br />
        <div class="text-right">
          <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit"> <a href="insert_order_menu.php">
          <button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
        </div>

      </form>

    </div>
   </div>
 </div>

 <?php include 'footer.php'; ?>
