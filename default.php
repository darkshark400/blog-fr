<?php
session_start();
require_once('config/connect-bdd.php');

if(isset($_GET['id'], $_GET['account_key']) AND !empty($_GET['account_key']) AND $_GET['id'] > 0)
{


    if(isset($_GET['public']))
    {
      if($_GET['public'] == 1)
      {
        ?><script>alert("Votre pause a été envoyée pour une correction auprès de votre professeur.\n\r Elle sera rendue publique par la suite!");</script><?php
      }
      else
      {
        ?><script>alert("Votre pause a été envoyée pour une correction auprès de votre professeur.\n\r Elle ne sera pas rendue publique par la suite!");</script><?php
      }
    }
    if($_SESSION['np'] == 0)
    {
      header("Location: php/newpass.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);
    }
    if($_SESSION['nm'] == 0)
    {
      header("Location: php/newmail.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);
    }


   $getid = intval($_GET['id']);
   $account_key = htmlspecialchars($_GET['account_key']);
   $requser = $bdd->prepare('SELECT * FROM clients WHERE id = ? AND account_key = ?');
   $requser->execute(array($getid, $account_key));
   $userexist = $requser->rowCount();
   if($userexist == 1)
   {
     $userinfo = $requser->fetch();
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
            <title>Blog FR</title>
            <meta charset="utf-8" content="width=device-width" name="viewport">
            <link rel="stylesheet" type="text/css" href="config/stylesheet.css">
          </head>
          <body id=carte-mobile>
            <h2 id=titre-h2>Blog de Français 2nde rouge Pauses lecture/écriture.</h2>
            <br>
            <div class="user">
              <img class=image-profil src='photos/ano.png'><br><div class="texte-user-info"><?= $_SESSION['name'] ?></div>
            </div>
            <nav id=navbar>
              <div id=capteur><img class=image-capteur src='images/dots.png'/>
                <br>
                <div class=navbar-content>
                  <ul>
                    <li class="text-navbar lien-navbar"><a href='php/pause-nc.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des pauses lectures à corriger</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
                    <!--<li class="text-navbar lien-navbar"><a href='php/newtheme.php?id=<=$_SESSION['id']?>&account_key=<= $_SESSION['account_key']?>'>Ajouter un thème</a></li><!-->
                    <li class="text-navbar lien-navbar"><a href='php/bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des élèves</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/deconnection.php'>Se déconnecter</a></li>
                  </ul>
                </div>
              </div>
            </nav>
            <br><br><br><br>
            <div id=carte-desktop>
              <h2 class=titre-h2>Sur ce blog vous trouverez toutes les pauses-lecture de la Seconde Rouge.</h2>



            </div>
          </body>
          </html>

          <?php
        }
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
          <link rel="stylesheet" type="text/css" href="config/stylesheet.css">
        </head>
            <body id=carte-mobile>

            <h2 id=titre-h2>Blog de Français 2nde rouge Pauses lecture/écriture.</h2>
            <br>
            <div class="user">
              <img class=image-profil src="<?php echo $_SESSION['photo']?>"><br>
              <div class="texte-user-info"><a href="php/profil.php"><?= $_SESSION['name']?><br><?= $_SESSION['NOM']?></a></div>
            </div>
            <nav id=navbar>
              <div id=capteur><img class=image-capteur src='images/dots.png'/>
                <br>
                <div class=navbar-content>
                  <ul>
                    <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
                    <li class="text-navbar lien-navbar"><a href='php/deconnection.php'>Se déconnecter</a></li>
                  </ul>
                </div>
              </div>
            </nav>
            <br><br><br><br>
            <div id=carte-desktop>
              <h2 class=titre-h2>Sur ce blog vous trouverez toutes les pauses-lecture de la Seconde Rouge</h2>



            </div>
            <?php
        }
      }
      else
      {
        $_SESSION = array();
        session_destroy();
        header('Location : index1.php');

      }
      }
      else {
        $_SESSION = array();
        session_destroy();
        header('Location : index1.php');
}
?>
</body>
</html>
