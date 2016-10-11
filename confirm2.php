<html>
<body>
<?php
include("connect.php");
session_start();
$code=$_SESSION['icode'];
$name=$_SESSION['iname'];
$yop=$_POST['yop'];
$cd=$_POST['cd'];

echo "Congrats! You have enlisted the item for sale.";
switch($_SESSION['ichoice'])
{
case book:
$author=$_POST['author'];
$desc=$_POST['desc'];
$ed=$_POST['ed'];
$insert=pg_query($conn,"insert into book values('$code','$yop','$author','$name','$cd','$desc','$ed');");
break;
case gadget:
$color=$_POST['color'];
$spec=$_POST['spec'];
$insert=pg_query($conn,"insert into gadget values('$code','$yop','$name','$color','$cd','$spec');");
break;
case others:
$desc=$_POST['desc'];
$insert=pg_query($conn,"insert into others values('$code','$yop','$name','$cd','$desc');");
break;
}
echo "<form action='account.php' method='post'>
<br><input type='submit' value='Go Back!' />
</form>";
unset($_SESSION['ichoice']);
unset($_SESSION['icode']);
unset($_SESSION['iname']);
pg_close($conn);
?>
</body>
</html>