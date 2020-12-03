<?php

namespace App\Controller;

// Recursos
use App\Controller\Abstracts\Action;
use App\Controller\Abstracts\Session;
use App\Model\Abstracts\Container;

ini_set('session.use_strict_mode', 1);
Session::my_session_start();

class IndexController extends Action {

	public function index() {
		$this->render('index', 'index', 'Bem-vindo');
	}

	public function login() {
		if(isset($_POST['email']) && isset($_POST['senha'])){
			$usuario = Container::getModel('Usuario');
			$dados = $usuario->getUsuario($_POST['email'], md5($_POST['senha']));
			if($dados != null){
				//Criando sessão de login automático
				$_SESSION["logado"] = true;
				$_SESSION["id"] = $dados['id'];
				header("location: /pagina-inicial");
			}else{
				$_SESSION["msgLogin"] = "Email e/ou senhas inválido(s)";
				header("location: /home");
			}
		}else	{
			header("location: /home");
		}
	}

	public function cadastreSe(){
		$this->render('cadastre-se', 'index', 'Cadastre-se');
	}

	public function cadastrar(){
		if(isset($_POST['email']) && isset($_POST['senha'])){
			if(strlen($_POST['email']) >= 5 && strlen($_POST['senha']) >= 5){
				$usuario = Container::getModel('Usuario');
				$usuario->cadastrar($_POST['email'], md5($_POST['senha']));
				header("location: /home");
			}else{
				(strlen($_POST['email']) < 5) ? ($_SESSION["msgEmail"] = "Email Inválido") : "";
      	(strlen($_POST['senha']) < 5) ? ($_SESSION["msgSenha"] = " Senha Inválida. A senha deve ter no mínimo 5 caracteres") : "";
				header("location: /cadastre-se");
			}

		}else{
			header("location: /");
		}
		
	}
	public function paginaInicial(){
		 if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
				$usuario = Container::getModel('Usuario');
				$this->dados($usuario->getUsuarioID($_SESSION['id']));
				$this->render("pagina-inicial", "index", "Página-inicial");
		 }else{
		 		header("location: /home");
		 }
	}
}
