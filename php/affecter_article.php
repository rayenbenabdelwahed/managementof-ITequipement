<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
$affected=  date('Y-m-d');
if (isset($_GET['id'])and !empty($_GET['id']) and isset($_GET['sn'])and !empty($_GET['sn']) ){
    $getid=$_GET['id'];
    echo $getid;
    $getsn=$_GET['sn'];
    echo $getsn;
    $affectartcl = $bdd-> prepare("UPDATE articles SET idmembre= ' $_GET[id]' WHERE sn='$_GET[sn]'");
    $affectartcl ->execute(array());
    $req = $bdd->prepare('INSERT INTO transactions (idmembre, idarticle,affected_at) VALUES(:idmembre,:idarticle,:affected_at)');
    $req->execute(array(
                'idmembre'=> $_GET['id'],

                'idarticle'=>$_GET['sn'],
                'affected_at'=>$affected
            ));

    header('Location:membres.php');
    
}
?>