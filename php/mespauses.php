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
           $req = $bdd->prepare("SELECT verif, refclients, txtoriginal, txtcorrige, date_ajout, date_ajout2, commentaire from pause WHERE refclients = ? ORDER BY pauseid DESC");
           $req->execute(array($getid));
           if ($_SESSION['name'] == "Mme LHUILLIER" OR $_SESSION['name'] == "admin_istrator")
           {



          ?>
          <html id=background>
          <head>
            <title>Mes pauses-lectures</title>
            <meta charset="utf-8" content="width=device-width" name="viewport">
            <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
          </head>
          <body id=carte-mobile>
            <h2 id=titre-h2>Mes pauses-lectures</h2>
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
                    <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id'] ?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
                    <li class="text-navbar lien-navbar"><a href='pause-nc.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des pauses lectures à corriger</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                    <li class="text-navbar lien-navbar"><a href='newtheme.php?id=<?=$_SESSION['id']?>&account_key=<?=$_SESSION['account_key']?>'>Ajouter un thème</a></li>
                    <li class="text-navbar lien-navbar"><a href='bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des élèves</a></li>
                    <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
                  </ul>
                </div>
              </div>
            </nav>
            <br><br>

            <?php
            $bpause = false;
            while($donnees = $req->fetch())
            {

              if(isset($donnees['txtoriginal']))
              {
                $bpause = true;

                if(isset($donnees['verif']) AND $donnees['verif'] == 0)
                {?>
                  <div id=carte-desktop-pause>
                    <div class=pause-lecture-perso>
                      <div class="style-pause">
                        <h4>Pause original</h4>
                        <textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtoriginal'];?></textarea><br><div class="date_ajout"><?= $donnees['date_ajout'] ?></div>
                        --------------------------------------- <p style="color: red">Votre pause-lecture n'a pas encore été corrigée !</p>
                      </div>
                    </div>
                  </div>

                  <?php
                }
                elseif(isset($donnees['verif']) AND $donnees['verif'] == 1)
                {?>
                  <div id=carte-desktop-pause>
                    <div class=pause-lecture-perso>
                      <div class="style-pause">
                        <h4>Pause originale</h4>
                        <pre><textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtoriginal'];?></textarea></pre><br><div class="date_ajout"><?= $donnees['date_ajout'] ?></div>
                        ---------------------------------------
                        <h4>Pause corrigée</h4>
                        <pre><textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?=$donnees['txtcorrige']?></textarea></pre><br><textarea readonly=readonly class='com-pause2' name="commentaire" type="textarea" style="color:red"><?= $donnees['commentaire'] ?></textarea>
                        <div class="date_ajout"><?= $donnees['date_ajout2'] ?></div>
                      </div>
                    </div>
                  </div>


                <?}


              }


            }

          if(!$bpause)
          {
            $sucess = "Vous n'avez pas encore publié de pauses-lecture !" ;
          }
          ?><div style="color:red;"align=center ><?php
          if($sucess){
            echo $sucess;
          }



             ?>
           </div>




          </body>
          </html>

        <?php }else{ ?>
          <!DOCTYPE html>
          <html id=background>
          <head>
            <title>Mes pauses-lectures</title>
            <meta charset="utf-8" content="width=device-width" name="viewport">
            <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
          </head>
          <body id=carte-mobile>
            <h2 id=titre-h2>Mes pauses-lectures</h2>
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
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                    <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
                  </ul>
                </div>
              </div>
            </nav>
            <br><br>

            <?php
            $bpause = false;
            while($donnees = $req->fetch())
            {

              if(isset($donnees['txtoriginal']))
              {
                $bpause = true;

                if(isset($donnees['verif']) AND $donnees['verif'] == 0)
                {?>
                  <div id=carte-desktop-pause>
                    <div class=pause-lecture-perso>
                      <div class="style-pause">
                        <h4>Pause original</h4>
                        <textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtoriginal'];?></textarea><br><div class="date_ajout"><?= $donnees['date_ajout'] ?></div>
                        --------------------------------------- <p style="color: red">Votre pause-lecture n'a pas encore été corrigée !</p>
                      </div>
                    </div>
                  </div>

                  <?php
                }
                elseif(isset($donnees['verif']) AND $donnees['verif'] == 1)
                {?>
                  <div id=carte-desktop-pause>
                    <div class=pause-lecture-perso>
                      <div class="style-pause">
                        <h4>Pause originale</h4>
                        <pre><textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?php echo $donnees['txtoriginal'];?></textarea></pre><br><div class="date_ajout"><?= $donnees['date_ajout'] ?></div>
                        ---------------------------------------
                        <h4>Pause corrigée</h4>
                        <pre><textarea readonly="readonly" class="texte-area-pause" name="pause" type='textarea'><?=$donnees['txtcorrige']?></textarea></pre><br><textarea readonly=readonly class='com-pause2' name="commentaire" type="textarea" style="color:red"><?= $donnees['commentaire'] ?></textarea>
                        <div class="date_ajout"><?= $donnees['date_ajout2'] ?></div>
                      </div>
                    </div>
                  </div>
                <?}


              }


            }

          if(!$bpause)
          {
            $sucess = "Vous n'avez pas encore publié de pauses-lecture !" ;
          }
          ?><div style="color:red;"align=center ><?php
          if($sucess){
            echo $sucess;
          }



             ?>
           </div>




          </body>
          </html>


<?php

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
      header('Location : ../index1.php');
    }
}
else{
  $_SESSION = array();
  session_destroy();
  header('Location : ../index1.php');}

?>
