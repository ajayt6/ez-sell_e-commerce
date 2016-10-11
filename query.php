<html>
<body>
<?php
$conn=pg_connect("host=localhost port=5432 user=b090140cs dbname=exam_b090140cs password=robin");
if($conn)
{
echo "connection success <br />";

}
else 
echo "fail";
if($_POST["choice"]==1)
{
$result1=pg_query($conn,"(select Provider from two as s,three as t where s.SName=t.SName and t.SGrade='A') UNION (select Provider from two as s,three as t where s.SName=t.SName and t.SGrade='B')");
echo "<table>";
echo "<tr><th>Provider</th></tr>";
for($row=0;$row<pg_num_rows($result1);$row++)
{
	$provider=pg_fetch_result($result1,$row,'provider');
	echo "<tr><td>".$provider."</td></tr>";
}
echo "</table>";
}
else
{
$result2=pg_query($conn,"create view five as select count(s.sname) as a,provider from two as s,three as t where s.sname=t.sname and t.sinstitute='NITC' group by provider;");
$result3=pg_query($conn,"select type,provider from one where provider in(select provider from five where a in(select max(a) from five));");
echo "<table>";
echo "<tr><th>Type</th><th>Provider</th></tr>";
for($row=0;$row<pg_num_rows($result3);$row++)
{
	$type=pg_fetch_result($result3,$row,'type');	
	$provider=pg_fetch_result($result3,$row,'provider');
	echo "<tr><td>".$type."</td><td>".$provider."</td></tr>";
}
echo "</table>";
}
pg_close($conn);
?>
</body>
</html>
