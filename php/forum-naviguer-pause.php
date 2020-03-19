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

     if ($_SESSION['name'] == "admin" OR $_SESSION['name'] == "admin_istrator")
     {
       if($getid == $_SESSION['id'])
       {
         if ($account_key == $_SESSION['account_key'])
         {





?>
<!DOCTYPE html>
<html id=background>
<head>
  <title>Naviguer</title>
  <meta charset="utf-8" content="width=device-width" name="viewport">
  <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
</head>
<body id=carte-mobile>
  <h2 id=titre-h2>Voici les dernières pauses-lectures publiques</h2>
  <br>
  <div class="user">
    <img class=image-profil src='../photos/ano.png'><br><div class="texte-user-nom"><?= $_SESSION['name'] ?></div>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
      <br>
      <div class=navbar-content>
        <ul>
          <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
          <li class="text-navbar lien-navbar"><a href='pause-nc.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des pauses lectures à corriger</a></li>
          <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
          <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
          <li class="text-navbar lien-navbar"><a href='mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
          <!--<li class="text-navbar lien-navbar"><a href='php/newtheme.php?id=<=$_SESSION['id']?>&account_key=<=$_SESSION['account_key']?>'>Ajouter un thème</a></li><!-->
          <li class="text-navbar lien-navbar"><a href='bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des élèves</a></li>
          <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div id=carte-desktop-pause>
  <?php
  $requete = $bdd->query('SELECT name, verif, NOM, txtcorrige, photo, date_ajout, date_ajout2, public FROM clients inner join pause on clients.id = pause.refclients WHERE public = 1 ORDER BY pauseid DESC');

  $bpause = false;
  while($donnees = $requete->fetch())
  {
    if(isset($donnees['txtcorrige']) AND $donnees['public'] == 1)
    {
      $bpause = true;
    if($donnees['verif'] == 1 AND $donnees['public'] == 1){
      ?>

    <div id=carte-pause>
      <div class=user-pause><span class=texte-user-info-pause><?= $donnees['name'] ?> <?= $donnees['NOM']?></span><img class=image-pause src='../<?= $donnees['photo'] ?>'></div>

      <div class=pause-lecture-perso>
        <div class="style-pause">
          <textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtcorrige'];?></textarea>

        </div>

        <div class="date_ajout"><?= $donnees['date_ajout2'] ?></div>
      </div>


    </div>

    <br><br><br><br>

  <?php
}
}
}
if(!$bpause)
{
  $sucess = "Il n'y a pas encore de pauses-lecture publiées !";
}
?>
<div style="color:red;"align=center ><?php
if($sucess){
  echo $sucess;
}


   ?>
 </div>

  </div>

</body>
</html>

<?php  }
    }
  }
  else
  {
        ?>
<!DOCTYPE html>
<html id=background>
    <head>
      <title>Blog FR</title>
      <meta charset="utf-8" content="width=device-width" name="viewport">
      <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
    </head>
        <body id=carte-mobile>

        <h2 id=titre-h2>Voici les dernières pauses-lectures</h2>
        <br>
        <div class="user">
          <img class=image-profil src="../<?php echo $_SESSION['photo']?>"><br>
          <div class="texte-user-info"><a href="#"><?= $_SESSION['name']?><br><?= $_SESSION['NOM']?></a></div>
        </div>

        <nav id=navbar>
          <div id=capteur><img class=image-capteur src='../images/dots.png'/>
            <br>
            <div class=navbar-content>
              <ul>
                <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
                <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?php echo $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                <li class="text-navbar lien-navbar"><a href='mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
                <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
              </ul>
            </div>
          </div>
        </nav>


        <div id=carte-desktop-pause>
          <?php
          $requete = $bdd->query('SELECT name, verif, NOM, txtcorrige, photo, date_ajout, date_ajout2, public FROM clients inner join pause on clients.id = pause.refclients ORDER BY pauseid DESC');



          while($donnees = $requete->fetch())
          {
            if($donnees['verif'] == 1 AND $donnees['public'] == 1){
          ?>
            <div id=carte-pause>
              <div class=user-pause><span class=texte-user-info-pause><?= $donnees['name'] ?> <?= $donnees['NOM']?></span><img class=image-pause src='../<?= $donnees['photo'] ?>'></div>
              <div class=pause-lecture-perso>
                <div class="style-pause">
                  <textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtcorrige'];?></textarea>
                </div>
                <div class="date_ajout"><?= $donnees['date_ajout2'] ?></div>
                </div>

            </div>

            <br><br><br><br>

          <?php
                                      }
          }
          if(!isset($donnees['txtoriginal']))
          {
            $sucess = "Il n'y a pas encore de pauses-lecture publiées !";
          }
          ?>
          <div style="color:red;"align=center ><?php
          if($sucess){
            echo $sucess;
          }


             ?>
           </div>

        </div>







        <?php
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
?>
</body>
</html>
