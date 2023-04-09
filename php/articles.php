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
    <link rel="stylesheet" href="../Style/articles.css">
    <title>Liste des articles</title>
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
        $q = strtoupper($_GET['q']);
        $articles = $bdd->query('SELECT * FROM articles WHERE deleted=false  and type LIKE "%'.$q.'%" ');
        if($articles->rowCount() == 0) {
              $articles = $bdd->query('SELECT * FROM articles WHERE deleted=false and reform=false and idmembre is null and CONCAT(type,marque,model,sn) LIKE "%'.$q.'%"');
        }
        if($articles->rowCount() > 0) { ?>
             <div class="matable1" >
                <table align="center" cellspacing=0>
                    <caption> <h2>Tous les articles en stock</h2></caption>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Numéro de série</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                        <th>Remarques</th>
                        <th>Historiques</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($a = $articles->fetch()) { ?>
                        <p> 
                            <tr>
                                <td><?= $a['type']; ?></td>
                                <td><?= $a['marque']; ?></td>
                                <td><?= $a['model']; ?></td>
                                <td><?= $a['sn']; ?></td>
                                <td class="more"> <a  onclick="return confirm('Voulez vous vraiment supprimer cet article!?')" href="supprimer_article.php?sn=<?= $a['sn'];?>">Supprimer </a> </td>
                                <td class="more"><a  href="modifier_article.php?sn=<?= $a['sn'];?>">Modifier </a></td>
                                <td><?= $a['remarques']; ?></td>
                                <td class="more"><a  href="historiques_articles.php?sn=<?= $a['sn'];?>">Historiques </a></td>
                            </tr>
                        </p>
                     <?php } ?>
                    </tbody>
                </table>
            </div>
            
            </ul>
         <?php } else { 
                        echo "Aucun résultat pour: $q...";  }?>
     
    <?php
    }else{
        //  Afficher tous les membres 
            $recupartcl = $bdd ->query('SELECT * FROM articles WHERE deleted=false and reform=false and idmembre is null');
            ?>
            <div class="matable1">
                <table align="center"  cellspacing=1>
                    <caption> <h2>Salle de reserve</h2></caption>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Numéro de série</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                        <th>Remarques</th>
                        <th>Historiques</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($us = $recupartcl->fetch()){
                    ?>
                
                    <p> 
                        <tr>
                            <td><?= $us['type']; ?></td>
                            <td><?= $us['marque']; ?></td>
                            <td><?= $us['model']; ?></td>
                            <td><?= $us['sn']; ?></td>
                            <td class="more"> <a  onclick="return confirm('Voulez vous vraiment supprimer cet article!?')" href="supprimer_article.php?sn=<?= $us['sn'];?>">Supprimer </a> </td>
                            <td class="more"><a  href="modifier_article.php?sn=<?= $us['sn'];?>&type=<?= $us['type'];?>&model=<?= $us['model'];?>&marque=<?= $us['marque'];?>&remarques=<?= $us['remarques'];?>&bought_at=<?= $us['bought_at'];?>">Modifier</a></td>
                            <td><?= $us['remarques']; ?></td>
                            <td class="more"><a  href="historiques_articles.php?sn=<?= $us['sn'];?>">Historiques </a></td>
                        </tr>
                    </p>

                    <?php
               
                
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            $recupartclreform = $bdd ->query('SELECT * FROM articles WHERE deleted=false and reform=true');
            ?>
            <div class="matable" >
                <table align="center" cellspacing=1>
                    <caption> <h2>Salle de réforme</h2></caption>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Numéro de série</th>
                        <th>Remarques</th>
                        <th>Matricule du membre</th>
                        <th>Retourner au membre </th>
                        <th>Supprimer</th>
                        <th>Historiques</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($us = $recupartclreform->fetch()){
                    ?>
                
                    <p> 
                        <tr>
                            <td><?= $us['type']; ?></td>
                            <td><?= $us['marque']; ?></td>
                            <td><?= $us['model']; ?></td>
                            <td><?= $us['sn']; ?></td>
                            <td><?= $us['remarques']; ?></td>
                            <td><?= $us['idmembre']; ?></td>
                            <td class="more"><a  href="retourner_article.php?sn=<?= $us['sn'];?>&idmembre=<?= $us['idmembre'];?>">Retourner</a></td>
                            <td class="more"> <a  onclick="return confirm('Voulez vous vraiment supprimer cet article!?')" href="supprimer_article.php?sn=<?= $us['sn'];?>">Supprimer </a> </td>
                            
                            <td class="more"><a  href="historiques_articles.php?sn=<?= $us['sn'];?>">Historiques </a></td>
                        </tr>
                    </p>

                    <?php
               
                
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
             $recupartclsup = $bdd ->query('SELECT * FROM articles WHERE deleted=true');
            ?>
            <div class="matable" >
                <table align="center" cellspacing=1>
                    <caption> <h2>Tous les articles supprimés</h2></caption>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Numéro de série</th>
                        
                        <th>Remarques</th>
                        <th>Historiques</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($us = $recupartclsup->fetch()){
                    ?>
                
                    <p> 
                        <tr>
                            <td><?= $us['type']; ?></td>
                            <td><?= $us['marque']; ?></td>
                            <td><?= $us['model']; ?></td>
                            <td><?= $us['sn']; ?></td>
                            
                            <td><?= $us['remarques']; ?></td>
                            <td class="more"><a  href="historiques_articles.php?sn=<?= $us['sn'];?>">Historiques </a></td>
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
</body>
</html>