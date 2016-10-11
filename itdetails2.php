<?php
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
?>