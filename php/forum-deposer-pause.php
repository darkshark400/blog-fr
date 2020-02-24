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







 ?>
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
    <img class=image-profil src="../<?php echo $_SESSION['photo']?>"><br>
    <a href="php/profil.php"><div class=texte-user-info><?= $_SESSION['name']?><br><?= $_SESSION['NOM']?></div></a>
  </div>
  <nav id=navbar>
    <div id=capteur><img class=image-capteur src='../images/dots.png'/>
    <br>
    <div class=navbar-content>
      <ul>
        <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id'] ?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
        <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id'] ?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
        <li class="text-navbar lien-navbar"><a href='mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
        <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
      </ul>
    </div>
    </div>
  </nav>
  <center id=carte-desktop>





<br><br>

<form  method="post" action="">
  <textarea class="form1" id="pause" name="pause" type='textarea' onkeyup="button_griser()" placeholder="Tapez votre texte"></textarea><br>
  <input type="checkbox" name="checkbox" id="checkbox" value="checked" /><label for="checkbox">Voulez-vous rendre publique votre pause après la correction?</label>
  <br><br>
  <input type="submit" value="Envoyer" name="publier" id="envoyer" disabled="disabled"><br>
</form>

<script type="text/javascript">

function button_griser()
{
  var i = document.getElementById("pause");
  if(i.value == "")
  {
    document.getElementById("envoyer").disabled = true;
  }
  else
  {
    document.getElementById("envoyer").disabled = false;
  }
}

</script>

<?php
if(isset($_POST['publier']))
{
  $pause = $_POST['pause'];
  $public = false;

    if(isset($_POST['checkbox']))
    {
      $public = true;
    }

  $req = $bdd->prepare('INSERT INTO pause (txtoriginal, refclients, public, verif, date_ajout) VALUES (?, ?, ?, 0, NOW())');
  $req->execute(array($pause, $getid, $public));
  header("Location: ../default.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']."&public=".$public);



}



?>

<div style='color : red'>
<?php

if(isset($succes))
{
  echo $succes;
}


?>
</div>



  <center>
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
