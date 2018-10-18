  <?php

  try {

  $bdd = new PDO("mysql:host=localhost;dbname=minichat;charset=utf8",'root', "Younes0802");

  }
  catch(Exception $e)
  {
          die('Erreur : '.$e->getMessage());
  }


  if($_POST['submit_comment'] == true) {
    if(isset($_POST['pseudo']) AND isset($_POST['message']) AND !empty($_POST['pseudo']) AND !empty($_POST['message'])) {



      // Insertion du message à l'aide d'une requête préparée
      $req = $bdd->prepare('INSERT INTO minichat (pseudo, message, date_message) VALUES(?, ?, NOW())');
      $req->execute(array($_POST['pseudo'], $_POST['message']));



      header('Location:index.php?pseudo=' . $_POST['pseudo'] . '&message=' . base64_decode($_POST['message']));

      var_dump($_POST['message']);
      $c_msg = "MSG OK !";

    } else {

      $c_msg = "Tout les champs divent être complétés !";

      var_dump($c_msg);

      header('Location:index.php');
    }
  }












 ?>
