<html>
<body>
<?php
include("connect.php");
session_start();
$xcheck2=pg_query($conn," select * from item;");
for($row=0;$row<pg_num_rows($xcheck2);$row++)
{
if(!(strtotime(pg_fetch_result($xcheck2,$row,'last_bid_date'))>strtotime(date('Y-m-d'))))
{
$choice=pg_fetch_result($xcheck2,$row,'item_code');
//echo date('Y-m-d')."<br>";
//echo pg_fetch_result($xcheck2,0,'last_bid_date');
$dmod=pg_query($conn,"update item set bid_status='closed' where item_code='$choice';");
}
}
if(isset($_SESSION['user']))
{
$user=$_SESSION['user'];
$check=pg_query($conn,"select * from seller where roll_no='$user';");
if($check)
$item=pg_query($conn,"select * from item where item_code not in(select item_code from seller where roll_no='$user');");
else
$item=pg_query($conn,"select * from item;");
}
else
{
$item=pg_query($conn,"select * from item;");
}
echo "<form action='fbitem.php' method='post'>";
echo "<table border=3><tr><th>Item Code</th><th>Category</th><th>Item name</th><th>Base price</th><th>Highest Bid</th><th>Bid Status</th><th>photo</th><th>Last bid date</th><th>Transaction</th></tr>";
for($row=0;$row<pg_num_rows($item);$row++)
{
	include("itdetails.php");	
	echo "<tr><td>".$icode."</td><td>".$icategory."</td><td>".$iname."</td><td>".$bp."</td><td>".$bh."</td><td>".$bs."</td><td><img height=150 width=100 src='$path' /></td><td>".$idate."</td><td><input type='radio' value='$icode' name='choice' /></td></tr>";
}
echo "</table>";
echo "<br><input type='submit' value='buy' /></form>";
echo "<form action=";
if(isset($_SESSION['user']))
echo "'account.php'";
else
echo "'index.php'";
echo " method='post'>
<br><input type='submit' value='Go Back!' />
</form>";
pg_close($conn);

?>
</body>
</html>
