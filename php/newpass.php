<?php
session_start();
require_once('../config/connect-bdd.php');

if(isset($_GET['id'], $_GET['account_key']) AND !empty($_GET['account_key']) AND $_GET['id'] > 0)
{


  if(isset($_POST['change']))
  {
    $getid = $_GET['id'];
    $password = md5($_POST['password']);
    $password1 = md5($_POST['password1']);

    if(isset($password, $password1))
    {
      if($password == $password1)
      {

    $req = $bdd->prepare("UPDATE clients SET np = 1, password = ? WHERE id = '$getid'");
    $req->execute(array($password));
    $_SESSION['np'] = 1;
    header("Location: ../default.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);

      }
      else
      {
        $error = "Les mot de passes ne concordent pas !";
      }
    }
    else {
      $error = "Veuillez renseigner les champs ci-dessus !";

    }

  }




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
        <form  action="" method="post">

      		<table>


      			<tr>
      				<td><label for="password" class="text-connexion">Nouveau mot de passe : </label></td><td class="box-connexion"><input type="password" name="password" placeholder="votre nouveau mot de passe" value="<?= $password ?>"></td><br>
      			</tr>

            <tr>
      				<td><label for="password" class="text-connexion">Confirmez le nouveau mot de passe : </label></td><td class="box-connexion"><input type="password" name="password1" placeholder="votre nouveau mot de passe"value="<?= $password1 ?>"></td><br>
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
        <div style="color:red">
          <?php
          if($error)
          {
            echo $error;
          } ?>
        </div>
      </center>
<?php }
?>
