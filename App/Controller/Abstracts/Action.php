<?php

namespace App\Controller\Abstracts;

abstract class Action {

	protected $view;

  // Cria um objeto Vazio que poderemos adicionar propriedades, etc.
	public function __construct() {
		$this->view = new \stdClass();
	}

	protected function dados($dado) {
		// Cria uma propriedade com o nome da dado
		$this->view->dado = $dado;
	}

	protected function render($view, $layout = NULL, $titulo = NUll) {
		// Cria uma propriedade com o nome da view
		$this->view->page = $view;
		$this->view->titulo = $titulo;
		//Verifica se existe um arquivo de layout pronto
		if(file_exists("../App/View/Abstracts/".$layout.".phtml")) {
			require_once "../App/View/Abstracts/".$layout.".phtml";
		} else {
			//Caso não exista um layout chamamos o método 
			$this->content();
		}
	}

	protected function content() {
		//Pega o caminho que estamos
		$classAtual = get_class($this);
		//REMOVE o caminho inicial
		$classAtual = str_replace('App\\Controller\\', '', $classAtual);
		//Remove a palavra Controller e retorna apenas o nome ex indexController fica index
		$classAtual = ucfirst(str_replace('Controller', '', $classAtual));
		//Incluí o arquivo na pasta com o nome da classe atual e com o nome dentro do objeto 
		//O arquivo é incluído na página index.php em public
		//Basicamente o controlador só poderá abrir página que contém a pasta com seu nome inicial
		require_once "../App/View/".$classAtual."/".$this->view->page.".phtml";
	}
}

?>