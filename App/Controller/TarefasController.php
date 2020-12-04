<?php
namespace App\Controller;

// Recursos
use App\Controller\Abstracts\Action;
use App\Controller\Abstracts\Session;
use App\Model\Abstracts\Container;

ini_set('session.use_strict_mode', 1);
Session::my_session_start();

class TarefasController extends Action{

  public function home(){
    if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
				$usuario = Container::getModel('Usuario');
        // $tarefas = Container::getModel('Tarefas');

        $dadosUsuario = $usuario->getUsuarioID($_SESSION['id_usuarios']);
        $this->dados($dadosUsuario);

        $this->render("home", "home", "Bem-vindo");
        
		 }else{
		 	header("location: /");
		 }
    
  }

  public function cadastrarTarefas() {
     if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){

        
		 }else{
		 	header("location: /");
		 }
  }

}
