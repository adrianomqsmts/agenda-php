<?php

namespace App\Model;

class Usuario {

  private $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function getUsuarioID($id){
		$query = "SELECT * FROM usuarios WHERE id_usuarios = ?";
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
		$query = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
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

	public function cadastrar($email, $senha, $apelido, $nome){
		$query = "INSERT INTO usuarios (email, senha, apelido, nome) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("ssss", $email, $senha, $apelido, $nome);

    //Executando a Instrução SQL
    $stmt->execute();
	}
  
}
