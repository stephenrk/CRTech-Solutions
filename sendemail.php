<?php
$name       = @trim(stripslashes($_POST['name'])); 
$from       = @trim(stripslashes($_POST['email'])); 
$subject    = @trim(stripslashes($_POST['subject'])); 
$message    = @trim(stripslashes($_POST['message'])); 
$to   		= 'administrador@crtechsolutions.com.br';//replace with your email

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=utf-8";
$headers[] = "From: {$name} <{$from}>";
$headers[] = "Reply-To: <{$from}>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

mail($to, $subject, $message, $headers);

die;