<?php
    session_start();
        ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>free citizen produit</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <![endif]-->
    </head>
    <body>
        <header>
        </header>

<?php
    if ($_SESSION['id'] != 0) {
        echo '<h1>Les derniers produits</h1></br>';
        require 'includes/connect.php';
        $nomPage = "produit.php";
        $ville = $_POST['ville'];
        $type = $_POST['type'];
        $statut = $_POST['statut'];
        $mieuxNotes="produit.php";
        $recherche="rechercheProduit.php";
        $ajouter="ajoutProduit.php";
        require 'includes/menu.php';
        require 'includes/menuServices.php';
        require 'includes/menuInfos.php';
        require 'includes/themesProduit.php';
        require 'objets/ObjetProduit.php';
        require 'includes/bbcodeTexte.php';
        
        echo '<section id="voirProduit"><h2>Les meilleures propostions et recherches de produits dans cette ville</h2>';
        $request = $bdd->query('SELECT * FROM freeCitizenProduit WHERE ville = "'.$ville.'" AND type = "'.$type.'" AND statut =  "'.$statut.'" ORDER BY votes LIMIT 0, 10');
        while ($donnees = $request->fetch(PDO::FETCH_ASSOC)){
            
            $produit = new Produit($donnees);
            
            echo $produit->id();
            echo "</br>";
            echo $produit->titre();
            echo "</br>";
            echo $produit->date();
            echo "</br>";
            echo $produit->ville();
            echo "</br>";
            echo $produit->type();
            echo "</br>";
            echo $produit->statut();
            echo "</br>";
            echo $produit->votes();
            echo "</br>";
            $texte = $produit->descriptif();
            echo $texte;
            echo "</br>";
            echo "</br>";
            //formulaire d'envois de commentaire
            require 'includes/includesProduit.php';
        }
        $request->closeCursor();
            echo'</section>';
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