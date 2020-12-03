<?php

namespace App\Model;

class Usuario {

  	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

		public function getUsuarioID($id){
		$query = "SELECT * FROM usuario WHERE id = ?";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("i", $id);
    //Executando a Instrução SQL
    $stmt->execute();
		$result =  $stmt->get_result();
		 if ($result->num_rows > 0) {
			 $row = $result->fetch_assoc();
			return $row;
		} else {
			return Null;
		}		
	}

	public function getUsuario($email, $senha){
		$query = "SELECT * FROM usuario WHERE email = ? AND senha = ?";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("ss", $email, $senha);
    //Executando a Instrução SQL
    $stmt->execute();
		$result =  $stmt->get_result();
		 if ($result->num_rows > 0) {
			 $row = $result->fetch_assoc();
			return $row;
		} else {
			return Null;
		}		
	}

	public function cadastrar($email, $senha){
		$query = "INSERT INTO usuario (email, senha) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("ss", $email, $senha);
    //Executando a Instrução SQL
    $stmt->execute();
	}
  
}
