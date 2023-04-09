<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if(!$_SESSION['pass']){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/membres.css">
    <title>Liste des membres</title>
</head>
<body>
<header>
    
    <div class="nav-bar">
        <ul>
            <a href="membres.php" >Liste des membres</a>
            <a href="articles.php">Liste des articles</a>
           <a href="ajouter_utilisateur.php">ajouter un nouveau membre</a>
            <a href="ajouter_article.php">ajouter un nouvel article</a>
        </ul>
    </div>


</header>
<div class="navbar">
    <div class="search-container">
        <form method="GET">
            <input type="search" name="q" placeholder="Recherche..." class="inputsearch" />
            <button type="submit"><img src="loupe.png" alt=""></button>
        </form>
    </div>
</div>

    <?php
    if(isset($_GET['q']) AND !empty($_GET['q'])) {
        $q = $_GET['q'];
        $users = $bdd->query('SELECT * FROM membres WHERE CONCAT(nom,prenom,id,district,centre,place) LIKE "%'.$q.'%" ');
        if($users->rowCount() > 0) { ?>
            <div class="content">
                <table class="matable" cellspacing=1 >
                    <caption> <h2>Tous les membres</h2></caption>
                        <tr>
                            <th>matricule</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Supprimer le membre</th>
                            <th>Plus de détails</th>
                        </tr>
                        <?php
                        while ($us = $users->fetch()){
                        ?>
                
                        <p> 
                            <tr>
                                <td><?= $us['id']; ?></td>
                                <td><?= $us['prenom']; ?></td>
                                <td><?= $us['nom']; ?></td>
                                <td class="more"> <a  onclick="return confirm('Voulez vous vraiment supprimer ce membre!?')" href="supprimer_utilisateur.php?id=<?= $us['id'];?>">Supprimer </a> </td>
                                <td class="more"> <a href="details_utilisateur.php?id=<?= $us['id'];?>">Détails </a> </td>
                            </tr>
                        </p>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        <?php } else { 
                        echo "Aucun résultat pour: $q...";  }?>
    <!-- Afficher tous les membres -->
        <?php
    }else{
            $recupUsers = $bdd ->query('SELECT * FROM membres');
            ?>
            <div class="content">
                <table class="matable"  cellspacing=1>
                    <caption> <h2>Tous les membres</h2></caption>
                    <thead>
                    <tr>
                        <th>matricule</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Supprimer le membre</th>
                        <th>Plus de détails</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($us = $recupUsers->fetch()){
                    ?>
                
                    <p> 
                        <tr>
                            <td><?= $us['id']; ?></td>
                            <td><?= $us['prenom']; ?></td>
                            <td><?= $us['nom']; ?></td>
                            <td class="more"> <a  onclick="return confirm('Voulez vous vraiment supprimer ce membre!?')" href="supprimer_utilisateur.php?id=<?= $us['id'];?>">Supprimer </a> </td>
                            <td class="more"> <a   href="details_utilisateur.php?id=<?= $us['id'];?>">Détails </a> </td>
                        </tr>
                    </p>

                    <?php
               
                
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    <?php } ?>   
    <!-- Fin afficher les membres -->
    <script src="javascript.js"></script>
</body>
</html>