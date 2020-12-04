<?php

namespace App\Model;

class Tarefas {

  private $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

  	public function getTarefa($id_tarefa){
		$query = "SELECT * FROM tarefas WHERE id_tarefas = ?";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("i", $id_tarefa);
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

	public function getTarefas($id_usuario){
		$query = "SELECT * FROM tarefas WHERE id_usuarios = ?";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("i", $id_usuario);
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

	public function cadastrar($nome, $descricao, $datas, $prioriedade, $concluido, $id_usuario){
		$query = "INSERT INTO usuarios (nome, descricao, datas, prioriedade, concluido, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("sssiii", $nome, $descricao, $datas, $prioriedade, $concluido, $id_usuario);

    //Executando a Instrução SQL
    $stmt->execute();
	}

  public function atualizar($nome = null, $descricao = null, $data_conclusao = null, $id_prioriedade = null, $concluido = null){
    $query = "INSERT INTO usuarios";
		$colunas = [];

    ($nome != null) ?  ($colunas[] = "nome"): ("") ;
    ($descricao != null) ?  ($colunas[] = "descricao"): ("") ;
    ($data_conclusao != null) ?  ($colunas[] = "data_conclusao"): ("") ;
    ($id_prioriedade != null) ?  ($colunas[] = "id_prioriedade"): ("") ;
    ($concluido != null) ?  ($colunas[] = "concluido"): ("") ;

    if($nome = null && $descricao == null && $data_conclusao == null && $id_prioriedade == null && $concluido == null){
      return null;
    }

    $query.="(";
    $binds = "(";
    
    for($i = 0; $i < count($colunas) - 1; $i++){
      $query.= $colunas[$i] . ",";
       $binds.="?, ";
    }
    $query.= $colunas[count($colunas) - 1] . ") VALUES ";
    $binds.="?)";

    $query.=$binds;

    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("sssiii", $nome, $descricao, $data_conclusao, $prioriedade, $concluido, $id_usuario);

    //Executando a Instrução SQL
    $stmt->execute();

  }
  
}
