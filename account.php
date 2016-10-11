<html>
<body>
<?php include("connect.php"); ?>

<?php
session_start();
if(!isset($_SESSION['user']))
{
$user=$_POST["user"];
$pass=$_POST["pass"];
$_SESSION['user']=$user;
$_SESSION['pass']=$pass;
}
else
{
$user=$_SESSION['user'];
$pass=$_SESSION['pass'];
}
$check=pg_query($conn,"select password,name from account where roll_no='$user';");
$chpass=pg_fetch_result($check,0,'password');
$name=pg_fetch_result($check,0,'name');
if(($pass==$chpass)&&($pass))
{
echo "<a href='index.php'>Logout</a>";
if($_POST['nbid'])
{
$nbid=$_POST['nbid'];
$nbid1=$_POST['nbid'];
$choice=$_SESSION['choice'];
$check2=pg_query($conn,"select * from item where item_code='$choice';");
if($nbid<pg_fetch_result($check2,0,'bid_highest'))
{
$nbid=pg_fetch_result($check2,0,'bid_highest');
}
$chinsert=pg_query($conn,"select * from buyer where roll_no='$user' and item_code='$choice';");
if(pg_num_rows($chinsert)>0)
{
if((pg_fetch_result($chinsert,0,'bid'))<$nbid)
{
$insert=pg_query($conn,"update buyer set bid='$nbid1' where roll_no='$user' and item_code='$choice';");
}
}
else
$insert=pg_query($conn,"insert into buyer values('$user','$choice','$nbid1');");
$hbfetch=pg_query($conn,"select * from item where item_code='$choice');");
$dhb=pg_fetch_result($hbfetch,0,'bid_highest');
if($dhb<$nbid)
{
$hbfetch=pg_query($conn,"update item set bid_highest='$nbid' where item_code='$choice';");
}
}
$ibuy=pg_query($conn,"select item_code,bid from buyer where roll_no='$user';");
$isell=pg_query($conn,"select item_code from seller where roll_no='$user';");
echo "<br>Welcome ".$name."!<br>";
if(pg_num_rows($isell)>0)
{
echo "<br>These are the items you placed to sell: <br>";
echo "<form action='sitem.php' method='post'>";
echo "<table><tr><th>Item Code</th><tr>";
}
else
echo "You have not placed any items for sale!<br>";
for($row=0;$row<pg_num_rows($isell);$row++)
{
	$icode=pg_fetch_result($isell,$row,'item_code');
    $ibuy2=pg_query($conn,"select * from item where item_code='$icode';");
	$hb=pg_fetch_result($ibuy2,0,'bid_highest');
	$name=pg_fetch_result($ibuy2,0,'item_name');	
	echo "<tr><td><input type='radio' value='$icode' name='ichoice' />".$icode."</td><td>".$name."</td></td><td>".$hb."</td></tr>";
}
if(pg_num_rows($isell)>0)
echo "</table><input type='submit' value='Choose' /></form>";
echo "<br><form action='sellitem.php'><input type='submit' value='Sell more' /></form>";

if(pg_num_rows($ibuy)>0)
{
echo "<br>These are the items you placed bids on: <br>";
echo "<form action='bitem.php' method='post'>";
echo "<table><tr><th>Item Code</th><th>Item Name</th><th>Bid</th><th>Highest Bid</th><tr>";
}
else 
echo "You have not placed any bids yet!";
for($row=0;$row<pg_num_rows($ibuy);$row++)
{
	$icode=pg_fetch_result($ibuy,$row,'item_code');
	$bid=pg_fetch_result($ibuy,$row,'bid');
	$ibuy2=pg_query($conn,"select * from item where item_code='$icode';");
	$hb=pg_fetch_result($ibuy2,0,'bid_highest');
	$name=pg_fetch_result($ibuy2,0,'item_name');
	echo "<tr><td><input type='radio' value='$icode' name='ichoice' />".$icode."</td><td>".$name."</td><td>".$bid."</td><td>".$hb."</td></tr>";
}
if(pg_num_rows($ibuy)>0)
echo "</table><input type='submit' value='Choose' /></form>";
echo "<br><form action='item.php'><input type='submit' value='Buy more' /></form>";

$isbuy=pg_query($conn,"select * from item where item_code in(select t.item_code from item as t,buyer where roll_no='$user' and bid_status='closed' and t.item_code=buyer.item_code and bid=bid_highest);");
if(pg_num_rows($isbuy)>0)
{
echo "<br>These are the items that you have succesfully bought: <br>";
echo "<form action='bitem.php' method='post'>";
echo "<table><tr><th>Item Code</th><tr>";
}
else
echo "<br>You have not bought any items currently!";
for($row=0;$row<pg_num_rows($isbuy);$row++)
{
	$icode=pg_fetch_result($isbuy,$row,'item_code');
	$ibuy2=pg_query($conn,"select * from item where item_code='$icode';");
	$name=pg_fetch_result($ibuy2,0,'item_name');
	echo "<tr><td><input type='radio' value='$icode' name='ichoice' />".$icode."</td><td>".$name."</td></tr>";
}
if(pg_num_rows($isbuy)>0)
echo "</table><input type='submit' value='Choose' /></form>";
}
else
{
echo "Incorrect Password! Try again.<br>";
echo "<a href='index.php'>Go Back</a>";
}

 pg_close($conn); ?>
</body>
</html>