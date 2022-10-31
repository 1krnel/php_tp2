<?php session_start();
if(isset($_SESSION["user"])){
    echo "<h1>Bienvenue " . $_SESSION["user"] . " !</h1>";
}
echo "<h2>Liste</h2>";
?>
<form action="index.php" method="POST">
    <input type="text" name="rechercheArticle" placeholder="Chercher un article">
    <input type="hidden" name="commande" value="recherche">
    <input type="submit" value="Chercher">
</form>
<?php
    while($rangee = mysqli_fetch_assoc($donnees["liste"])){
        echo "<h3>" . $rangee["titre"] . "</h3>";
        if(isset($_SESSION["user"]) && $rangee["idAuteur"] == $_SESSION["user"]){
            echo "<a href=index.php?commande=modifier&id=" . $rangee["id"] . ">Modifier</a>";
        }
        echo "<p>" . $rangee["texte"] . "</p> <h6>" . $rangee["idAuteur"] . "</h6>";
    }

    if(isset($_SESSION["user"]))
    {
        echo "<a href=index.php?commande=ajouterUnArticle>Add Article</a> <a href=index.php?commande=logout>Log Out</a>";
    } 
    else 
    {
        echo "<a href=index.php?commande=login>login</a>";
    }
?>