<!DOCTYPE html>
<html id=background>
<head>
  <title>Blog FR</title>
  <meta charset="utf-8" content="width=device-width" name="viewport">
  <link rel="stylesheet" href="../config/stylesheet.css">
</head>
<body id=carte-mobile>
  <h2 id=titre-h2>Publier une pause</h2>
  <br>
  <div class="user">
    <img class=image-profil src="<?php echo $userinfo['photo']?>"><br>
    <a href="php/profil.php"><?= $userinfo['name']?></a>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../php/forum-naviguer-pause.php'>Naviguer</a></li>
        <li class="text-navbar lien-navbar"><a href='../php/connection.php'>Se déconnecter</a></li>
      </ul>
    </div>
    </div>
  </nav>
  <center id=carte-desktop>

    <form method="post" enctype="multipart/form-data">
      <div>
        <label for="file" class=text-deposer-fichier>Sélectionner le fichier à envoyer</label>
        <br><br>
        <input type="file" id="file" class=text-deposer-fichier name="file" multiple>
      </div>
      <br>
      <div>
        <button>Envoyer</button>
      </div>
    </form>






  <center>
</body>
</html>
