<?php
	 @include('conn.php');
	 $hn = $_GET['hn'];
   $eats = $_GET['eats'];
	 if(isset($hn)){
	  $strSQL5 = "SELECT * FROM order_food where hn = $hn AND eats = $eats ORDER BY id DESC" ;
      $objQuery5 = mysql_query($strSQL5, $connect1)or die(mysql_error());
      $objReSult5 = mysql_fetch_array($objQuery5);


      if(mysql_num_rows($objQuery5) > 0){
      	echo json_encode($objReSult5);
      }else
      	echo 'nothing';
	 }else{
	 	echo 'nothing';
	 }
?>
