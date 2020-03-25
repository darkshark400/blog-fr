<?php
session_start();
require_once('../config/connect-bdd.php');

if(isset($_GET['id'], $_GET['account_key']) AND !empty($_GET['account_key']) AND $_GET['id'] > 0)
{
  $getid = $_GET['id'];
  $account_key = $_GET['account_key'];
  $requser = $bdd->prepare('SELECT * FROM clients WHERE id = ? AND account_key = ?');
  $requser->execute(array($getid, $account_key));
  $userexist = $requser->rowCount();
  if($userexist == 1)
  {

  if(isset($_POST['validmail']))
  {

    $getid = $_GET['id'];
    $mail = $_POST['mail'];
    $mail1 = $_POST['mail1'];


    if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
    {  if(isset($mail, $mail1) AND $mail == $mail1)
      {
      $req = $bdd->prepare("UPDATE clients SET mail = ?, nm = 1 WHERE id = '$getid'");
      $req->execute(array($mail));

      $_SESSION['nm'] = 1;
      if($_SESSION['np'] == 0)
      {
        header("Location: newpass.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);
      }
      else {
        header("Location: ../default.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);
      }

      }
      elseif($mail != $mail1)
      {
        $error = "Vos adresses mails ne concordent pas !";
      }
      elseif(!isset($mail, $mail1))
      {
        $error = "Veuillez renseigner les champs si dessus !";
      }
    }
    else
    {
      $error = "Votre email n'a pas un bon format :( ";
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

        <h2 id=titre-h2>Nouvelle adresse e-mail</h2>
        <br>
        <div class="user">
          <img class=image-profil src="../<?php echo $_SESSION['photo']?>"><br>
          <div class="texte-user-info"><a href="php/profil.php"><?= $_SESSION['name']?><br><?= $_SESSION['NOM']?></a></div>
        </div>

        <br><br><br><br>
        <div id=carte-desktop>
          <h2 class=titre-h2>Pour recevoir des notifications ainsi que des nouvelles informations, veuillez entrer une adresse e-mail.</h2>

        </div><br><br>

        <center id=carte-desktop>
        <form  action="" method="post">

      		<table>


      			<tr>
      				<td><label for="password" class="text-connexion">Nouveau mail : </label></td><td class="box-connexion"><input type="mail" name="mail" placeholder="votre nouvelle adresse mail"value="<?= $mail ?>"></td><br>
      			</tr>

            <tr>
      				<td><label for="password" class="text-connexion">Confirmez le nouveau mail : </label></td><td class="box-connexion"><input type="mail" name="mail1" placeholder="votre nouvelle adresse mail"value="<?= $mail1 ?>"></td><br>
      			</tr>

      			<tr>
      				<td></td>
      			</tr>

      			<tr>
      				<td></td>
      				<td><input style="align-content: center" type="submit"  name="validmail" value="Valider les informations"></td>
      			</tr>


      		</table>

      	</form>
        <div style="color:red">
        <?php
        if ($error) {
          echo $error;
        } ?></div>
      </center>

    </body>
    </html>
<?php
  }
  else {
    $_SESSION = array();
    session_destroy();
    header('Location : ../index1.php');
  }
}
else {
  $_SESSION = array();
  session_destroy();
  header('Location : ../index1.php');
}
?>
