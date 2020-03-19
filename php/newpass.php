<?php
session_start();
require_once('../config/connect-bdd.php');

if(isset($_GET['id'], $_GET['account_key']) AND !empty($_GET['account_key']) AND $_GET['id'] > 0)
{







?>
<!DOCTYPE html>
<html id=background>
    <head>
      <title>Blog FR</title>
      <meta charset="utf-8" content="width=device-width" name="viewport">
      <link rel="stylesheet" type="text/css" href="../config/stylesheet.css">
    </head>
        <body id=carte-mobile>

        <h2 id=titre-h2>Changement de mot de passe</h2>
        <br>
        <div class="user">
          <img class=image-profil src="../<?php echo $_SESSION['photo']?>"><br>
          <div class="texte-user-info"><a href="php/profil.php"><?= $_SESSION['name']?><br><?= $_SESSION['NOM']?></a></div>
        </div>

        <br><br><br><br>
        <div id=carte-desktop>
          <h2 class=titre-h2>Pour plus de sécurité, nous vous demandons de changer votre mot de passe.</h2>

        </div><br><br>

        <center id=carte-desktop>
        <form  action="np.php?id=<?= $_SESSION['id']?>" method="post">

      		<table>


      			<tr>
      				<td><label for="password" class="text-connexion">Nouveau mot de passe : </label></td><td class="box-connexion"><input type="password" name="password" placeholder="votre nouveau mot de passe"value=""></td><br>
      			</tr>

            <tr>
      				<td><label for="password" class="text-connexion">Confirmez le nouveau mot de passe : </label></td><td class="box-connexion"><input type="password" name="password1" placeholder="votre nouveau mot de passe"value=""></td><br>
      			</tr>

      			<tr>
      				<td></td>
      			</tr>

      			<tr>
      				<td></td>
      				<td><input style="align-content: center" type="submit"  name="change" value="changer ses identifiants"></td>
      			</tr>


      		</table>

      	</form>
      </center>
<?php }
?>
