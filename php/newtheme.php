<?php
session_start();
require_once('../config/connect-bdd.php');

if($_POST['ajout'])
{
  $theme = $_POST['theme'];
  $req = $bdd->prepare('INSERT INTO Theme (description, date_ajout) VALUES (?, NOW())');
  $req->execute(array($theme));

  $header="MIME-Version : 1.0\r\n";
									$header='From:"arthur.teyssieux.fr"<arthur@teyssieux.fr>'."\n";
									$header.='Content-Type:text/html; charset="utf-8"'."\n";

									$message ="
									<html>
										<body>
											<div align='center'>
                      <p style='color:black'>Bonjour, votre professeur de français vous a envoyé un nouveau message :</p>
                      <br><div style='color:red'>$theme</div>

												<a href='http://seconderouge.com'>Connectez-vous</a>
												<p style='color:black'>Ceci est un mail automatique, veuillez ne pas y répondre! </p>
											</div>
										</body>
									</html>



									";
                  $requser = $bdd->query('SELECT * from clients WHERE nm = 1');
                  while($donnees = $requser->fetch())
                  {
									mail($donnees['mail'], "Nouveau message", $message, $header);
                  }

  $success = "Le thème a bien été ajouté, tous les élèves pourront le voir depuis l'accueil !";

}



if(isset($_GET['id'], $_GET['account_key']) AND !empty($_GET['account_key']) AND $_GET['id'] > 0)
{
   $getid = intval($_GET['id']);
   $account_key = htmlspecialchars($_GET['account_key']);
   $requser = $bdd->prepare('SELECT * FROM clients WHERE id = ? AND account_key = ?');
   $requser->execute(array($getid, $account_key));
   $userexist = $requser->rowCount();
   if($userexist == 1)
   {
       if($getid == $_SESSION['id'])
       {
         if ($account_key == $_SESSION['account_key'])
         {



        ?>
        <!DOCTYPE html>
        <html id=background>
          <head>
            <meta charset="utf-8" content="width=device-width" name="viewport">
            <title>Les thèmes</title>
            <link rel="stylesheet" href="../config/stylesheet.css">
          </head>

          <body id=carte-mobile>
            <h2 id=titre-h2>Ajouter un nouveau thème</h2>
            <br>
            <div class="user">
              <img class=image-profil src='../photos/ano.png'><br><div class=texte-user-info><?= $_SESSION['name'] ?></div>
            </div>
            <nav id=navbar>
              <div id=capteur><img class=image-capteur src='../images/dots.png'/>
                <br>
                <div class=navbar-content>
                  <ul>
                    <li class="text-navbar lien-navbar"><a href='../default.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Accueil</a></li>
                    <li class="text-navbar lien-navbar"><a href='pause-nc.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Liste des pauses lectures à corriger</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-naviguer-pause-np.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Parcourir les pauses non publiques</a></li>
                    <li class="text-navbar lien-navbar"><a href='forum-deposer-pause.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Publier une pause</a></li>
                    <li class="text-navbar lien-navbar"><a href='mespauses.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Mes pauses</a></li>
                    <li class="text-navbar lien-navbar"><a href='bdd.php?id=<?= $_SESSION['id']?>&account_key=<?= $_SESSION['account_key']?>'>Listes des élèves</a></li>
                    <li class="text-navbar lien-navbar"><a href='deconnection.php'>Se déconnecter</a></li>
                  </ul>
                </div>
              </div>
            </nav>

            <center>
            <div id="carte-desktop">

              <form method="post" action="" class=texte-area-position>
                <textarea class="texte-area-pause" id="theme" name="theme" type='textarea' onkeyup="button_griser()"><?php echo $donnees['txtoriginal'];?></textarea><br>

                <br>
                <input type="submit" value="Ajouter un nouveau thème" name="ajout" id="ajouter" disabled="disabled">

              </form>
              <script type="text/javascript">

              function button_griser()
              {
                var i = document.getElementById("theme");
                if(i.value == "")
                {
                  document.getElementById("ajouter").disabled = true;
                }
                else
                {
                  document.getElementById("ajouter").disabled = false;
                }
              }

              </script>



          </div>
          <div style="color:red">
            <?php
            if($success)
            {
              echo $success;
            }
            ?>
          </div>
          </center>


          </body>

            </html>
            <?php





              }
              else{
                $_SESSION = array();
                session_destroy();
                header('Location : ../index1.php');
              }

            }
            else{
              $_SESSION = array();
              session_destroy();
              header('Location : ../index1.php');
            }
          }
          else{
            $_SESSION = array();
            session_destroy();
            header('Location : ../index1.php');
          }
    }
    else{
      $_SESSION = array();
      session_destroy();
      header('Location : ../index1.php');}
    ?>
