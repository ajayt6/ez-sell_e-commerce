<html>
<body>
<?php include("connect.php"); ?>
<?php
$roll=$_POST["roll"];
$name=$_POST["name"];
$sem=$_POST["sem"];
$address=$_POST["hostel"]."-".$_POST["room"].",NIT-C";
$pass=$_POST["pass"];

$insert=pg_query($conn,"insert into account values('$roll','$name',$sem,'$address','$pass');");
if($insert)
echo "Congrats! You have successfully registered . Your username is :".$_POST["roll"];

?>
<br>
<br>
<br>
<a href="index.php">OK! Go Back</a>
<?php pg_close($conn); ?>
</body>
</html>
