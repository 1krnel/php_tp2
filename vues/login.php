<?php session_start();?>
<h1>login</h1>
<form action="index.php" method="POST">
<input type="text" name="username" placeholder="username">
<input type="text" name="password" placeholder="password">
<br>
<input type="hidden" name="commande" value="verifLogin">
<input type="submit" value="login">
</form>