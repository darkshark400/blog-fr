<?php
session_start();
require_once('../config/connect-bdd.php');



if(isset($_POST['connexion']))
{
  $username = htmlspecialchars($_POST['pseudo']);
  $password = md5($_POST['password']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['password']))
    {

      $requser = $bdd->prepare("SELECT * from clients WHERE name = ? AND password = ?");
      $requser->execute(array($username, $password));
      $userexist = $requser->rowCount();

      if($userexist == 1)
      {
        $userinfo = $requser->fetch();
        $_SESSION['id'] = $userinfo['id'];
        $_SESSION['name'] = $userinfo['name'];
        $_SESSION['account_key'] = $userinfo['account_key'];
        $_SESSION['NOM'] = $userinfo['NOM'];
        $_SESSION['photo'] = $userinfo['photo'];
        $_SESSION['refclients'] = $userinfo['refclients'];
        $_SESSION['np'] = $userinfo['np'];
        $_SESSION['nm'] = $userinfo['nm'];
        $_SESSION['mdpid'] = $userinfo['mdp'];

        if($_SESSION['mdpid'] != 1)
        {
          $reqmdp = $bdd->prepare('UPDATE clients SET mdp = ?, mdpid = 1 WHERE $_SESSION["name"] = ?');
          $reqmdp->execute(array($_POST['password'], $username))
        }


        header("Location: ../default.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);

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
      <meta charset="utf-8" content="width=device-width" name="viewport">
      <link href="../config/stylesheet.css" type="text/css" rel="stylesheet">
      <title>Se connecter</title>
  </head>

<body id=carte-mobile>
  <h2 id="titre-h2">Se connecter</h2>
  <br>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../index1.php'>Accueil</a></li>


      </ul>
    </div>
    </div>
  </nav>
  <br><br><br>
  <center id=carte-desktop>
  <form  action="" method="post">

		<table>

			<tr>
				<td><label for="pseudo" class="text-connexion">Pseudo : </label></td><td class="box-connexion"><input type="text" name="pseudo" placeholder="votre pseudo" value="<?= $username?>"><br></td>
			</tr>

			<tr>
				<td><label for="password" class="text-connexion">Mot de passe : </label></td><td class="box-connexion"><input type="password" name="password" placeholder="votre mot de passe"value=""></td><br>
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
