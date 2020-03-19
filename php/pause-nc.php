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
            <meta charset="utf-8" content="width=device-width" name="viewport">
            <title>Pauses-lectures</title>
            <link rel="stylesheet" href="../config/stylesheet.css">
          </head>

          <body id=carte-mobile>
            <h2 id=titre-h2>Voici les pauses-lectures non corrigées</h2>
            <br>
            <div class="user">
              <img class=image-profil src='../photos/ano.png'><br><div class=texte-user-info><?= $_SESSION['name'] ?></div>
            </div>
            <nav id=navbar>
              <div id=capteur><img class=image-capteur src='../images/dots.png'/>
                <br>
                <div class=navbar-content>
                  <ul>
                    <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Listes des élèves</a></li>
                    <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
                  </ul>
                </div>
              </div>
            </nav>

            <div id=carte-desktop-pause>


            <?php

            $req = $bdd->query('SELECT name, txtoriginal, pauseid, photo, NOM FROM pause INNER JOIN clients ON pause.refclients = clients.id WHERE verif= 0 ORDER BY pauseid DESC');

            $button = array();


            $bpause = false;
            while($donnees = $req->fetch())
            {
              if(isset($donnees['txtoriginal']))
              {
                $bpause = true;

              $pauseid = $donnees['pauseid'];
              $button[] = $pauseid;

            ?>

            <div id=carte-pause>
            <div class=user-pause><span class=texte-user-info-pause><?= $donnees['name'] ?> <?= $donnees['NOM']?></span><img class=image-pause src='../<?= $donnees['photo'] ?>'></div>
            <div class=pause-lecture>
              <form method="post" action="correct.php?id=<?= $pauseid ?>"class=texte-area-position>
                <textarea class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtoriginal'];?></textarea><br>
                <br><input type="submit" value="Corriger" id='btn_<?= $pauseid ?>' name='btn_<?= $pauseid ?>'>
                <input type="hidden" name="hidden_id" id="hidden_id">
              </form>
            </div>
            </div>
            <?php
              }
            }
            if(!$bpause)
            {
              $sucess = "Il n'y a pas encore de pauses-lecture à corriger !";
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


        <?php





          }
          else{
            $_SESSION = array();
            session_destroy();
            header('Location : ../index1.php');
          }

        }
        else{
          $_SESSION = array();
          session_destroy();
          header('Location : ../index1.php');
        }
      }
      else{
        $_SESSION = array();
        session_destroy();
        header('Location : ../index1.php');
      }
}
else{
  $_SESSION = array();
  session_destroy();
  header('Location : ../index1.php');}
?>
