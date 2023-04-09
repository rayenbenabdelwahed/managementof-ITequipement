<?php
session_start();
$detached=  date('Y-m-d');
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if (isset($_GET['id'])and !empty($_GET['id']) and isset($_GET['sn'])and !empty($_GET['sn']) ){
    $getid=$_GET['id'];
    echo $getid;
    $getsn=$_GET['sn'];
    echo $getsn;
    $detachartcl = $bdd-> prepare("UPDATE articles SET idmembre= null WHERE sn='$_GET[sn]'");
    $detachartcl ->execute(array());
    $detachedartcl = $bdd-> prepare("UPDATE transactions SET detached_on='$detached' WHERE idarticle='$_GET[sn]' and idmembre='$_GET[id]'");
    $detachedartcl ->execute(array());
    header('Location:articles.php');
    
}
?>