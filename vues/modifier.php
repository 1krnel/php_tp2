<?php session_start();?>
<form action="index.php" method="POST">
<input type="text" name="titre" value="<?= $modification["titre"] ?>" placeholder="titre">
<textarea name="texte" cols="25" rows="15" placeholder="texte"><?= $modification["texte"] ?></textarea>
<input type="hidden" name="commande" value="verifModif">
<input type="hidden" name="idArticle" value="<?= $modification["id"] ?>">
<input type="submit" value="Modifier">
</form>
<br>
<a href="index.php?commande=supprime&id=<?= $modification["id"] ?>">Supprimer</a>