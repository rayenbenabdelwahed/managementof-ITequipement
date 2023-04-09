<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/form_user.css">
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
   <div class="user-box">
    <h2>Nouveau Membre</h2>
    <form action="" method="post">
        <div class="insert-box">
           
            <input type="text" name="nom" autocomplete="off" required="">
            <label>Nom du membre</label>
        </div>
        <div class="insert-box">
            
            <input type="text" name="prenom" autocomplete="off" required="">
            <label> Prénom du membre</label>
        </div>
        <div class="insert-box">
            
            <input type="text" name="iduni" autocomplete="off" required="">
            <label>Identifiant unique</label>
        </div>
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
if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['iduni']) and !empty($_POST['dist']) and !empty($_POST['centre']) and !empty($_POST['place'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id = $_POST['iduni'];
    $dist=$_POST['dist'];
    $centre=$_POST['centre'];
    $det=$_POST['place'];
    $recupids=$bdd->prepare('SELECT * FROM membres WHERE id =?');
    $recupids->execute(array($id));
    if ($recupids->rowCount()>0){
        ?>
        <p class="p1"><?php echo "cet utilisateur existe déja"; ?></p>
        <?php
        
        }else{
            $req = $bdd->prepare('INSERT INTO membres(nom, prenom, id, district, centre,place) VALUES(:nom, :prenom, :id, :district, :centre,:place)');
            $req->execute(array(
                
                'nom'=>strtoupper($nom),

                'prenom'=> strtoupper($prenom),

                'id'=> $id,

               'district'=>strtoupper($dist),

               'centre'=>strtoupper($centre),

               'place'=>strtoupper($det)
             ));
            
            ?>
            <p class="p1"><?php echo "le nouveau utilisateur a bien été ajouté "; ?></p>
            <?php
            
            
        }
    
}else{
            ?>
            <p class="p1"><?php  echo "Veuillez remplir tous les champs!"; ?></p>
            <?php
   
}
?>
<script src="javascript.js"></script>
</body>
</html>