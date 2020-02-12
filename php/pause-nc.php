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
           $req = $bdd->query('SELECT * from pause ORDER BY id DESC');


?>
<!DOCTYPE html>
<html id=background>
  <head>
    <meta charset="utf-8" content="width=device-width" name="viewport">
    <link rel="icon" href="../photos/favicon-2.ico" type="image/x-icon"/>
    <title>Pauses lectures</title>
    <link rel="stylesheet" href="../config/stylesheet.css">
  </head>

  <body id=carte-mobile>
    <h2 id=titre-h2>Voici les pauses lectures non corrigées</h2>
    <br>
    <div class="user">
      <img class=image-profil src='../photos/lhuillier.png'><br><div class=texte-user-info><?= $userinfo['name'] ?></div>
    </div>
    <nav id=navbar>
      <div id=capteur><img class=image-capteur src='../images/dots.png'/>
        <br>
        <div class=navbar-content>
          <ul>
            <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
            <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Naviguer</a></li>
            <li class="text-navbar lien-navbar"><a href='bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accéder à la base de données</a></li>
            <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <div id=carte-desktop-pause>
  <?php
  while($donnees = $req->fetch())
  {
  ?>
  <div id=carte-pause>
  <div class=user-pause>Romuald</div>
  <div class=pause-lecture>
    <form  method="post" action="correct.php" class=texte-area-position>
      <textarea class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['nonverif'];?></textarea><br>
      <input type="submit" value="Corriger" name="corriger">
    </form>
  </div>
  </div>
  <?php
  }
  ?>
  </div>

</body>
</html>

<?php


          }
          else{
            header('Location : ../index1.php');
          }

        }
        else{
          header('Location : ../index1.php');
        }
      }
      else{
        header('Location : ../index1.php');
      }
}
else{
  header('Location : ../index1.php');
}
?>