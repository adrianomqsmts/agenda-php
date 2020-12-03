<?php

namespace App\Controller\Abstracts;

abstract class Bootstrap{
	private $rotas;

	abstract protected function initRotas();

	public function __construct()	{
		$this->initRotas();
		$this->run($this->getUrl());
	}

	public function getRotas()	{
		return $this->rotas;
	}

	public function setRotas(array $rotas)	{
		$this->rotas = $rotas;
	}

	protected function run($url)	{
		$rotaExiste = 0;
		foreach ($this->getRotas() as $key => $rota) {
			// Verificando se a URL atual pertence a alguma rota criada
			if ($url == $rota['rota']) {
				//Instanciando dinamicamente o controlador e chamando a função que irá cuidar da página da URL
				$class = "App\\Controller\\" . ucfirst($rota['controller']);
				$controller = new $class;
				$action = $rota['action'];
				$controller->$action();
				$rotaExiste = 1;
			}		
		}
		if(!$rotaExiste){
			// Se a rota não existir o usuário é redirecionado para a página inicial  
			header('Location: ' . "/");

		}
	}

	protected function getUrl()	{
		///Retorna a URL atual limpa. 
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}
}
