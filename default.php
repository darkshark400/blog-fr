<?php
session_start();
require_once('config/connect-bdd.php');

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
     $_SESSION['id'] = $userinfo['id'];
     $_SESSION['name'] = $userinfo['name'];
     $_SESSION['account_key'] = $userinfo['account_key'];
     if ($userinfo['name'] == "admin" OR $userinfo['name'] == "admin_istrator")
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
    <img class=image-profil src='photos/lhuillier.png'><br><?= $userinfo['name'] ?>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='images/dots.png'/>
      <br>
      <div class=navbar-content>
        <ul>
          <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Naviguer</a></li>
          <li class="text-navbar lien-navbar"><a href='php/bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Acceder à la base de données</a></li>
          <li class="text-navbar lien-navbar"><a href='php/deconnection.php'>Se déconnecter</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br>
  <div id=carte-desktop>
    <h2 class=titre-h2>Sur ce blog vous trouverez toutes les pauses lecture de la Seconde Rouge.</h2>



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
      <link rel="stylesheet" type="text/css" href="config/stylesheet.css">
    </head>
        <body id=carte-mobile>

        <h2 id=titre-h2>Bienvenue sur le blog de français</h2>
        <br>
        <div class="user">
          <img class=image-profil src="<?php echo $userinfo['photo']?>"><br>
          <a href="php/profil.php"><?= $userinfo['name']?></a>
        </div>
        <nav id=navbar>
          <div id=capteur><img class=image-capteur src='images/dots.png'/>
            <br>
            <div class=navbar-content>
              <ul>
                <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause.php?id=<?= $userinfo['id']?>&account_key=<?= $userinfo['account_key']?>'>Naviguer</a></li>
                <li class="text-navbar lien-navbar"><a href='php/forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                <li class="text-navbar lien-navbar"><a href='php/deconnection.php'>Se déconnecter</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div id=carte-desktop>
          <h2 class=titre-h2>Sur ce blog vous trouverez toutes les pauses lecture de la Seconde Rouge</h2>



        </div>
        <?php
    }
}
else
{
  header('Location : index1.php');

}
}
else {
  header('Location : index1.php');
}
?>
</body>
</html>
