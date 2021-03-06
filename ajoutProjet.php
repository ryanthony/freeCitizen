//formulaire d ajout de projet

<?php
    session_start();
        ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>free citizen ajout de produits</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>
    <body>
        <header>
        </header>

<?php

//verification que l utilisateur est connecte
if ($_SESSION['id'] != 0) {
    
    //si l utilisateur est connecte
    //appel aux scripts necessaires
            echo '<h1>proposer des nouveaux projets</h1></br>';
            require 'includes/connect.php';
            $idAuteur=$_SESSION['id'];
            $mieuxNotes="projet.php";
            $recherche="rechercheProjet.php";
            $ajouter="ajoutProjet.php";
            require 'includes/ville.php';
            require 'includes/menu.php';
            require 'includes/menuServices.php';
            require 'includes/menuInfos.php';

//affichage du formulaire
            echo '<form action="ajoutProjet.php" method="post">';
                echo '<label for="ville">ville</label> :  <input type="text" name="ville" id="ville" required/><br />';
                echo '<label for="titre">ville</label> :  <input type="text" name="titre" id="titre" required/><br />';
                echo '<label for="theme">theme</label> :  <input type="text" name="theme" id="theme" required/><br />';
                echo '<label for="equipe">equipe</label> :<textarea name="equipe" rows="10" cols="50" required>votre equipe ici</textarea><br />';
                echo '<label for="descriptif">descriptif</label> :<textarea name="descriptif" rows="10" cols="50" required>votre projet ici</textarea><br />';
               echo '<input type="hidden" name="idAuteur" value=" echo $idAuteur;" >';
            echo '<input type="hidden" name="vote" value=0 >';
               echo '<input type="submit" value="Envoyer" />';
            echo '</form>';
    
    //recupertation des champs pour verification back
    $i = 0;
    $ville = htmlspecialchars($_POST['ville']);
    $titre = htmlspecialchars($_POST['titre']);
    $theme = htmlspecialchars($_POST['theme']);
    $equipe = htmlspecialchars($_POST['equipe']);
    $descriptif = htmlspecialchars($_POST['descriptif']);
    
    $query=$bdd->prepare('SELECT COUNT(*) FROM freeCitizenProjet WHERE titre =:titre');
    $query->bindValue(':titre',$titre, PDO::PARAM_STR);
    $query->execute();
    $titre_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    
    //verification que le titre est libre
    if(!$titre_free){
        $titre_erreur1 = "Votre pseudo est déjà utilisé par un membre";
        $i++;
        echo $titre_erreur1;
        echo "</br>";
    }
    
    //verification du format du titre
    if (strlen($titre) < 3 || strlen($titre) > 300){
        $titre_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
        $i++;
        echo $titre_erreur2;
        echo "</br>";
    }
    
    //verification que les champs ne sont pas vides
    if (empty($ville) || empty($titre) || empty($theme) || empty($equipe) || empty($descriptif)){
        $vide_erreur = "Des champs sont vides";
        $i++;
        echo $vide_erreur;
        echo "</br>";
    }
    
    //sinon insertion dans la bdd
    else{
    $req = $bdd->prepare('INSERT INTO freeCitizenProjet (date, ville, theme, titre, idAuteur, equipe, descriptif) VALUES(NOW(),?,?,?,?,?,? )');
    $req->execute(array($_POST['ville'], $_POST['theme'], $_POST['titre'],$_POST['idAuteur'],$_POST['equipe'],$_POST['descriptif'] ));
    }
}
else {
    echo "vous n'etes pas connecté";
}?>
   <?php
    echo '<footer>';
                require 'includes/footer.php';
    echo '</footer>';

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    </body>
</html>

