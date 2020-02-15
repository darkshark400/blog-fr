<?php
session_start();
require_once('../config/connect-bdd.php');


    if(isset($_POST['hidden_id']))
    {
      $id = $_GET['id'];

      $pause = $_POST['pause'];

      $req2 = $bdd->prepare("UPDATE pause SET txtcorrige = ?, verif = 1 WHERE pauseid = '$id' ");
      $req2->execute(array($pause));


    }




header("Location: pause-nc.php?id=".$_SESSION['id']."&account_key=".$_SESSION['account_key']);

?>
