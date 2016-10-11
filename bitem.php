<html>
<body>
<?php
session_start();
include("connect.php");
$user=$_SESSION['user'];
$icode=$_POST["ichoice"];
$item=pg_query($conn,"select * from item where item_code='$icode';");
$isbuy=pg_query($conn,"select roll_no from buyer where roll_no in(select roll_no from item as t,buyer where roll_no='$user' and bid_status='closed' and t.item_code='$icode' and t.item_code=buyer.item_code and bid=bid_highest);");
$user1=pg_fetch_result($isbuy,0,'roll_no');
$icat=pg_fetch_result($item,0,'category');
$itdetails2=pg_query($conn,"select * from $icat where item_code='$icode';");
if(pg_fetch_result($item,0,'bid_status')=='closed')
{
if($user==$user1)
{
echo "Congrats you have bought this item!<br>";
$icategory=$icat;
$path=pg_fetch_result($item,0,'photo');
$choice=$icode;
include("itdetails2.php");
}
else
echo "This item has been sold to the highest bidder.<br>"; 
}
else
{
$icategory=$icat;
$path=pg_fetch_result($item,0,'photo');
$choice=$icode;
include("itdetails2.php");
$_SESSION['choice']=$icode;
echo "Place new bid if interested:";
echo "<form action='account.php' method='post'><input type='text' name='nbid' /><input type='submit' value='Confirm' /></form>";
}
include("itdetails.php");

echo "<form action='account.php' method='post'>
<br><input type='submit' value='Go Back!' />
</form>";

pg_close($conn);
?>
</body>
</html>
