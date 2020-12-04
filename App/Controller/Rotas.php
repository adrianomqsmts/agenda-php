<?php

namespace App\Controller;

use App\Controller\Abstracts\Bootstrap;

class Rotas extends Bootstrap {

//Inicializa todas as rotas existentes na aplicação
//Atribuindo à elas um controlador e uma função (action)
	protected function initRotas() {

		$rotas['index'] = array(
			'rota' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$rotas['login'] = array(
			'rota' => '/login',
			'controller' => 'indexController',
			'action' => 'login'
		);

		$rotas['cadastre-se'] = array(
			'rota' => '/cadastre-se',
			'controller' => 'indexController',
			'action' => 'cadastreSe'
		);

		$rotas['cadastrar'] = array(
			'rota' => '/cadastrar',
			'controller' => 'indexController',
			'action' => 'cadastrar'
		);
		
		$rotas['home'] = array(
			'rota' => '/home',
			'controller' => 'TarefasController',
			'action' => 'home'
		);

		$rotas['cadastrar-tarefa'] = array(
			'rota' => '/home/cadastrar-tarefas',
			'controller' => 'TarefasController',
			'action' => 'cadastrarTarefas'
		);

		$this->setRotas($rotas);
	}

}

?>