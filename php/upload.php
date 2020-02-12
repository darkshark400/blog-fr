<?php
session_start();
require_once('../config/connect-bdd.php');

if(isset($_POST['publier']))
{
  $pause = $_POST['pause'];
  $req = $bdd->prepare('INSERT INTO pause (nonverif) VALUES (?)');
  $req->execute(array($pause));

}

header("Location: forum-deposer-pause.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);

?>
