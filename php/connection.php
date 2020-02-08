<?php
require_once('../config/connect-bdd.php');
session_start();

if(isset($_POST['connexion']))
{
  $username = htmlspecialchars($_POST['pseudo']);
  $password = md5($_POST['password']);
  if(!empty($_POST['username']) AND !empty($_POST['pseudo']))
  {

    $requser = $bdd->prepare("SELECT * from clients WHERE name = ? AND password = ?");
    $requser->execute(array($username, $password));
    $userexist = $requser->rowCount();

    if($userexist ==1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['username'] = $userinfo['name'];
      header("Location : default.php");
    }
    else
    {
      $error = "Le nom d'utilisateur ou le mot de passe ne sont pas valides ! ";
    }

  }
  else
	{

		$error = "Veuillez renseigner tous les champs ! ";

	}
}





?>
<!DOCTYPE html>
<html id=background>
  <head>
      <meta charset="utf-8">
      <link href="../config/stylesheet.css" type="text/css" rel="stylesheet">
      <title>Se connecter</title>
  </head>

<body id=carte>
  <h2 id="titre-h2">Se connecter</h2>
  <br>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../default.php'>Acceuil</a></li>
        <li class="text-navbar lien-navbar">Publier une pause</li>
        <li class="text-navbar lien-navbar">Se connecter</li>
      </ul>
    </div>
    </div>
  </nav>

    <center>
  <form  action="" method="post">

		<table id="table2">

			<tr>
				<td><label for="pseudo">Pseudo : </label></td><td><input type="text" name="pseudo"  placeholder="votre pseudo" value=""><br></td>
			</tr>

			<tr>
				<td><label for="password">Mot de passe : </label></td><td><input type="password" name="password" placeholder="votre mot de passe"value=""></td><br>
			</tr>

			<tr>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td><input style="align-content: center" type="submit"  name="connexion" value="se connecter"></td>
			</tr>


		</table>

	</form>
  <div style="color: red">

		<?php


			if (isset($error))
			{
			echo $error;
			}

		?>
	</div>
</center>


</body>
</html>
