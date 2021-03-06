
<?php
    session_start();
        ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>free citizen ajout d infos</title>
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

if ($_SESSION['id'] != 0) {
    
            echo '<h1>proposer des nouvelles</h1></br>';
            require 'includes/connect.php';
            $idAuteur=$_SESSION['id'];
            $mieuxNotes="infos.php";
            $recherche="rechercheInfos.php";
            $ajouter="ajoutInfos.php";
            require 'includes/ville.php';
            require 'includes/menu.php';
            require 'includes/menuServices.php';
            require 'includes/menuInfos.php';

            echo '<form action="ajoutInfos.php" method="post">';
                echo '<label for="ville">ville</label> :  <input type="text" name="ville" id="ville" required/><br />';
                echo '<label for="theme">theme</label> :  <input type="text" name="theme" id="theme" required/><br />';
                echo '<label for="titre">titre</label> :  <input type="text" name="titre" id="titre" required/><br />';
                echo '<label for="texte">nouvelle</label> : <textarea name="texte" rows="10" cols="50" required>votre texte ici</textarea><br />';
               echo '<input type="hidden" name="idAuteur" value=echo $idAuteur; >';
               echo '<input type="hidden" name="vote" value=0 >';
               echo '<input type="submit" value="Envoyer" />';
            echo '</form>';
    

    $i = 0;
    $ville = htmlspecialchars($_POST['ville']);
    $titre = htmlspecialchars($_POST['titre']);
    $theme = htmlspecialchars($_POST['theme']);
    $texte = htmlspecialchars($_POST['texte']);
    $idAuteur = htmlspecialchars($_POST['idAuteur']);
    echo $idAuteur;
    


  $query=$bdd->prepare('SELECT COUNT(*) FROM freeCitizenInfos WHERE titre =:titre');
    $query->bindValue(':titre',$titre, PDO::PARAM_STR);
    $query->execute();
    $titre_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
  

    if(!$titre_free){
        $titre_erreur1 = "Votre titre est déjà utilisé";
        $i++;
        echo $titre_erreur1;
        echo "</br>";
    }
    
    
    if (strlen($titre) < 3 || strlen($titre) > 300){
        $titre_erreur2 = "Votre titre est soit trop grand, soit trop petit";
        $i++;
        echo $titre_erreur2;
        echo "</br>";
    }
    
    if (empty($ville) || empty($titre) || empty($ville) || empty($theme) || empty($texte)){
        $vide_erreur = "Des champs sont vides";
        $i++;
        echo $vide_erreur;
        echo "</br>";
    }
    else{
    $req = $bdd->prepare('INSERT INTO freeCitizenInfos (date, ville, theme, idAuteur, titre, texte) VALUES(NOW(),?,?,?,?,?)');
    $req->execute(array($_POST['ville'], $_POST['theme'],$_POST['idAuteur'],$_POST['titre'],$_POST['texte']));
    }
}
else {
    echo "vous n'etes pas connecté";
}
    echo '<footer>';
                require 'includes/footer.php';
    echo '</footer>';

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    </body>
</html>

