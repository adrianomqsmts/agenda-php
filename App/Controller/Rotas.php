<?php

namespace App\Controller;

use App\Controller\Abstracts\Bootstrap;

class Rotas extends Bootstrap {

//Inicializa todas as rotas existentes na aplicação
//Atribuindo à elas um controlador e uma função (action)
	protected function initRotas() {

		$rotas['home'] = array(
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
		
		$rotas['pagina-inicial'] = array(
			'rota' => '/pagina-inicial',
			'controller' => 'indexController',
			'action' => 'paginaInicial'
		);
		$this->setRotas($rotas);
	}

}

?>