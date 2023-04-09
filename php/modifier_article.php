<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if(!$_SESSION['pass']){
    header('Location: connexion.php');
}
if ((isset($_GET['sn']) and !empty($_GET['sn'])) and (isset($_GET['type']) and !empty($_GET['type'])) and (isset($_GET['marque']) and !empty($_GET['marque'])) and (isset($_GET['model']) and !empty($_GET['model'])) and (isset($_GET['bought_at']) and !empty($_GET['bought_at']))){
    
    
    $getsn=$_GET['sn'];
    $gettype=$_GET['type'];
    $getmarq=$_GET['marque'];
    $getmodel=$_GET['model'];
    $getrques=$_GET['remarques'];
    $getdatacha=$_GET['bought_at'];
   
}else{
    ?>
    <p class="p2" ><?php echo "identifiant n'a pas été récupéré"; ?></p>
    <?php
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style_modifier.css">
    <title>Document</title>
</head>
<body>
    <div class="user-box">
    <h2>modifier les données</h2>
    <form action="">
        <div class="insert-box">
            <input type="text" name="sn" value=<?=$getsn?> selected required="">
            <label>Numéro de série</label>
        </div>
        <div class="insert-box">
        
            <input type="text" name="type"  value=<?=$gettype?> selected required="" >
            <label>Type</label>
            
        </div>
        <div class="insert-box">
        
            <input type="text" name="marque" value=<?=$getmarq?> selected required="" >
            <label>Marque</label>
            
        </div>
        <div class="insert-box">
            <input type="text" name="model" value=<?=$getmodel?> selected required="" >
            <label>Modèle</label>
            
        </div>
        <div class="insert-box">
            <input type="text" name="remarques"  selected value=<?=$getrques?> >
            <label>Remarques</label>
        </div>
        <div class="insert-box">
            <input type="date" name="bought_at"  selected value=<?=$getdatacha?>  >
            <label>Date d'Achat</label>
        </div>
        <a href="#"> 
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <div class="sub">
            <input type="submit" value="Enregistrer" >
            </div>
        </a>
    
    </form>
    </div>
    <?php
    
   


if (!empty($_GET['sn']) and !empty($_GET['marque']) and !empty($_GET['model']) and  !empty($_GET['type']) and !empty($_GET['bought_at'])){
    $getsn=strtoupper($_GET['sn']);
    $getmarq=strtoupper($_GET['marque']);
    $getmodel=strtoupper($_GET['model']);
    $gettype=strtoupper($_GET['type']);
    $getrques=strtoupper($_GET['remarques']);
    $getdatacha=strtoupper($_GET['bought_at']);
    $updatartcl=$bdd->prepare("UPDATE `articles` SET `type`='$gettype',`model`='$getmodel',`marque`='$getmarq',`bought_at`='$getdatacha',`remarques`='$getrques' WHERE `sn`='$getsn'");
    $updatartcl->execute(array());
  
    ?>
    <p class="p2">
    
    <a href="articles.php" title="Retourner à la page précedente">Retourner aux détails</a>
    </p>
    <?php
 }else{
    ?>
    <p class="p2" ><?php echo "Veuillez remplir tous les champs!"; ?></p>
    <?php
    
}
?>
    <script src="javascript.js"></script>
</body>
</html>
