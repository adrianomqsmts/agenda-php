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
			if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
				header("location: /home");
		 }else{
		 		$this->render('index', 'index', 'Bem-vindo');
		 }
	}

	public function login() {
		if(isset($_POST['email']) && isset($_POST['senha'])){
			$usuario = Container::getModel('Usuario');
			$dados = $usuario->getUsuario($_POST['email'], md5($_POST['senha']));
			if($dados != null){
				//Criando sessão de login automático
				$_SESSION["logado"] = true;
				$_SESSION["id_usuarios"] = $dados['id_usuarios'];
				header("location: /home");;
			}else{
				$_SESSION["msgLogin"] = "Email e/ou senhas inválido(s)";
				header("location: /");
			}
		}else	{
			header("location: /");
		}
	}

	public function cadastreSe(){
		if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
				header("location: /home");
		 }else{
				$this->render('cadastre-se', 'index', 'Cadastre-se');
		 }
		
	}

	public function cadastrar(){
		if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
				header("location: /home");
		 }else{
			if(isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['apelido']) && isset($_POST['nome'])){
				if(strlen($_POST['email']) >= 5 && strlen($_POST['senha']) >= 5 && isset($_POST['apelido']) >= 5 && isset($_POST['nome']) >= 5){
					$usuario = Container::getModel('Usuario');
					$usuario->cadastrar($_POST['email'], md5($_POST['senha']), $_POST['apelido'], $_POST['nome']);
					header("location: /");
				}else{
					(strlen($_POST['email']) < 5) ? ($_SESSION["msgEmail"] = "Email Inválido") : "";
					(strlen($_POST['senha']) < 5) ? ($_SESSION["msgSenha"] = " Senha Inválida. A senha deve ter no mínimo 5 caracteres") : "";
					(strlen($_POST['apelido']) < 5) ? ($_SESSION["msgApelido"] = "Apelido Inválida. O apelido deve ter no mínimo 5 caracteres") : "";
					(strlen($_POST['nome']) < 5) ? ($_SESSION["msgNome"] = "Nome Inválida. O nome deve ter no mínimo 5 caracteres") : "";
					header("location: /cadastre-se");
				}

			}else{
				header("location: /");
			}
		}		
	}

	public function paginaInicial(){
		 if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
				header("location: /home");
		 }else{
		 		header("location: /");
		 }
	}
}
