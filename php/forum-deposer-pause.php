<?php
session_start();
require_once('../config/connect-bdd.php');



if(isset($_GET['id'], $_GET['account_key']) AND !empty($_GET['account_key']) AND $_GET['id'] > 0)
{

   $getid = intval($_GET['id']);
   $account_key = htmlspecialchars($_GET['account_key']);
   $requser = $bdd->prepare('SELECT * FROM clients WHERE id = ? AND account_key = ?');
   $requser->execute(array($getid, $account_key));
   $userexist = $requser->rowCount();
   if($userexist == 1)
   {

     





 ?>
<!DOCTYPE html>
<html id=background>
<head>
  <link rel="icon" href="../photos/favicon-2.ico" type="image/x-icon"/>
  <title>Blog FR</title>
  <meta charset="utf-8" content="width=device-width" name="viewport">
  <link rel="stylesheet" href="../config/stylesheet.css">
</head>
<body id=carte-mobile>
  <h2 id=titre-h2>Publier une pause</h2>
  <br>
  <div class="user">
    <img class=image-profil src="../<?php echo $_SESSION['photo']?>"><br>
    <a href="php/profil.php"><div class=texte-user-info><?= $_SESSION['name']?><br><?= $_SESSION['NOM']?></div></a>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id'] ?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
        <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id'] ?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
        <li class="text-navbar lien-navbar"><a href='mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
        <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
      </ul>
    </div>
    </div>
  </nav>
  <center id=carte-desktop>





<br><br>

<form  method="post" action="">
  <textarea class="form1" name="pause" type='textarea ' placeholder="Tapez votre texte"></textarea><br>
  <input type="submit" value="Envoyer" name="publier"><br>
  <input type="checkbox" name="checkbox" id="checkbox" /><label for="checkbox">Voulez-vous rendre publique votre pause après la correction?</label>
</form>
<?php
session_start();
require_once('../config/connect-bdd.php');

if(isset($_POST['publier']))
{

  $pause = $_POST['pause'];
  $req = $bdd->prepare('INSERT INTO pause (txtoriginal, refclients, verif, date_ajout) VALUES (?, ?, 0, NOW())');
  $req->execute(array($pause, $getid));

  $succes = 'Votre pause lecture a bien été envoyé à votre professeur pour une correction';


}



?>

<div style='color : red'>
<?php

if(isset($succes))
{
  echo $succes;
}


?>
</div>



  <center>
</body>
</html>
<?php
  }
  else {

    header('Location : ../index1.php');
  }

}
else {
  header('Location : ../index1.php');

}
?>
