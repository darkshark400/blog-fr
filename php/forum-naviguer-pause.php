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
  <link rel="icon" href="../photos/favicon-2.ico" type="image/x-icon"/>
  <title>Naviguer</title>
  <meta charset="utf-8" content="width=device-width" name="viewport">
  <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
</head>
<body id=carte-mobile>
  <h2 id=titre-h2>Voici les dernières pauses lectures</h2>
  <br>
  <div class="user">
    <img class=image-profil src='../photos/lhuillier.png'><br><?= $userinfo['name'] ?>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
      <br>
      <div class=navbar-content>
        <ul>
          <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
          <li class="text-navbar lien-navbar"><a href='bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Acceder à la base de données</a></li>
          <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
        </ul>
      </div>
    </div>
  </nav>
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
      <link rel="icon" href="../photos/favicon-2.ico" type="image/x-icon"/>
      <title>Blog FR</title>
      <meta charset="utf-8" content="width=device-width" name="viewport">
      <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
    </head>
        <body id=carte-mobile>

        <h2 id=titre-h2>Voici les dernières pauses lectures</h2>
        <br>
        <div class="user">
          <img class=image-profil src="../<?php echo $userinfo['photo']?>"><br>
          <a href="#"><?= $userinfo['name']?>-<?= $userinfo['NOM']?></a>
        </div>


      <div id=carte-desktop>
        <p>Capiti saepeque bella Pisidiae praedatricibus haec quibus tamen iactitabant hac inpunitate perduelles pernicies inopinis spiritus quibus spiritus saepeque haec motibus consortes morem miscere cladibus et inpunitate et eorum est et audaciam saepe Isauri tamen excursibus Isauri pacari in pacari perciti eorum indignitate gravia in diversis raris erigentes inpunitate et peius et orientem diversis in perciti praeter Pisidiae quod hac quidem erigentes iactitabant feris quidem peius obiecti sane quidam quidam perduelles motibus spiritus apud vehementer pernicies excursibus sunt eorum haec indignitate hac inrequietis cuncta raris perduelles in praeter cuncta sola miscere praedatricibus morem raris gravia perciti perciti adfligebat peius motibus excursibus.</p>
      </div>
     <!-- afficher les pauses -->




        <nav id=navbar>
          <div id=capteur><img class=image-capteur src='../images/dots.png'/>
            <br>
            <div class=navbar-content>
              <ul>
                <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
                <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?php echo $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
              </ul>
            </div>
          </div>
        </nav>

        <?php
    }
}
else
{
  header('Location : ../index1.php');

}
}
else {
  header('Location : ../index1.php');
}
?>
</body>
</html>
