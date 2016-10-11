<html>
<body>
<?php
session_start();
include("connect.php");
$_SESSION['iname']=$_POST['name'];
$user=$_SESSION['user'];
$name=$_POST['name'];
$category=$_POST['category'];
$bp=$_POST['bp'];
$dated=$_POST['day'];
$datem=$_POST['month'];
$datey=$_POST['year'];
$date=$datey."-".$datem."-".$dated;
$numfetch=pg_query($conn,"select * from item;");
$num=pg_num_rows($numfetch);
$num=$num+1;
if($num<10)
$num="00".$num;
else if(($num>10) && ($num<100))
$num="0".$num;
else
$num="$num";
$_SESSION['icode']=$num;

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 100000000))
  {
  if($_FILES["file"]["type"] == "image/gif")
  $type=".gif";
  if($_FILES["file"]["type"] == "image/jpeg")
  $type=".jpeg";
  if($_FILES["file"]["type"] == "image/pjpeg")
  $type=".pjpeg";
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("image/" . $num.$type))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "image/" . $num.$type);	  
      echo "Stored in: " . "image/" . $num.$type;
      }
    }
  }
else
  {
  echo "Invalid file";
  }
$path="image/" . $num.$type;




$insert=pg_query($conn,"insert into item values('$num','$category','$name',$bp,$bp,'open','$path','$date');");
$insert=pg_query($conn,"insert into seller values('$user','$num');");




switch($category)
{
case 'book':
$_SESSION['ichoice']='book';
echo '<form action="confirm2.php" method="post">
Year of production:<input type="text" name="yop" /><br />
Author:<input type="text" name="author" /><br />
Condition:<input type="text" name="cd" /><br />
Description:<input type="text" name="desc" /><br />
Edition:<input type="text" name="ed" /><br />
<input type="submit" value="continue"/>
</form>';
break;
case 'gadget':
$_SESSION['ichoice']='gadget';
echo '<form action="confirm2.php" method="post">
Year of production:<input type="text" name="yop" /><br />
Color:<input type="text" name="color" /><br />
Condition:<input type="text" name="cd" /><br />
Specification:<input type="text" name="spec" /><br />
<input type="submit" value="continue"/>
</form>';
break;
case 'others':
$_SESSION['ichoice']='others';
echo '<form action="confirm2.php" method="post">
Year of production:<input type="text" name="yop" /><br />
Condition:<input type="text" name="cd" /><br />
Description:<input type="text" name="desc" /><br />
<input type="submit" value="continue"/>
</form>';
break;
default:
break;
}
pg_close($conn);
?>
</body>
</html>