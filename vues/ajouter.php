<?php session_start();?>
<form action="index.php" method="POST">
<input type="text" placeholder="titre" name="titre">
<textarea name="texte" cols="25" rows="15" placeholder="texte"></textarea>
<input type="hidden" name="idAuteur" value="<?= $_SESSION["user"]?>">
<input type="hidden" name="commande" value="insertion">
<input type="submit" value="Ajouter">
</form>