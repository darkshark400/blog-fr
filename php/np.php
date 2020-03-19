<?php
session_start();
require_once('../config/connect-bdd.php');

if(isset($_POST['change']))
{
  $getid = $_GET['id'];
  $password = md5($_POST['password']);
  $password1 = md5($_POST['password1']);
  if(isset($password, $password1) AND $password == $password1)
  {
  $req = $bdd->prepare("UPDATE clients SET np = 1, newpass = ? WHERE id = '$getid'");
  $req->execute(array($password));
  header('Location : ../default.php');
  }
}


?>
