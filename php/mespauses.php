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
           $req = $bdd->prepare("SELECT verif, refclients, txtoriginal, txtcorrige, date_ajout, date_ajout2 from pause WHERE refclients = ? ORDER BY pauseid DESC");
           $req->execute(array($getid));



          ?>
          <!DOCTYPE html>
          <html id=background>
          <head>
            <title>Mes pauses lectures</title>
            <link rel="icon" href="photos/favicon-2.ico" type="image/x-icon"/>
            <meta charset="utf-8" content="width=device-width" name="viewport">
            <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
          </head>
          <body id=carte-mobile>
            <h2 id=titre-h2>Mes pauses lectures</h2>
            <br>
            <div class="user">
              <img class=image-profil src="../<?php echo $userinfo['photo']?>"><br>
              <div class="texte-user-info"><a href="#"><?= $userinfo['name']?><br><?= $userinfo['NOM']?></a></div>
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
            while($donnees = $req->fetch())
            {
              if(isset($donnees['txtoriginal']))
              {

                if($donnees['verif'] == 0)
                {?>
                  <div id=carte-desktop-pause>
                    <div class=pause-lecture-perso>
                      <div class="style-pause">
                      <h4>Pause original</h4><pre><?= $donnees['txtoriginal']?></pre><div class="date_ajout"><?= $donnees['date_ajout'] ?></div> --------------------------------------- <p style="color: red">Votre pause lecture n'a pas encore été corrigé !</p>
                      </div>
                    </div>
                  </div>

                  <?php
                }
                elseif($donnees['verif'] ==1)
                {?>
                  <div id=carte-desktop-pause>
                    <div class=pause-lecture-perso>
                      <div class="style-pause">
                        <h4>Pause original</h4><pre><?= $donnees['txtoriginal']?></pre><div class="date_ajout"><?= $donnees['date_ajout'] ?></div>--------------------------------------- <h4>Pause corrigée</h4><pre><?=$donnees['txtcorrige']?></pre><div class="date_ajout"><?= $donnees['date_ajout2'] ?></div>
                      </div>
                    </div>
                  </div>
                <?}


              }
              else{
                die('ok');
              }




          }

             ?>



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
