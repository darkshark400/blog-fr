<?php
require_once('config/connect-bdd.php');

$req1 = $bdd->prepare('INSERT INTO clients (name, password, account_key, photo) VALUES (?,?,?,?)');


$req1->execute(array('alexandre','ea45e9fa1dc5ef14ec186f30176a83a3','r5s131qric5wpsv1jpi7kjhni2qn38uumi1jvjvw4d2b1f53k778ctxytsrh', 'photos/dalbat.png'));




?>
