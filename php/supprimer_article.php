<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');

if (isset($_GET['sn'])and !empty($_GET['sn'])){
    $getsn=$_GET['sn'];
    $recupartcl=$bdd->prepare('SELECT * FROM articles WHERE sn =?');
    $recupartcl->execute(array($getsn));
    if($recupartcl->rowCount()>0){
        $supprimeartcl = $bdd-> prepare('UPDATE articles SET deleted=true WHERE sn=?');
        $supprimeartcl->execute(array($getsn));
        $deletedat = $bdd-> prepare('UPDATE articles SET deleted_at=updated_at WHERE sn=?');
        $deletedat->execute(array($getsn));
        header('Location: articles.php');
    }
    else{
        echo "Aucun article n'a été trouvé";
    }
}   
else{
    echo "l'identifiant n'a pas été récupéré";
}
?>