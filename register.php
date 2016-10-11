<html>
<body>


<form name="myform" action="confirm1.php" onsubmit="return validateForm();" method="post" >
  <table>
<tr><td>Name :</td>                                        
  <td><input type="text" name="name" /></td></tr>
<tr><td>Roll No .</td>
<td><input type="text" name="roll"/></td></tr><br>
<tr><td>Password:</td><td><input type="password" name="pass" /></td></tr>
<tr><td>Re-type password:</td><td><input type="password" name="repass" /></td></tr>
<tr><td>Semester:</td><td><input type="text" name="sem" /></td></tr>
<tr><td>Room No.:</td><td><input type="text" name="room" /></td></tr>
<tr><td>Hostel:</td>
<td><input type="text" name="hostel" /><td></tr></table>
<input type="submit" name="submit" value="submit" />
</form>
<script type="text/javascript">
function validateForm()
{
if (document.myform.name.value== "")
  {
  alert("fields should not be lft empty");
  return false;
  }
  
  
  //x=document.forms["myForm"]["roll"].value
  if (document.myform.pass.value=="")
  {
  alert("password not entered properly");
  }
  if (document.myform.pass.value!= document.myform.repass.value)
  {
   alert("passwords does not match");
   return false;
  }
if (document.myform.roll.value== "")
  {
  alert("fields should not be lft empty");
  return false;
  }
  //x=document.forms["myForm"]["sem"].value
if (!((document.myform.sem.value== 1) || (document.myform.sem.value== 2 ) ||(document.myform.sem.value== 3) || (document.myform.sem.value== 4) || (document.myform.sem.value== 6) ||(document.myform.sem.value== 7)|| (document.myform.sem.value== 8)))
  {
  alert("semester invalid(1-8)");
  return false;
  }
  //x=document.forms["myForm"]["room"].value
if (document.myform.room.value== "")
  {
  alert("fields should not be lft empty");
  return false;
  }
  
  return true;
  
}
</script>
<form action='index.php'>
<input type='submit' value='Go Back!' />
</form>
</body>
</html>