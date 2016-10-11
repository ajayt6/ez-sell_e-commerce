<html>
<body>

<form name="myform" action="sellitem2.php" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
Item name:<input type="text" name="name" /><br />
Category:<br>
<input type="radio" name="category" value="book" />Book<br>
<input type="radio" name="category" value="gadget" />Gadget<br>
<input type="radio" name="category" value="others" />Others<br>
Base price:<input type="text" name="bp" /><br />
Enter the last date:<br /><select name="month">
	<option value="01">January
	<option value="02">February
	<option value="03">March
	<option value="04">April
	<option value="05">May
	<option value="06">June
	<option value="07">July
	<option value="08">August
	<option value="09">September
	<option value="10">October
	<option value="11">November
	<option value="12">December
</select>
<select name="day">
	<option value="01">1
	<option value="02">2
	<option value="03">3
	<option value="04">4
	<option value="05">5
	<option value="06">6
	<option value="07">7
	<option value="08">8
	<option value="09">9
	<option value="10">10
	<option value="11">11
	<option value="12">12
	<option value="13">13
	<option value="14">14
	<option value="15">15
	<option value="16">16
	<option value="17">17
	<option value="18">18
	<option value="19">19
	<option value="20">20
	<option value="21">21
	<option value="22">22
	<option value="23">23
	<option value="24">24
	<option value="25">25
	<option value="26">26
	<option value="27">27
	<option value="28">28
	<option value="29">29
	<option value="30">30
	<option value="31">31
</select>
<select name="year">
	<option value="2011">2011
	<option value="2012">2012
	<option value="2013">2013
	<option value="2014">2014
</select></br>
<label for="file">Upload picture:</label><input type="file" name="file" id="file" /> <br>
<input type="submit" value='continue'/>
</form>
<form action='account.php'>
<input type='submit' value='Go Back!' />
</form>
<script type="text/javascript">
function validateForm()
{
if (document.myform.name.value== "")
  {
  alert("fields should not be left empty");
  return false;
  }
  if (document.myform.bp.value== "")
  {
  alert("fields should not be lft empty");
  return false;
  }
 /* if (document.myform..value== "")
  {
  alert("fields should not be lft empty");
  return false;
  }*/
  return true;
  }
  </script>
  
</body>
</html>