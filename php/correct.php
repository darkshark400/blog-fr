<?php
session_start();
require_once('../config/connect-bdd.php');

if(isset($_POST['corriger']))
{
  $pause = $_POST['pause'];
  $req = $bdd->prepare('INSERT INTO clients (verif) VALUES (?)');
  $req->execute(array($pause));

}

$req2 = $bdd->query('DELETE FROM pause (nonverif) VALUES (?)');

header("Location: forum-naviguer-pause.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);

?>
