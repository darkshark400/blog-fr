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



?>
<!DOCTYPE html>
<html id=background>
<head>
  <title>Naviguer</title>
  <meta charset="utf-8" content="width=device-width" name="viewport">
  <link rel="stylesheet" href="../config/stylesheet.css">
</head>
<body id=carte-mobile>
  <h2 id="titre-h2">Naviguer</h2>
  <br>
  <div class="user">
    <img class=image-profil src="<?= $userinfo['photo']?>"><br>
    <a href="#"><?= $userinfo['name']?></a>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../default.php'>Accueil</a></li>
        <li class="text-navbar lien-navbar"><a href='../php/forum-deposer-pause.php'>Publier une pause</a></li>
        <li class="text-navbar lien-navbar"><a href='../php/connection.php'>Se deconnecter</a></li>
      </ul>
    </div>
    </div>
  </nav>




  </body>
</html>
<?php }}?>
