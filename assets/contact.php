<?php
$output = [];
if (!empty($_POST)) {
  $nom = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  // envoie de l'email de confirmation
  $email_to = "smartvoyages24@gmail.com"; // Destinataire
  $email_from = $email; // Emetteur
  $email_object = 'contact'; //Sujet du mail

  if (preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $email_from)) {
    $passage_ligne = "\n";
  } else {
    $passage_ligne = "\r\n";
  }


  $headers = 'MIME-Version: 1.0' . $passage_ligne; //Version de MIME
  $headers .= 'From: <' . $email_from . '>' . $passage_ligne; //Emetteur
  $headers .= 'Content-Type:text/html; charset="utf-8"' . $passage_ligne;
  $headers .= 'Content-Transfert-Encoding: 8bit';

  // envoie de l'email
  if (mail($email_to, $email_object, $message, $headers)) {
    $output['code'] = 201;
    $output['message'] = "E-mail envoyé";
  } else {
    $output['code'] = 400;
    $output['message'] = "Erreur lors de l'envoie de l'E-mail";
  }
} else {
  $output['code'] = 400;
  $output['message'] = "Veuillez entrer les informations demandé";
}
echo json_encode($output);
