<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if (isset($_GET['id'])and !empty($_GET['id'])){
    $getid=$_GET['id'];
    $recupuser=$bdd->prepare('SELECT * FROM membres WHERE id=?');
    $recupuser->execute(array($getid));
    ?>
    <div class="content">
    <table  class="custom-table" align="center" cellspacing=0>
        <caption><h1>Détails sur ce membre</h1></caption>
    
    <?php
    while ($us = $recupuser->fetch()){
    ?>
        <tr>
            <th >Matricule</th>
            <td><?= $us['id']; ?></td>
        </tr>
        <tr>
            <th >Prénom</th>
            <td><?= $us['prenom']; ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?= $us['nom']; ?></td>
        </tr>
        <tr>
            <th >Emplacement</th>
            <td><?= $us['district']; ?> , <?= $us['centre']; ?> , <?= $us['place']; ?></td>
        </tr>
        <tr>
            <td class="more"><a href="changer_emplacement.php?id=<?= $getid;?>&nom=<?= $us['nom']; ?>&prenom=<?= $us['prenom']; ?>">Changer Emplacement</a></td>
            <td class="more"><a href="ajouter_articles_user.php?id=<?= $getid;?>&nom=<?= $us['nom']; ?>&prenom=<?= $us['prenom']; ?>">Ajouter un article à ce membre</a></td>
        </tr>
        
    
    <?php
    
}  
?></table>
</div>
<?php

$recupartcl = $bdd ->query("SELECT * FROM articles WHERE idmembre=$getid and reform=false ");

            ?>
            <div class="container">
                <table class="custom-table" align="center" cellspacing=0>
                    <caption> <h2>Tous les articles affectés</h2></caption>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Numéro de série</th>
                        <th>Remarques</th>
                        <th>Détacher</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($us = $recupartcl->fetch()){
                    ?>
                
                    <p> 
                        <tr>
                            <td  ><?= $us['type']; ?></td>
                            <td  ><?= $us['marque']; ?></td>
                            <td  ><?= $us['model']; ?></td>
                            <td ><?= $us['sn']; ?></td>
                            <td  ><?= $us['remarques']; ?></td>
                            <td  class="more"><a href="detacher_article.php?id=<?= $getid; ?>& sn=<?= $us['sn']; ?>">Reserve</a> <a href="reforme_article.php?id=<?= $getid; ?>& sn=<?= $us['sn']; ?>">Réforme</a></td>
                        </tr>
                    </p>

                    <?php
               
                
                    }
                    ?>
                    </tbody>
                </table>
            </div>
<?php
 }
else{
    echo "l'identifiant n'a pas été récupéré";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/details_membres.css">
    <title>Document</title>
</head>
<body>
    
   
</body>
</html>