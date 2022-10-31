<?php
    while($rangee = mysqli_fetch_assoc($donnees["recherche"])){
        echo "<h3>" . $rangee["titre"] . "</h3>";
        if(isset($_SESSION["user"]) && $rangee["idAuteur"] == $_SESSION["user"]){
            echo "<a href=index.php?commande=modifier&id=" . $rangee["id"] . ">Modifier</a>";
        }
        echo "<p>" . $rangee["texte"] . "</p> <h6>" . $rangee["idAuteur"] . "</h6>";
    }
?>