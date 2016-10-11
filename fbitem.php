<html>
<body>
<?php
session_start();
include("connect.php");
if(!isset($_SESSION["user"]))
{
echo "You have to first login to buy an item!";
echo '<br><form action="account.php" method="post">
Username:<input type="text" name="user"/><br>
Password:<input type="password" name="pass" /><br>
<input type="submit" value="Login!" />
</form>';
}
else
{

$user=$_SESSION["user"];
$choice=$_POST['choice'];
$xcheck=pg_query($conn," select * from buyer where item_code='$choice' and roll_no='$user';");
$xcheck2=pg_query($conn," select * from item where item_code='$choice';");
$status=pg_fetch_result($xcheck2,0,'bid_status');
if($status=='open')
{
$path=pg_fetch_result($xcheck2,0,'photo');
$icategory=pg_fetch_result($xcheck2,0,'category');
//echo $icategory;
$itdetails2=pg_query($conn,"select * from $icategory where item_code='$choice';"); 
$yop=pg_fetch_result($itdetails2,0,'yop');
$author=pg_fetch_result($itdetails2,0,'author');
$name=pg_fetch_result($itdetails2,0,'name');
$cd=pg_fetch_result($itdetails2,0,'condition');
$desc=pg_fetch_result($itdetails2,0,'description');
$ed=pg_fetch_result($itdetails2,0,'edition');
$color=pg_fetch_result($itdetails2,0,'color');
$spec=pg_fetch_result($itdetails2,0,'specification');
echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src='$path' height=300 width=200 />";

switch($icategory)
{
case book:
echo "<table border=3><tr><th>item_code</th><th>yop</th><th>author</th><th>name</th><th>condition</th><th>description</th><th>edition</th></tr>";
echo "<tr><td>".$choice."</td><td>".$yop."</td><td>".$author."</td><td>".$name."</td><td>".$cd."</td><td>".$desc."</td><td>".$ed."</td></tr>";
echo "</table>";
break;
case gadget:
echo "<table border=3><tr><th>item_code</th><th>yop</th><th>name</th><th><color></th><th>condition</th><th>specification</th></tr>";
echo "<tr><td>".$choice."</td><td>".$yop."</td><td>".$name."</td><td>".$color."</td><td>".$cd."</td><td>".$spec."</td></tr>";
echo "</table>";

break;
case others:
echo "<table border=3><tr><th>item_code</th><th>yop</th><th>name</th><th>condition</th><th>description</th></tr>";
echo "<tr><td>".$choice."</td><td>".$yop."</td><td>".$name."</td><td>".$cd."</td><td>".$desc."</td></tr>";
echo "</table>";
break;
}

if(pg_num_rows($xcheck)==1)
echo "<br>You have already placed a bid on this item!<br>Place your new bid:";
else
echo "<br>Place your bid:";
echo "<form action='account.php' method='post'><input type='text' name='nbid' /><input type='submit' value='Confirm' /></form>";
}
else
echo "<br>Sorry the last bidding date of this item has finished and it has been sold to the highest bidder";
echo "<form action='item.php' method='post'>
<br><input type='submit' value='Go Back!' />
</form>";
$_SESSION['choice']=$_POST['choice'];
}
pg_close($conn);
?>
</body>
</html>
