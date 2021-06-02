<?php
   // print_r($_POST);
  //  echo '<hr>';

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
    if($message->mensagemValida()){
        echo 'valida';
    }else{
        header('Location: index.php?error=empty_error');
        echo 'invalida';
    }


?>