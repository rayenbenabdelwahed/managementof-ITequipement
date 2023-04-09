<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if(!$_SESSION['pass']){
    header('Location: connexion.php');
}
if (isset($_GET['id']) and !empty($_GET['id'])){
    
    
    $getid=$_GET['id'];
   
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
    <link rel="stylesheet" href="../Style/change_emp.css">
    <title>Document</title>
</head>
<body>

    <div class="user-box">
    <h2>Changer Emplacement</h2>
    <form action="">
    <input type="text" name="id" value="<?=$getid?>" autofocus class="inputid">
        <div class="insert-box">
            <?php
            if (!empty($_GET['nom']) and !empty($_GET['nom']) and !empty($_GET['prenom']) and !empty($_GET['prenom'])){
            ?>
            <input type="text"  autocomplete="off"  value="<?= $_GET['prenom'] ;?> <?= $_GET['nom']; ?>"disabled >
            
        </div>
        <div>
        <div>
            <label class="sel">District</label><br>
            <select name="dist" id="distr" onclick=myfunction() class="selection" >
                
                <option value="sousse" >Sousse</option>
                <option value="monastir" >Monastir</option>
                <option value="mahdia">Mahdia</option>
            </select>
            
        </div><br>
        <div >
            <label class="sel">Centre</label> <br>
            <select name="centre" id="centre" class="selection">
                 <option value=""disabled selected>---------</option>
            </select>
        </div><br>
        <div class="insert-box">
            
            <input type="text" name="place" autocomplete="off" required="">
            <label>Lieu</label>
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
                <?php
            }
                ?>
    </form>
    </div>
    <?php
    
   


if (!empty($_GET['id']) and !empty($_GET['dist']) and !empty($_GET['centre']) and !empty($_GET['place'])){
    $id=strtoupper($_GET['id']);
    $dist=strtoupper($_GET['dist']);
    $centre=strtoupper($_GET['centre']);
    $det=strtoupper($_GET['place']);
    
    $updatemplac=$bdd->prepare("UPDATE `membres` SET `district`='$dist',`centre`='$centre',`place`='$det' WHERE `id`='$id'");
    $updatemplac->execute(array());
    
    ?>
    <p class="p2">
    <a href="details_utilisateur.php?id=<?=$id?>" title="Retourner à la page précedente">Retourner aux détails</a>
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
