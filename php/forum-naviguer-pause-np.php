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

          ?>
          <!DOCTYPE html>
          <html id=background>
          <head>
            <title>Base de données</title>
            <link rel="icon" href="../photos/favicon-2.ico" type="image/x-icon"/>
            <meta charset="utf-8" content="width=device-width" name="viewport">
            <link rel="stylesheet" href="../config/stylesheet.css">
          </head>
          <body id=carte-mobile>
            <h2 id=titre-h2>Voici les dernières pauses lectures non publiques</h2>
            <div class="user">
              <img class=image-profil src="../photos/lhuillier.png"><br>
              <a href="#"><div class="texte-user-info"><?= $_SESSION['name']?></div></a>
            </div>
            <nav id=navbar>
              <div id=capteur><img class=image-capteur src='../images/dots.png'/>
              <br>
              <div class=navbar-content>
                <ul>
                  <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?=$_SESSION['account_key']?>'>Accueil</a></li>
                  <li class="text-navbar lien-navbar"><a href='pause-nc.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des pauses lectures à corriger</a></li>
                  <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                  <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
                  <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
                </ul>
              </div>
              </div>
            </nav><br><br>
            <div id=carte-desktop-pause>
            <?php
            $requete = $bdd->query('SELECT name, verif, NOM, txtcorrige, photo, date_ajout, date_ajout2, public FROM clients inner join pause on clients.id = pause.refclients WHERE public = 0 ORDER BY pauseid DESC');


            while($donnees = $requete->fetch())
            {
              if($donnees['verif'] == 1 AND $donnees['public'] == 0){?>

              <div id=carte-pause>
                <div class=user-pause><span class=texte-user-info-pause><?= $donnees['name'] ?> <?= $donnees['NOM']?></span><img class=image-pause src='../<?= $donnees['photo'] ?>'></div>
                <div class=pause-lecture-perso>
                  <div class="style-pause">
                    <textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtcorrige'];?></textarea><div class="date_ajout"><?= $donnees['date_ajout2'] ?></div>
                    <br>
                      <center><a href="#" style="color:red">Rendre la pause publique</a><center>

                  </div>

                </div>

              </div>

              <br><br><br><br>

            <?php
          }}
            ?>
            </div>

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
    else
    {
      header('Location : ../index1.php');
    }

}
else
{
  header('Location : ../index1.php');
}

 ?>
