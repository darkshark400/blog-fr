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
            <title>Les thèmes</title>
            <link rel="stylesheet" href="../config/stylesheet.css">
          </head>

          <body id=carte-mobile>
            <h2 id=titre-h2>Ajouter un nouveau thème</h2>
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
                    <li class="text-navbar lien-navbar"><a href='pause-nc.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des pauses lectures à corriger</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                    <li class="text-navbar lien-navbar"><a href='mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
                    <li class="text-navbar lien-navbar"><a href='bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Listes des élèves</a></li>
                    <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
                  </ul>
                </div>
              </div>
            </nav>

            <div id=carte-pause>
            <div class=pause-lecture>
              <form method="post" action="correct.php?id=<?= $pauseid ?>"class=texte-area-position>
                <textarea class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtoriginal'];?></textarea><br>
                <br><textarea class='com-pause' name="commentaire" type="textarea" placeholder="Commentaires" style="color:red"></textarea>
                <br>
                <input type="submit" value="Corriger" id='btn_<?= $pauseid ?>' name='btn_<?= $pauseid ?>'>
                <input type="hidden" name="hidden_id" id="hidden_id">
              </form>

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
