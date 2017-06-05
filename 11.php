<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
	<?php
		$objConnect = mysql_connect("localhost","root","123456789") or die(mysql_error());
		$objDB = mysql_select_db("cpa");
		$strSQL = "SELECT * FROM users";
		$objQuery = mysql_query($strSQL);
		echo"<table border=\"1\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";
		$intRows = 0;
		while($objResult = mysql_fetch_array($objQuery))
		{
			echo "<td>";
			$intRows++;
	?>
			<center>
        <?php echo "<tr>";?>
        <?php echo "<td>";?>
				<?php echo $objResult["id_user"];?>
				<?php echo $objResult["psw_user"];?>
        <?php echo "</td>";?>
        <?php echo "</tr>";?>
				<br>
			</center>
	<?php
			echo"</td>";
			if(($intRows)%2==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";
	?>
</body>
</html>
<?php
mysql_close($objConnect);
?>
