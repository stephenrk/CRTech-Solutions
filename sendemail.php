<?php
if($_POST)
{
    $to_Email       = "administrador@crtechsolutions.com.br"; //Replace with recipient email address
    $subject        = 'Formulario de contato CRTech Solutions'; //Subject line for emails
    
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    
        //exit script outputting json data
        $output = json_encode(
        array(
            'type'=>'error', 
            'text' => 'Request must come from Ajax'
        ));
        
        die($output);
    } 
    
    //check $_POST vars are set, exit if any missing
    if(!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["subject"]) || !isset($_POST["message"]))
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Os campos não foram preenchidos!'));
        die($output);
    }

    //Sanitize input data using PHP filter_var().
    $user_Name        = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $user_Email       = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $user_Subject       = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $user_Message     = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
    //additional php validation
    if(strlen($user_Name)<4) // If length is less than 4 it will throw an HTTP error.
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Nome muito curto ou vazio!'));
        die($output);
    }
    if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Email invalido!'));
        die($output);
    }
    if(strlen($user_Subject)<3) //check entered data is numbers
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Mensagem muito curta!'));
        die($output);
    }
    if(strlen($user_Message)<5) //check emtpy message
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Mensagem muito curta.'));
        die($output);
    }
    
    //proceed with PHP email.

    /*
    Incase your host only allows emails from local domain, 
    you should un-comment the first line below, and remove the second header line. 
    Of-course you need to enter your own email address here, which exists in your cp.
    */
    //$headers = 'From: your-name@YOUR-DOMAIN.COM' . "\r\n" .
    $headers = 'From: '.$user_Email.'' . "\r\n" . //remove this line if line above this is un-commented
    'Reply-To: '.$user_Email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
        // send mail
    $sentMail = @mail($to_Email, $subject, $user_Message .'  -'.$user_Name, $headers);
    
    if(!$sentMail)
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Olá '.$user_Name .' Obrigado por entrar em contato'));
        die($output);
    }
}
?>