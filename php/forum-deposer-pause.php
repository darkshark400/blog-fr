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

     $userinfo = $requser->fetch();





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
    <img class=image-profil src="../<?php echo $userinfo['photo']?>"><br>
    <a href="php/profil.php"><?= $userinfo['name']?>-<?= $userinfo['NOM']?></a>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $userinfo['id'] ?>&account_key=<?= $userinfo['account_key']?>'>Accueil</a></li>
        <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $userinfo['id'] ?>&account_key=<?= $userinfo['account_key']?>'>Naviguer</a></li>
        <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
      </ul>
    </div>
    </div>
  </nav>
  <center id=carte-desktop>


    <form enctype="multipart/form-data" action="upload.php" method="post">
  <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
  Envoyez ce fichier : <input name="userfile" type="file" />
  <input type="submit" value="Envoyer le fichier" />
</form>

<br><br>

<form>
  <input type="text">
  <input type="submit" value="Envoyer">
</form>






  <center>
</body>
</html>
<?php
  }
  else {

    header('Location : ../index1.php');
  }

}
?>
