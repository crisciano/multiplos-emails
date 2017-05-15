<?php
date_default_timezone_set('America/Sao_Paulo');
// include de conexão 
include("functions.php");

// require phpmailer
require 'PHPMailerAutoload.php';
require 'class.smtp.php';

// variaveis do email
$subject = 'envio smtp';
$assunto = "envio smtp";
$empresaAddress = "teste@gmail.com";
$empresaNome = "teste";
$html 	= "<!DOCTYPE html>
				<html>
				<head>
					<title></title>
				</head>
				<body>
					teste - email
				</body>
				</html>";

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->IsSMTP();                    // send via SMTP
//Set the hostname of the mail server
$mail->Host = "smtp.gmail.com";
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465; // port 465 gmail // port 587 hotmail
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "YOUR MAIL teste@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "YOUR PASS MAIL";
//Set who the message is to be sent from
$mail->setFrom($empresaAddress, $empresaNome);
//Set an alternative reply-to address
// EXEMPLO DE LISTA DE EMAIL

$emails = array();
// MODELO CONSULTA MYSQL
//$consulta = mysql_query("SELECT * FROM x_newsletter WHERE (categoria = 'todos') AND status = 1");
//while($usuario = mysql_fetch_array($consulta)){ $emails[] = $usuario['email']; }
//foreach($emails as $email){ $mail->AddCC($email); }

// MODELO DE LISTA DE EMAIL
$emails = $arrayName = array('teste@gmail.com' , 'teste@hotmail.com.br', 'teste@live.com', 'teste@uol.com.br' );
foreach($emails as $email){ $mail->AddCC($email); }

// TESTE ARRAY DE MAIL
print_r($emails);

//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
//$mail->addAddress('whoto@example.com', 'John Doe');
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($html);
//Replace the plain text body with one created manually
$mail->AltBody = $assunto;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

header("Location: page de retorno");

?>