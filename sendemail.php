<?php
$to = "administrador@crtechsolutions.com.br, contato.lucas94@hotmail.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p><strong>Eita, cuzão! Se vc recebeu este email, significa que as configurações de email estão funcionando</strong></p>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <srknupfer@latam.stefanini.com>' . "\r\n";
$headers .= 'Cc: srknupfer@latam.stefanini.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>