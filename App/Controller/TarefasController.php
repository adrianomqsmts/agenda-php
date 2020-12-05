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
        $tarefas = Container::getModel('Tarefas');

        $usuario = $usuario->getUsuarioID($_SESSION['id_usuarios']);
        $this->view->usuario = $usuario;

        $tarefas = $tarefas->getTarefasNaoConcluidas($_SESSION['id_usuarios']);
        $this->view->tarefas = $tarefas;
        $this->render("home", "home", "Bem-vindo");
        
		 }else{
		 	header("location: /");
		 }
    
  }

  public function cadastrarTarefas() {
     if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
       $prioridades = Container::getModel('Prioridade');
       $prioridades = $prioridades->getPrioridades();
       $this->view->prioridades = $prioridades;
       $this->render("cadastrar-tarefas", "home", "Cadastrar Tarefa");
		 }else{
		 	header("location: /");
		 }
  }

  public function cadastrarTarefasConfirmar() {
     if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
        if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['prioridade'])  && isset($_POST['datahora']) ){
          $tarefa =  Container::getModel('Tarefas');
          $tarefa->cadastrar($_POST['nome'], $_POST['descricao'], $_POST['datahora'], $_POST['prioridade'], $_SESSION['id_usuarios']);
          $_SESSION['msgHome'] = "Cadastro realizado com sucesso!";
          header("location: /home");
      }else{
        // $_SESSION['msgCadastroTarefa'] = "Por favor preencha todos os campos";
        header("location: /home/cadastrar/tarefas");
      }
		 }else{
		 	header("location: /");
		 }
  }

  public function excluirTarefa()  {
    if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
      if(isset($_GET['id'])){
        $tarefa =  Container::getModel('Tarefas');
        $tarefa->apagar($_GET['id'], $_SESSION['id_usuarios']);
        $_SESSION['msgHome'] = "Tarefa apagada com sucesso";
        header("location: /home");
      }else{
        $_SESSION['msgHome'] = "Ocorreu algo errado! Desculpe-nos.";
        header("location: /home");
      }
		 }else{
		 	header("location: /");
		 }
  }

  public function editarTarefa()  {
    if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
      if(isset($_GET['id'])){
        $tarefas = Container::getModel('Tarefas');
        $prioridades = Container::getModel('Prioridade');

        $prioridades = $prioridades->getPrioridades();
        $this->view->prioridades = $prioridades;

        $tarefa = $tarefas->getTarefa($_GET['id'], $_SESSION['id_usuarios']);
        $this->view->tarefa = $tarefa;
        $this->render("editar", "home", "Editar Tarefa");
      }else{
        $_SESSION['msgHome'] = "Ocorreu algo errado! Desculpe-nos.";
        header("location: /home");
      }
		 }else{
		 	header("location: /");
		 }
  }

  
  public function editarTarefaConfirmar()  {
    if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
      if(isset($_GET['id'])){
        $tarefas = Container::getModel('Tarefas');
        $tarefas->atualizar($_POST['nome'], $_POST['descricao'], $_POST['datahora'], $_POST['prioridade'], $_SESSION['id_usuarios'], $_GET['id']);
        $_SESSION['msgHome'] = "A tarefa foi atualizada com sucesso!";
        header("location: /home");
      }else{
        $_SESSION['msgHome'] = "Ocorreu algo errado! Desculpe-nos.";
        header("location: /home");
      }
		 }else{
		 	header("location: /");
		 }
  }

  public function concluirTarefa()  {
    if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
      if(isset($_GET['id'])){
        $tarefas = Container::getModel('Tarefas');
        $tarefas->concluirTarefa(1, $_SESSION['id_usuarios'], $_GET['id']);
        $_SESSION['msgHome'] = "A tarefa foi concluída com sucesso!.";
        header("location: /home");
      }else{
        $_SESSION['msgHome'] = "Ocorreu algo errado! Desculpe-nos.";
        header("location: /home");
      }
		 }else{
		 	header("location: /");
		 }
  }

}
