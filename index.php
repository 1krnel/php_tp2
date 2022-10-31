<?php 

/* 

    index.php est le CONTRÔLEUR de notre application de type MVC (modulaire).

    TOUTES les requêtes de notre application, sans aucune exception, devront passer en premier par ce fichier. Tous les liens et tous les formulaires auront donc comme destination index.php... avec des paramètres.

    Le coeur du contrôleur sera sa structure décisionnelle qui traite un paramètre que l'on va nommer commande. C'est la valeur de ce paramètre commande qui va déterminer les actions posées par le contrôleur.

    IMPORTANT : Le contrôleur ne contient ni requête SQL, ni HTML/CSS/JS, seulement du PHP.

    Le SQL va strictement dans le modèle. Le HTML va strictement dans les vues.
*/

//réception du paramètre commande, qui peut arriver en GET ou en POST
//et donc nous utiliserons $_POST (qui contient GET ET POST)

if(isset($_REQUEST["commande"])){
    $commande = $_REQUEST["commande"];
} else{
    //ici, on devrait spécifier la commande par défaut, typiquement celle qui mène à votre page d'accueil
    $commande = "liste";
}

//inclusion du modèle avec connexion à la BD et accès aux fonctions
require_once("modele.php");
//coeur du contrôleur - structure décisionnelle
switch($commande){   
    case "liste":
        $donnees["liste"] = liste();
        $donnees["titre"] = "Liste";
        require_once("vues/header.php");
        require("vues/liste.php");
        require_once("vues/footer.php");
        break;
    case "supprime":
        supprime();
        break;
    case "ajouterUnArticle":
        $donnees["titre"] = "Ajouter un article";
        require_once("vues/header.php");
        require("vues/ajouter.php");
        require_once("vues/footer.php");
        break;
    case "insertion":
        insertion();
        break;
    case "recherche":
        $donnees["titre"] = "recherche";
        $donnees["recherche"] = recherche($_POST["rechercheArticle"]);
        require_once("vues/header.php");
        require("vues/recherche.php");
        require_once("vues/footer.php");
        break;
    case "modifier":
        $donnees["modifier"] = articleAModifier($_GET["id"]); 
        $modification = $donnees["modifier"];
        $donnees["titre"] = "Modifier un article";
        require_once("vues/header.php");
        require("vues/modifier.php");
        require_once("vues/footer.php");
        break;
    case "verifModif":
        verifModif();
        break;
    case "login":
        $donnees["titre"] = "login";
        require_once("vues/header.php");
        require("vues/login.php");
        require_once("vues/footer.php");
        break;
    case "verifLogin":
        verifLogin();
        break;
    case "logout":
        require_once("vues/header.php");
        require("vues/logout.php");
        require_once("vues/footer.php");
        break;
    default : 
        header("Location: index.php");
        die();
}


function verifLogin(){
    session_start();
    if(isset($_POST["username"], $_POST["password"])){
        $nomUsager = login($_POST["username"], $_POST["password"]);
        if($nomUsager)
        {
            $_SESSION["user"] = $nomUsager;
            header("Location: index.php");
            die();
        }
        else 
        {
            header("Location: index.php?commande=login");
            die();
        }
    }
}

function insertion(){
    session_start();
    if(isset($_POST["titre"], $_POST["texte"], $_POST["idAuteur"])){
        $titre = trim($_POST["titre"]);
        $texte = trim($_POST["texte"]);
        $idAuteur = trim($_POST["idAuteur"]);
        if($titre != "" && $texte != "" && $idAuteur != ""){
            $insert = insererUnArticle($titre, $texte, $idAuteur);
            if($insert){
                header("Location: index.php?commande=liste");
            }
        } else{
            header("Location: index.php?commande=ajouterUnArticle");
        }
    } else{
        header("Location: index.php?commande=ajouterUnArticle");
    }
}

function verifModif(){
    session_start();
    if(isset($_POST["titre"], $_POST["texte"])){
        $titre = trim($_POST["titre"]);
        $texte = trim($_POST["texte"]);
        $idArticle = $_POST["idArticle"];
        if($titre != "" && $texte != ""){
            $modif = modificationArticle($titre, $texte, $idArticle);
            if($modif){
                header("Location: index.php?commande=liste");
            }
        } else{
            header("Location: index.php?commande=modifier");
        }
    } else{
        header("Location: index.php?commande=modifier");
    }
}

function supprime(){
    session_start();
    supprimerUnArticle($_GET["id"]);
    header("Location: index.php");
}
?>