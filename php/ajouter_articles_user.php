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
    <link rel="stylesheet" href="../Style/ajout_article_user.css">
    <title>Document</title>
</head>
<body>
<form action="">
    
</form>
<div class="navbar">
    <form method="GET">
        <p>
            
            <input type="text" name="id" value="<?=$_GET['id'];?>"  class="inputid">
            
        </p>
        <div class="search-container">
            <input type="search" name="q" placeholder="Recherche..." class="inputsearch" />
            <button type="submit"><img src="loupe.png" alt=""></button>
        </div>
    </form>
</div>
    <?php
    if (isset($_GET['id'])and !empty($_GET['id'])){
        $getid=$_GET['id'];}
    if(isset($_GET['q']) AND !empty($_GET['q'])) {
        $q = strtoupper($_GET['q']);
        $articles = $bdd->query('SELECT * FROM articles WHERE idmembre is null and deleted=false and type like "%'.$q.'%"');
        if($articles->rowCount() == 0) {
            $articles = $bdd->query('SELECT * FROM articles WHERE idmembre is null and deleted=false and CONCAT(type,marque,model,sn,remarques) like "%'.$q.'%"');
        }
        if($articles->rowCount() > 0) { ?>
             <div class="container">
                <table class="custom-table" align="center" cellspacing=1>
                    <caption> <h2>Tous les articles valables</h2></caption>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Numéro de série</th>
                        <th>Remarques</th>
                        <th>Affecter</th>
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
                                <td><?= $a['remarques']; ?></td>
                                <td class="more"><a href="affecter_article.php?id=<?= $getid; ?>& sn=<?= $a['sn']; ?>">Affecter</a>  </td>
                            </tr>
                        </p>
                     <?php } ?>
                    </tbody>
                </table>
            </div>
            
            
         <?php } else { 
                        echo "Aucun résultat pour: $q...";  }?>
   <?php
    }else{
        //  Afficher tous les membres 
            $recupartcl = $bdd ->query('SELECT * FROM articles where idmembre is null and deleted=false ');
            // $recupmarqs = $bdd ->query('SELECT Distinct (marque) FROM articles where idmembre is null');
             ?>
             <div class="navbar">
                <form method="GET">
                <p>
                    <h2>Ajouter des articles pour : <?=$_GET['prenom'];?> <?=$_GET['nom'];?></h2>
                    <input type="text" name="id" value="<?=$_GET['id'];?>"  class="inputid" >
            
                </p>
                
    </form>
</div>
            <div class="container">
                <table class="custom-table" align="center">
                    <caption> <h2>Tous les articles valables</h2></caption>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Numéro de série</th>
                        <th>Remarques</th>
                        <th>Affecter</th>
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
                            <td ><?= $us['remarques']; ?></td>
                            <td class="more"><a href="affecter_article.php?id=<?= $getid; ?>& sn=<?= $us['sn']; ?>">Affecter</a>  </td>
                        </tr>
                    </p>

                    <?php
               
                
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    <?php } ?>
    
</body>
<script src="javascript.js"></script>  
</html>