<?php session_start();
    ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>mon compte</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
        </header>
        <h1>Mon Compte</h1>
        <?php include("includes/connect.php");?>
        <?php $nomPage = "membres.php"; ?>
        <?php include("includes/ville.php");?>
        <?php include("includes/pluginRecherche.php"); ?>
        <?php include("includes/menu.php");?>
        <section id="voirCompte">
<?php
    $id = $_SESSION['id'];
   $reponse = $bdd->query('SELECT * FROM freeCitizenMembres WHERE id ="'.$id.'"');
    while ($donnees = $reponse->fetch())
    {
        echo '<p>Mon Login: '. $donnees['login'] .'</p></br><p>Mon Email: '. $donnees['email'] .'</p></br>';
    }
    $reponse->closeCursor();
    ?>
        </section>

        <section id="modifierCompte">
        </section>

        <section id="detruireCompte">
        </section>


    <footer>
            <?php  include("includes/footer.php"); ?>
    </footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    </body>
</html>
