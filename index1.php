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
    <?= $userinfo['name'] ?>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='images/dots.png'/>
      <br>
      <div class=navbar-content>
        <ul>
          <li class="text-navbar lien-navbar"><a href='php/forum-naviguer-pause.php'>Naviguer</a></li>
          <li class="text-navbar lien-navbar"><a href='view/forum-deposer-pause.view.html'>Publier une pause</a></li>
          <li class="text-navbar lien-navbar"><a href='php/connection.php'>Se connecter</a></li>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>