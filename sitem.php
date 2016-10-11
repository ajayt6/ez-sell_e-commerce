<html>
<body>
<?php
include("connect.php");
$icode=$_POST["ichoice"];
$item=pg_query($conn,"select * from item where item_code='$icode';");
include("itdetails.php");
$icat=pg_fetch_result($item,0,'category');
$itdetails2=pg_query($conn,"select * from $icat where item_code='$icode';");
$icategory=$icat;
$path=pg_fetch_result($item,0,'photo');
$choice=$icode;
include("itdetails2.php");
echo "<form action='account.php' method='post'>
<br><input type='submit' value='Go Back!' />
</form>";

pg_close($conn);
?>
</body>
</html>
