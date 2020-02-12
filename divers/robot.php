<?php
require_once('../config/connect-bdd.php');

$req1 = $bdd->query('INSERT INTO pause (name) SELECT name FROM clients');





?>
