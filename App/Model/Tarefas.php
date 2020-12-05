<?php

namespace App\Model;

class Tarefas {

  private $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

  public function getTarefa($id_tarefa, $id_usuario){
		$query = "SELECT * FROM tarefas WHERE id_tarefas = ? AND id_usuarios = ?";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("ii", $id_tarefa, $id_usuario);
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
		$query = "SELECT * FROM tarefas WHERE id_usuarios = ? ORDER BY data_conclusao";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("i", $id_usuario);
    //Executando a Instrução SQL
    $stmt->execute();
		$result =  $stmt->get_result();
		if ($result->num_rows > 0) {
	    $rows = [];
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
		} else {
			return Null;
		}		
	}

  public function getTarefasConcluidas($id_usuario){
		$query = "SELECT * FROM tarefas WHERE id_usuarios = ? AND concluido = 1 ORDER BY data_conclusao DESC";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
      $stmt->bind_param("i", $id_usuario);
    //Executando a Instrução SQL
    $stmt->execute();
		$result =  $stmt->get_result();
		if ($result->num_rows > 0) {
      $rows = [];
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
		} else {
			return Null;
		}		
	}

  public function getTarefasNaoConcluidas($id_usuario){
		$query = "SELECT * FROM tarefas WHERE id_usuarios = ? AND concluido = 0 ORDER BY data_conclusao ASC";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
      $stmt->bind_param("i", $id_usuario);
    //Executando a Instrução SQL
    $stmt->execute();
		$result =  $stmt->get_result();
		if ($result->num_rows > 0) {
      $rows = [];
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
		} else {
			return Null;
		}		
	}

  public function getTarefasAtrasadas($id_usuario)  {
		$query = "SELECT * FROM tarefas WHERE id_usuarios = ? WHERE data_concluisao < ? ORDER BY data_conclusao asc";
		$stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $agora = date("Y-m-d") . "T" . date("H:m");
    $stmt->bind_param("ss", $id_usuario, $agora);
    //Executando a Instrução SQL
    $stmt->execute();
		$result =  $stmt->get_result();
		if ($result->num_rows > 0) {
      $rows = [];
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
		} else {
			return Null;
		}		
	}

	public function cadastrar($nome, $descricao, $datas, $prioridade, $id_usuario){  
		$query = "INSERT INTO tarefas (nome, descricao, data_conclusao, id_prioridades, id_usuarios) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("ssssi", $nome, $descricao, $datas, $prioridade, $id_usuario);
    //Executando a Instrução SQL
    $stmt->execute();
	}

  public function apagar($id_tarefas, $id_usuarios){
		$query = "DELETE FROM tarefas WHERE id_tarefas = ? AND id_usuarios = ?";
    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("ii", $id_tarefas, $id_usuarios);
    //Executando a Instrução SQL
    $stmt->execute();
  }

 	public function atualizar($nome, $descricao, $datas, $prioridade, $id_usuario, $id_tarefa){  
		$query = "UPDATE tarefas SET nome = ?, descricao = ?, data_conclusao = ?, id_prioridades = ? WHERE id_usuarios = ? AND id_tarefas = ?";
    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("sssiii", $nome, $descricao, $datas, $prioridade, $id_usuario, $id_tarefa);
    //Executando a Instrução SQL
    $stmt->execute();   
  }

  public function concluirTarefa($concluido, $id_usuario, $id_tarefa){
    $query = "UPDATE tarefas SET concluido = ? WHERE id_usuarios = ? AND id_tarefas = ?";
    $stmt = $this->conn->prepare($query);
    //Ligando as variáveis aos parâmetros esperados
    $stmt->bind_param("iii", $concluido, $id_usuario, $id_tarefa);
    //Executando a Instrução SQL
    $stmt->execute();
  }
  
}
