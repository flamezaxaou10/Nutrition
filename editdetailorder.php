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
      <p>ข้อมูลการจัดรายการอาหาร</p>
      <br>
<form method="post" action="#">
      <div style="float:left; font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ : &nbsp;</div><div style="float:left; font-size: 16px;">&nbsp;<input type="date" name="daytime" size = "8" value="<?php echo $_POST['daytime']; ?>"><font color="red"> &nbsp;</font><br></div><input type="submit" class="btn btn-success" value="ค้นหา" name = "submit2">
      <a href="insert_order_menu.php"><button type="button" class="btn btn-danger" data-dismiss="modal">ย้อนกลับ</button></a>
</form>
<br />

<form method="post" action="print_edit.php">

<?php
if(isset($_POST["submit2"])){
  $day= $_POST["daytime"];?>
  <div id="print_table">

    <?php
  $strDate=$day;
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strDays= date("l",strtotime($strDate));
      $strDayCut = Array("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monday"=>"วันจันทรที่","Tuesday"=>"วันอังคารที่","Wednesday"=>"วันพุธที่","Thursday"=>"วันพฤหัสบดีที่","Friday"=>"วันศุกรที่","Saturday"=>"วันเสารที่","Sunday"=>"วันอาทิตย์ที่");
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$strMonth];
      $strDaysThai = $strDayCut[$strDays];
      $date=$strDaysThai." ".$strDay." ".$strMonthThai." ".$strYear;

  ?>
    <div style="float:left; font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ : &nbsp;</div>  <div style="float:left; font-size: 16px;">&nbsp;<? echo $date;?></div>
<br /><br />
  <div style="float:left; font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าหน้าที่ : &nbsp;</div><div style="float:left; font-size: 16px;">&nbsp;
    <?php echo $_SESSION["fnname"];?>&nbsp;<?php echo $_SESSION["lnname"];?>
  </div>
  <br />

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

        <table class="table table-striped table-bordered" border="1" width="100%">
          <tr class="warning">
            <th><div align="center">มื้ออาหาร</th><th><div align="center">ประเภทอาหาร</th><th><div align="center">พิเศษ</th><th><div align="center">สามัญ</th><th><div align="center">เจ้าหน้าที่</th>
          </tr>
          <tr class ="info">
            <td align="center"><b>เช้า</td>
            <td></td>
            <td>
                      <?php
                      for($i=0;$i<count($s1);$i++){
                        echo $s1[$i]."<br>";

                      }
                    ?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s2);$i++){
                        echo $s2[$i]."<br>";

                      }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s3);$i++){
                        echo $s3[$i]."<br>";

                      }?></td>
          </tr>
          <tr class ="info">
            <td rowspan="2" align="center"><b>กลางวัน</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                    <?php
                    for($i=0;$i<count($s4);$i++){
                      echo $s4[$i]."<br>";

                    }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s5);$i++){
                        echo $s5[$i]."<br>";

                      }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s6);$i++){
                        echo $s6[$i]."<br>";

                      }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                      <?php
                      for($i=0;$i<count($s7);$i++){
                        echo $s7[$i]."<br>";

                      }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s8);$i++){
                        echo $s8[$i]."<br>";

                      }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s9);$i++){
                        echo $s9[$i]."<br>";

                      }?></td>
          </tr>
          <tr class ="info">
            <td td rowspan="2" align="center"><b>เย็น</td>
            <td align="center"><b>ธรรมดา</td>
            <td>
                      <?php
                      for($i=0;$i<count($s10);$i++){
                        echo $s10[$i]."<br>";

                      }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s11);$i++){
                        echo $s11[$i]."<br>";

                      }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s12);$i++){
                        echo $s12[$i]."<br>";

                      }?></td>
          </tr>
          <tr class ="info">
            <td align="center"><b>อ่อน</td>
            <td>
                     <?php
                     for($i=0;$i<count($s13);$i++){
                       echo $s13[$i]."<br>";

                     }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s14);$i++){
                        echo $s14[$i]."<br>";

                      }?></td>
            <td>
                      <?php
                      for($i=0;$i<count($s15);$i++){
                        echo $s15[$i]."<br>";

                      }?></td>
          </tr>
        </table>
        <h4>หมายเหตุ</h4>
        <textarea class="form-control" rows="3" id="detail" name="deta"  readonly=""><?php echo $comment; ?></textarea><br />
        <div class="text-right"><input type="submit" class="btn btn-success" value="แก้ไขข้อมูล" name = "submit"> </div>
      </div>
      </div>

      </form>

<?php
}
 ?>
      </div>
    </div>
  </div>
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
