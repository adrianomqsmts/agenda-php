<?php

namespace App\Model\Abstracts;

class Connection{

	// Realiza a conexão com o banco de dados
	public static function getDb()	{
		
		$servername = "127.0.0.1";
		$username = "root";
		$password = "";
		$dbname = "agenda";

		// Criando a conexão
		$conn = new \mysqli($servername, $username, $password, $dbname);

		// Verificando se ocorreu erro, ou não ao criar a conexão
		if ($conn->connect_error) {
			//Exibindo o que provocou o erro e interrompendo a aplicação
			die("Falha na conexão: " . $conn->connect_error);
		}
		return $conn;

	}
}
