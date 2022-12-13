<?php
include "class/class.phpmailer.php";
$mail = new PHPMailer();
$mail->IsSMTP();

$mail->Host = "smtp.hostinger.com.br";
$mail->SMTPAuth = true;

$mail->Username = 'ifsp@jhonatangalante.com.br';
$mail->Password = 'if-856@M2';

$mail->From = "ifsp@jhonatangalante.com.br";

$mail->AddAddress('jhonatangalante@hotmail.com');
$mail->IsHTML(true);

$mail->FromName = "";

$mail->CharSet = 'UTF-8';
$mail->Subject = "Assunto";
	
$mail->Body = "Teste</br></br>";

$enviado = $mail->Send();

$mail->ClearAllRecipients();
$mail->ClearAttachments();
?>