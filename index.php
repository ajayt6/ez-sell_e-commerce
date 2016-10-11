<html>
<body>
<?php
session_start();
session_destroy();
?>
<a href="register.php">REGISTER</a>
<a href="item.php">DISPLAY ITEMS</a>
<br>
<br>
<br>
<form action="account.php" method="post">
Username:<input type="text" name="user"/><br>
Password:<input type="password" name="pass" /><br>
<input type="submit" value="Login!" />
</form>
</body>
</html>