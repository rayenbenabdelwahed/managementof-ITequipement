<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/form_article.css">

    <title>Document</title>
</head>
<body>
    <header>
        <div class="nav-bar">
            <ul>
                <a href="membres.php" >Liste des membres</a>
                <a href="articles.php">Liste des articles</a>
                <a href="ajouter_utilisateur.php">ajouter un nouveau membre</a>
                <a href="ajouter_article.php">ajouter un nouvel article</a>
            </ul>
        </div>
    </header>
    <div class="article-box">
    <h2>Nouvel Article</h2>
    <form action="" method="post">
        <div class="insert-box">
            <input type="text" name="typ" autocomplete="off" required="">
            <label>Type</label>
        </div>
        <div class="insert-box">
            <input type="text" name="marq"  autocomplete="off" required="">
            <label>Marque</label>
        </div>
        <div class="insert-box">
            <input type="text" name="model" autocomplete="off" required="">
            <label>Modèle</label>
        </div>
        <div class="insert-box">
            <input type="text" name="sn" autocomplete="off" required="">
            <label>Numéro de série</label>
        </div>
        <div class="insert-box">
            <input type="text" name="rques" autocomplete="off" >
            <label>Ajouter des rémarques</label>
        </div>
        <div class="insert-box">
            <input type="date" name="datachat" autocomplete="off">
            <label>Date d'achat</label>
        </div>
        <a href="">
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
session_start();
if (!$_SESSION['pass']){
    header('Location: connexion.php');
}

try

{

       $bdd = new PDO('mysql:host=localhost;dbname=espace_admin', 'root', '');

}

catch(Exception $e)

{

       die('Erreur : '.$e->getMessage());

}
if (!empty($_POST['typ']) and !empty($_POST['marq']) and !empty($_POST['model']) and !empty($_POST['sn']) and !empty($_POST['datachat'])){
    $typ = $_POST['typ'];
    $marq = $_POST['marq'];
    $model = $_POST['model'];
    $sn = $_POST['sn'];
    $rques = $_POST['rques'];
    $created=  date('Y-m-d');
    $bought=$_POST['datachat'];
    $recupsns=$bdd->prepare('SELECT * FROM articles WHERE sn =?');
    $recupsns->execute(array(strtoupper($sn)));
    if ($recupsns->rowCount()>0){
        ?>
        <p class="p1"><?php echo "cet article existe déja!"; ?></p>
        <?php
        
        }else{
            $req = $bdd->prepare('INSERT INTO articles(type, marque, model,sn,remarques,created_at,bought_at) VALUES(:type, :marque, :model, :sn, :remarques,:created_at,:bought_at)');

            $req->execute(array(
                'type'=> strtoupper($typ),

                'marque'=> strtoupper($marq) ,

                'model'=> strtoupper($model),

                'sn'=>strtoupper($sn),
         
                'remarques'=>strtoupper($rques),

                'created_at'=>$created,

                'bought_at'=>$bought

                
            ));
?>
<p class="p1"><?php echo 'L\'article a bien été ajouté !'; ?></p>
<?php

        }
}else{
    ?>
<p class="p1"><?php echo "Veuillez remplir tous les champs!"; ?></p>
<?php
    
}
?>
</body>
</html>