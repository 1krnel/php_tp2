<?php 
/*
    modele.php est le fichier qui représente notre modèle dans notre architecture MVC. C'est donc dans ce fichier que nous retrouverons TOUTES nos requêtes SQL sans AUCUNE EXCEPTION. C'est aussi ici que se trouvera LA connexion à la base de données ET les informations de connexion relatives à celle-ci (qui pourraient être dans un fichier de configuration séparé... voir les frameworks).

*/

//à modifier pour webdev éventuellement...
define("SERVER", "localhost");
define("USERNAME", "e2295671");
define("PASSWORD", "Ptn0y063iTHlPlJPOKO9");
define("DBNAME", "e2295671");

function connectDB()
{
    //se connecter à la base de données
    $c = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);

    if(!$c)
    {
        die("Erreur de connexion. MySQLI : " . mysqli_connect_error());
    }

    //s'assurer que la connexion traite le utf8
    mysqli_query($c, "SET NAMES 'utf8'");

    return $c;
}

$connexion = connectDB();


function login($u, $p){
    global $connexion;
    $requete = "SELECT * FROM usagers WHERE username=? AND password=?";
    $reqPrep = mysqli_prepare($connexion, $requete);
    if($reqPrep){
        mysqli_stmt_bind_param($reqPrep, "ss", $u, $p);
        mysqli_stmt_execute($reqPrep);
        $resultats = mysqli_stmt_get_result($reqPrep);
        if(mysqli_num_rows($resultats) > 0){
            $rangee = mysqli_fetch_assoc($resultats);
            return $rangee["username"];
        }
        else
        {
            return false;
        }
    }
}

function liste(){
    global $connexion;
    $requete = "SELECT * FROM articles ORDER BY id DESC";
    $resultats = mysqli_query($connexion, $requete);
    return $resultats;
}

function recherche($r){
    global $connexion;
    $requete = "SELECT * FROM articles WHERE titre LIKE '%$r%' OR texte LIKE '%$r%'";
    $resultats = mysqli_query($connexion, $requete);
    return $resultats;
}

function supprimerUnArticle($id){
    global $connexion;
    $requete = "DELETE FROM articles WHERE id = $id";
    $resultat = mysqli_query($connexion, $requete);
    return $resultat;
}

function insererUnArticle($titre, $texte, $idAuteur){
    global $connexion;
    $requete = "INSERT INTO articles(idAuteur, titre, texte) VALUES('$idAuteur', '$titre', '$texte')";
    $resultat = mysqli_query($connexion, $requete);
    return $resultat;
}

function modificationArticle($titre, $texte, $idArticle){
    global $connexion;
    $requete = "UPDATE articles SET titre = '$titre', texte = '$texte' WHERE id = $idArticle";
    $resultat = mysqli_query($connexion, $requete);
    return $resultat;
}

function articleAModifier($id){
    global $connexion;
    $requete = "SELECT * FROM articles WHERE id = $id";
    $resultat = mysqli_query($connexion, $requete);
    if($resultat){
        $resultat = mysqli_fetch_assoc($resultat);
        return $resultat;
    } else{
        die("Erreur de requête préparée...");
    }
}

?>