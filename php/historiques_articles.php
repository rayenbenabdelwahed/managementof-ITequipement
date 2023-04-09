<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if (isset($_GET['sn'])and !empty($_GET['sn'])){
    $getsn=$_GET['sn'];
    $recuphistoriq=$bdd->prepare('SELECT * FROM transactions WHERE idarticle=?');
    $recuphistoriq->execute(array($getsn));
    $recupinfo=$bdd->prepare('SELECT bought_at,created_at,deleted_at,reform FROM articles WHERE sn=?');
    $recupinfo->execute(array($getsn));
        if($recupinfo->rowCount()>0){
            
            ?>
           <table align="center"    cellspacing=1>
            <caption>Tous les historiques et les transactions </caption>
           
            <?php
            while($ar = $recupinfo->fetch()) { 
            
                ?>
                <tr>
                    <th>Acheté le:</th>
                    <td><?=$ar['bought_at']?></td>
                </tr>
                <tr>
                    <th>Ajouté à la base le:</th>
                    <td><?=$ar['created_at']?></td>
                </tr>
                <tr>
                    <th>Supprimé le:</th>
                    <td><?php if ($ar['deleted_at']!=Null){
                            echo $ar['deleted_at'];
                        }else{
                            echo "Article encore utilisable";
                        }?></td>
                </tr>
                <?php
        }}
        if($recuphistoriq->rowCount()>0){
            ?>
            <tr >
                <th colspan=2>Transactions</th>
            </tr>
            <?php
        $i=1;
        while($a = $recuphistoriq->fetch()) { 
            
            
            ?>
            <tr>
                <th colspan=2 align="left">Transaction <?= $i?>: </th>
            </tr>
           
            <tr>
                <td>Affecté à l'utilisateur de matricule:</td>
                <td><?=$a['idmembre']?></td>
            </tr>
            <tr>
                <td>Affecté le :</td>
                <td><?=$a['affected_at']?></td>
            </tr>
            <?php
            if ($a['gonetoreform']!=null){
                ?>
            <tr>
                <td>Tombé en panne le:</td>
                <td><?php
                    
                        echo $a['gonetoreform'];
                    
                    ?></td>
            </tr>
            
            <tr>
                <td>Réparé et retourné le :</td>
                <td><?php
                    if ($a['reformed']!=Null){
                        echo $a['reformed'];
                    }else{
                        echo "en cours de réparation";
                    } }  
                    ?> </td>
            </tr>
            <tr>
                <td>Détaché le :</td>
                <td><?php
                    if ($a['detached_on']!=Null){
                        echo $a['detached_on'];
                    }else{
                        echo "en cours d'utilisation";
                    }
                    ?></td>
            </tr>
             <?php
            $i++; 
           

             
    }}
    else{
        ?>
        <tr>
            <td colspan=2>Aucun historique n'a été trouvé!</td>
        </tr>
    </table>
        <?php
        
    }
    
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
    <link rel="stylesheet" href="../Style/historiques.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>