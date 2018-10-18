

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>MiniChat</title>
     <link rel="stylesheet" href="main.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>
   <body>
<h1>Minichat PHP MySQL</h1>
<?php

try {

$bdd = new PDO("mysql:host=localhost;dbname=minichat;charset=utf8",'root', "Younes0802");

}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}



?>

<form action="post_message.php" method="post">
    <p>
    <label for="pseudo">Pseudo</label> : <br> <input type="text" name="pseudo" id="pseudo" <?php if (isset($_GET['pseudo'])) { echo ' value="' . $_GET['pseudo'] . '"'; }?> /><br /><br>
    <label for="message">Message</label> : <br> <textarea name="message" id="message" rows="8" cols="20" value=""></textarea>
  <br><br /><br>

    <input type="submit" value="Envoyer" name="submit_comment" /> <br><br>

    <?php



    if(isset($_GET['pseudo']) AND isset($_GET['message'])) {

      echo '<span style="color:green">Votre message a bien été posté</span>';
    } else {
      echo '<span style="color:red">Tout les champs doivent être remplis</span>';
    }

    ?>




</p>
</form>

  <div id="message">
<?php
// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message, DAY(date_message) AS jour, MONTH(date_message) AS mois, YEAR(date_message) AS annee, HOUR(date_message) AS heure, MINUTE(date_message) AS minute, SECOND(date_message) AS seconde FROM minichat ORDER BY date_message DESC LIMIT 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
    echo '<p>[' . $donnees['jour'] . '/' . $donnees['mois'] . '/' . $donnees['annee'] . ' ' .
     $donnees['heure'] . 'h' . $donnees['minute'] . 'm' . $donnees['seconde'] . 's] <strong>'
      . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
}

$reponse->closeCursor();
 ?>
</div>

   </body>
 </html>
