<?php

class cotizawebController extends Controller{
    
    //private $cotizaweb;
    private $smail;
    
    public function __construct() {
        parent::__construct();
        $this->smail = $this->getLibrary('sendMail');        
        //$this->cotizaweb = $this->loadModel('cotizaweb');     
    }

    public function index() {
        //$this->view->posts = $this->cotizaweb->getPosts();
        //$this->view->titulo = 'Post';
        $this->view->renderizar('index');
    }
    public function cotizar(){
        if(!empty($_POST['Nombre']) && !empty($_POST['Email'])){
            
            /*$tipoCable = $_POST['tipoCable'];  
            if ($tipoCable == "op1") {          
                $tc=" (Cat 5)";      
            }
            if ($tipoCable == "op2") {          
                $tc=" (Cat 6)";      
            }
            if ($tipoCable == "op3") {          
                $tc=" (otros)";      
            }*/    
            if (isset($_POST['responsive']) && $_POST['responsive'] == '1'){
                $responsive=" responsive ";
            } else {
                $responsive=" no responsive ";
            }
            if (isset($_POST['estatica']) && $_POST['estatica'] == '1'){
                $estatica=" estatica ";
            } else {
                $estatica=" no estatica ";
            } 
            if (isset($_POST['animada']) && $_POST['animada'] == '1'){
                $animada=" animada";
            } else {
                $animada=" no animada";
            }         
            $texto='La persona: '.$_POST['Nombre']. ' ,ha solicitado una cotización de desarrollo web, para '.$_POST['noPaginas'].' paginas,'.$responsive.' ,'.$estatica.' y'.$animada.' Enviar cotización al correo: '.$_POST['Email'];
            $this->smail->send('Solicitud de cotización', $texto, $_POST['Email']);   
            $this->view->msg = '<div class="alert alert-info" role="alert">Su mensaje ha sido enviado, pronto estaremos enviandole su cotización</div>';
        } else {
            $this->view->msg = '<div class="form-group"><div class="alert alert-danger" role="alert">Su mensaje no ha sido enviado, debe ingresar su nombre y correo</div></div>';
        }
        $this->view->renderizar('index');
    }        
}
