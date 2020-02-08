<?php
function random_1($car) {
								    $string = "";
								    $chaine = "abcdefghijklmnpqrstuvwxy123456789";
								    srand((double)microtime()*1000000);
								    for($i=0; $i<$car; $i++) {
								    $string .= $chaine[rand()%strlen($chaine)];
								    }
								    return $string;
								    }

$acc_key = random_1(60);

echo $acc_key;

?>
