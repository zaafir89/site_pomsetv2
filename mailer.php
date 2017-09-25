<!doctype html>
<html lang="fr">
<meta charset="utf-8">




<form method="post" action="">
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" required class="form-control" name="nom" id="nom" placeholder="Jean Durant" >
      </div>
    </div>
    <div class="col-md-6 col-xs-12">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" required class="form-control" name="email" id="email" placeholder="jean.durant@gmail.com">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <label for="message">Message</label>
        <textarea required class="form-control message" name="message" id="message" rows="6" cols="60" placeholder="Bonjour, je suis intéressé par..."></textarea>

      </div>
    </div>
    <div class="col-lg-offset-8 col-lg-4 col-sm-offset-8 col-sm-4 col-xs-offset-2 col-xs-9">
      <button type="submit" class="btn btn-envoyer right1 envoyer envoyer1">envoyer</button>
    </div>
  </div>
</form>



<div class="container">


  <div class="row footer">
    <div class="col-sm-6 col-xs-12">
      <p><strong>Adresse:</strong> 24-30 rue Carle Hébert, 92400 Courbevoie</p>
    </div>
    <div class="col-sm-6 col-xs-12">
      <p><strong>Téléphone:</strong> 01 47 58 61 14</p>  </div>


    </div>
  </div>



  <?php
  if(isset($_POST) && !empty($_POST['nom'])
  && !empty($_POST['email'])
  && !empty($_POST['message']))
  {
    $destinataire = 'contact@pomset.fr';
    $header="MIME-Version: 1.0\r\n";
    $expediteur = "From:" .$_POST['nom'];
    $header.='Content-Type:text/html; charset="uft-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';
    $echec = 'Echec envoi de mail';
    $probleme = 'Formulaire non soumis, veuillez complétez les champs manquants s\'il vous plaît';
    $message='
        Vous avez reçu un nouveau message du Formulaire de contact !


          Nom: ' . $_POST['nom'] . '

          Email : ' . $_POST['email'] . '



          Message: ' . $_POST['message'] . '
  '
    ;
    $mail = mail($destinataire, "Nouveau message de news.pomset.fr", $message, $expediteur, $header);
  if($mail) echo '<div class="alert alert-success">
  Mail envoyé avec succès !
</div>'; else echo $echec;
  }
  ?>

  </html>
