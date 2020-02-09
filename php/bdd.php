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

       if($getid == $userinfo['id'])
       {
         if ($account_key == $userinfo['account_key'])
         {
           $req = $bdd->query('SELECT * from clients ORDER BY id DESC');


?>
<!DOCTYPE html>
<html id=background>
<head>
  <title>Base de données</title>
  <meta charset="utf-8" content="width=device-width" name="viewport">
  <link rel="stylesheet" href="../config/stylesheet.css">
</head>
<body id=carte-mobile>
  <h2 id=titre-h2>Base de données</h2>
  <div class="user">
    <img class=image-profil src="<?= $userinfo['photo']?>"><br>
    <a href="#"><?= $userinfo['name']?></a>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Naviguer</a></li>
        <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?=$_SESSION['account_key']?>'>Accueil</a></li>
        <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
      </ul>
    </div>
    </div>
  </nav><br><br>
  <?php

  while($donnees = $req->fetch()){?>
		<li><?php
			 echo $donnees['id']; ?> : <ins><?= $donnees['name'] ?></ins>  <?php } ?></li>





</body>
</html>
<?php
      }
      else
      {
        header('Location : ../index1.php');
      }
    }
    else
    {
      header('Location : ../index1.php');
    }

  }
  else {
    header('Location : ../index1.php');

  }

}
else {
  header('Location : ../index1.php');
}

?>
