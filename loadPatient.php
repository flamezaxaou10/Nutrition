<?php
	 @include('conn.php');
	 $hn = $_GET['hn'];
	 if(isset($hn)){
	  $strSQL5 = "SELECT * FROM fpatient_info where hn = $hn";
      $objQuery5 = mysql_query($strSQL5, $connect2)or die(mysql_error());
      $objReSult5 = mysql_fetch_array($objQuery5);
      
      
      if(mysql_num_rows($objQuery5) > 0){
      	echo json_encode($objReSult5);
      }else
      	echo 'nothing';
	 }else{
	 	echo 'nothing';
	 }
?>