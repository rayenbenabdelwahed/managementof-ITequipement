<?php
session_start();
if (!$_SESSION['pass']){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/index1.css">
    <title>Document</title>
    
</head>
<body>
    
    <div class="content">
        <h2>Liste des fonctions</h2>
        <table align="center" class="choix">
            <tr>
                <td class="membres" ><a href="membres.php" >Liste des membres</a></td>
                <td class="articles"> <a href="articles.php">Liste des articles</a></td>
            </tr>
            <tr>
                <td  class="adduser"><a href="ajouter_utilisateur.php">ajouter un nouveau membre</a></td>
                <td class="addartcl"> <a href="ajouter_article.php">ajouter un nouvel article</a></td>
            </tr>

        </table>
        
    </div>
    <a href="logout.php" class="disconnect">Déconnecter</a>
   
   
    
</body>
</html>
