<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
$reform=  date('Y-m-d');
if (isset($_GET['idmembre'])and !empty($_GET['idmembre']) and isset($_GET['sn'])and !empty($_GET['sn']) ){
    $getid=$_GET['idmembre'];
    echo $getid;
    $getsn=$_GET['sn'];
    echo $getsn;
   
    $reformartcl = $bdd-> prepare("UPDATE transactions SET 	reformed='$reform' WHERE idarticle='$_GET[sn]' and  detached_on is null");
    $reformartcl ->execute(array());

    $reformedartcl = $bdd-> prepare("UPDATE articles SET reform=false WHERE sn='$_GET[sn]' and idmembre='$_GET[idmembre]' ");
    $reformedartcl ->execute(array());
    
    header('Location:articles.php');
    
}
?>