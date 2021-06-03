<?php
   // print_r($_POST);
  //  echo '<hr>';
    session_start();

    //Importando PHPMailer

    require "./PHPMailer/Exception.php";
    require "./PHPMailer/OAuth.php";
    require "./PHPMailer/PHPMailer.php";
    require "./PHPMailer/POP3.php";//RECEBIMENTO
    require "./PHPMailer/SMTP.php";//ENVIO

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{
        private $email = null;
        private $assunto = null;
        private $mensagem = null;

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function mensagemValida(){
            //vaidando
            if(empty($this->email) || empty($this->assunto || empty($this->mensagem))){
                return false;
            }else{
                return true;
            }
        }

    }

    $message = new Mensagem();
    $message->__set('email', $_POST['email']);//indice - names
    $message->__set('assunto', $_POST['assunto']);
    $message->__set('mensagem', $_POST['mensagem']);

    //print_r($message);

    //validando 
    if(!$message->mensagemValida()){
        header('Location: index.php?error=empty_error');
        die();
    }

    $mail = new PHPMailer(true);

    try {
    //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = '';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'monteir2victor@gmail.com';                     //SMTP username
        $mail->Password   = 'dbz@2030';                               //SMTP password
        $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('monteir2victor@gmail.com', 'Victor Monteiro Via App Send Email');
        $mail->addAddress($message->__get('email'), 'Quem recebe');     //Add a recipient
        // $mail->addReplyTo('info@example.com', 'Information'); reposta do destinatario em caso de 3º pessoa
        // $mail->addCC('cc@example.com'); destinatario de copia
        // $mail->addBCC('bcc@example.com');  copia oculta

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $message->__get('assunto');
        $mail->Body    = $message->__get('mensagem');
        $mail->AltBody = $message->__get('mensagem');

        $mail->send();
        echo 'Message has been sent';
        header('Location: success_message.php?status=success');
    } catch (Exception $e) {
        $_SESSION['info_erro'] = $mail->ErrorInfo;
        header('Location: success_message.php?status=error');
        //echo "A mensagem não pode ser enviada. <br> Detalhes do erro -- <strong> {$mail->ErrorInfo} </strong>";
    }


?>