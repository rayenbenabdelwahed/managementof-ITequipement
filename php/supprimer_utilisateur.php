<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if (isset($_GET['id'])and !empty($_GET['id'])){
    $getid=$_GET['id'];
    $recupuser=$bdd->prepare('SELECT * FROM membres WHERE id =?');
    $recupuser->execute(array($getid));
   
    if($recupuser->rowCount()>0){
        $supprimeuser = $bdd-> prepare('DELETE FROM membres WHERE id=?');
        $supprimeuser->execute(array($getid));
        $updatartcl = $bdd-> prepare("UPDATE articles SET idmembre=null WHERE idmembre=$getid ");
        $updatartcl->execute(array());
        header('Location: membres.php');
    }
    else{
        echo "Aucun membre n'a été trouvé";
    }
}   
else{
    echo "l'identifiant n'a pas été récupéré";
}
?>