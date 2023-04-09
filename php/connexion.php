<?php
session_start();
if(isset($_POST['sub'])){
    if(!empty($_POST['user']) and !empty($_POST['pass'])){
        $user_default="admin";
        $pass_default="admin1234";

        $user_saisi = htmlspecialchars($_POST['user']);
        $pass_saisi =htmlspecialchars($_POST['pass']);

        if ($user_default==$user_saisi and $pass_default==$pass_saisi){
            $_SESSION['pass']=$pass_saisi;
            header('Location: index.php');
        }
        else{
            ?>
            <p class="p1"><?php  echo "Vérifiez vos coordonnées"; ?></p>
            <?php
           
        }
    }
    else{
        ?>
        <p class="p1"><?php echo "Veuillez compléter tous les champs..."; ?></p>
        <?php
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/connexion_admin.css">
    <title>Admin Connexion</title>
</head>
<body>
    <img src="Logo_STS.png" alt="" class="logo">
    <div class="user-box">
        <h2>Connexion Espace Administrateur</h2>
        <form method="post" action="">
            <div class="insert-box">
                <input type="text" name="user" required="" autocomplete="off"> 
                <label>Admin</label> 
            </div>
            <div class="insert-box">
                <input type="password" name="pass" required="" autocomplete="off">
                <label>Mot de passe</label>
            </div>
            <a href="#">
                <div class="sub">
                    <input type="submit" name="sub" value="Connecter">
                </div>
            </a>
        </form>
    </div>
</body>
</html>




