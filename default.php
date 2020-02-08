<?php
session_start();
require_once('config/connect-bdd.php');

if(isset($_GET['id'], $_GET['account_key']) AND !empty($_GET['account_key']) AND $_GET['id'] > 0)
{
   $getid = intval($_GET['id']);
   $account_key = htmlspecialchars($_GET['account_key']);
   $requser = $bdd->prepare('SELECT * FROM clients WHERE id = ? AND account_key = ?');
   $requser->execute(array($getid, $account_key));
   $userinfo = $requser->fetch();
   $_SESSION['id'] = $userinfo['id'];
   $_SESSION['name'] = $userinfo['name'];
   $_SESSION['account_key'] = $userinfo['account_key'];
   if ($userinfo['name'] == "admin")
   {
     if($getid == $userinfo['id'])
     {
       if ($account_key == $userinfo['account_key'])
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
  <h2 id=titre-h2>Bienvenue sur le blog de français</h2>
  <br>
  <div class="user">
    <img class=image-profil src='photos/martin.png'><br><?= $userinfo['name'] ?>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='images/dots.png'/>
      <br>
      <div class=navbar-content>
        <ul>
          <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause.php'>Naviguer</a></li>
          <li class="text-navbar lien-navbar"><a href='php/bdd.php?id=<?php $_SESSION['id']?>&account_key=<?php $_SESSION['account_key']?>'>Acceder à la base de données</a></li>
          <li class="text-navbar lien-navbar"><a href='php/deconnection.php'>Se déconnecter</a></li>
        </ul>
      </div>
    </div>
  </nav>


<?php }
      else
      {
        ?>
        <h2 id=titre-h2>Bienvenue sur le blog de français</h2>
        <br>
        <div class="user">
          <a href="php/profil.php"><?= $userinfo['name']?><div class=image-profil><img src='photos/martin.png'></div>
        </div>
        <nav id=navbar>ooooo
          <div id=capteur><img class=image-capteur src='images/dots.png'/>
            <br>
            <div class=navbar-content>
              <ul>
                <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause.php'>Naviguer</a></li>
                <li class="text-navbar lien-navbar"><a href='view/forum-deposer-pause.view.html'>Publier une pause</a></li>
                <li class="text-navbar lien-navbar"><a href='php/deconnection.php'>Se déconnecter</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <?php
      }
    }
  }
}
?>
</body>
</html>
