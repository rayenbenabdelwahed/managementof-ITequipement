<?php
session_start();
$reform=  date('Y-m-d');
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if (isset($_GET['id'])and !empty($_GET['id']) and isset($_GET['sn'])and !empty($_GET['sn']) ){
    $getid=$_GET['id'];
    echo $getid;
    $getsn=$_GET['sn'];
    echo $getsn;
    $panneartcl = $bdd-> prepare("UPDATE articles SET reform=true WHERE sn='$_GET[sn]'");
    $panneartcl ->execute(array());
    $reformartcl = $bdd-> prepare("UPDATE transactions SET gonetoreform='$reform' WHERE idarticle='$_GET[sn]' and idmembre='$_GET[id]' and detached_on is null");
    $reformartcl ->execute(array());
    header('Location:articles.php');
}
?>