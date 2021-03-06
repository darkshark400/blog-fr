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
       if($getid == $_SESSION['id'])
       {
         if ($account_key == $_SESSION['account_key'])
         {
           $req = $bdd->query('SELECT name, NOM, id, nbpause FROM clients left join (SELECT refclients, COUNT(*) as nbpause FROM pause GROUP BY refclients) as countpause on clients.id =  countpause.refclients WHERE id < 100 ORDER BY NOM');




?>
<!DOCTYPE html>
<html id=background>
<head>
  <title>Liste des élèves</title>
  <meta charset="utf-8" content="width=device-width" name="viewport">
  <link rel="stylesheet" href="../config/stylesheet.css">
</head>
<body id=carte-mobile>
  <h2 id=titre-h2>Liste des élèves</h2>
  <div class="user">
    <img class=image-profil src="../photos/ano.png"><br>
    <a href="#"><div class="texte-user-info"><?= $_SESSION['name']?></div></a>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?=$_SESSION['account_key']?>'>Accueil</a></li>
        <li class="text-navbar lien-navbar"><a href='pause-nc.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des pauses-lectures à corriger</a></li>
        <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
        <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
        <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
        <li class="text-navbar lien-navbar"><a href='mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
        <li class="text-navbar lien-navbar"><a href='newtheme.php?id=<?=$_SESSION['id']?>&account_key=<?=$_SESSION['account_key']?>'>Ajouter un thème</a></li>
        <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
      </ul>
    </div>
    </div>
  </nav><br><br>

  <div id=carte-desktop>

  <?php
  while($donnees = $req->fetch()){  ?>
      <div class=texte-base-de-donnee>
      <div class=texte-base-de-donnee-1><?=$donnees['id']?></div>
      <div class=texte-base-de-donnee-2> : </div>
      <div class=texte-base-de-donnee-3><ins><?=$donnees['NOM']?></ins>  <?=$donnees['name']?> </div>
      <?php if(isset($donnees['nbpause'])) { ?><div class=nbpause><?= $donnees['nbpause']?></div><?php }?>
      </div>
      <br>
    <?php } ?>
  </div>
  <br><br>



</body>
</html>
<?php
      }
      else
      {
        $_SESSION = array();
        session_destroy();
        header('Location : ../index1.php');
      }
    }
    else
    {
      $_SESSION = array();
      session_destroy();
      header('Location : ../index1.php');
    }

  }
  else {
    $_SESSION = array();
    session_destroy();
    header('Location : ../index1.php');

  }

}
else {
  $_SESSION = array();
  session_destroy();
  header('Location : ../index1.php');
}

?>
