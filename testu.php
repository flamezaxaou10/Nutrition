<!DOCTYPE html>
<html>
<head>
<style type="text/css">
@media print{
    *{display:none;}
    .print{display:block;}
}
</style>
</head>
<body>
<div>This is not printed</div>
<?php
while($row = mysql_fetch_array($result)){
    echo "<table class='print' border='2' style='width:100%'> ";
    // your code....
    echo "<table>";
}
?>
<a href="javascript:window.print()">Click to print</a>
</body>
</html>
