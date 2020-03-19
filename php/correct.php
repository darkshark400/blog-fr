<?php
session_start();
require_once('../config/connect-bdd.php');


    if(isset($_POST['hidden_id']))
    {
      $id = $_GET['id'];
      $com = $_POST['commentaire'];
      $pause = $_POST['pause'];

      $req2 = $bdd->prepare("UPDATE pause SET txtcorrige = ?, verif = ?, date_ajout2 = NOW(), commentaire =? WHERE pauseid = '$id' ");
      $req2->execute(array($pause, 1, $com));


    }




header("Location: pause-nc.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);

?>
