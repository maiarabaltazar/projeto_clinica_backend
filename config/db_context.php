<?php

class DbContext {

    

    private $conexao;

    public function _construct() {

        
        
    }


    public function conectar() {
        $erro = false;
        $hostname = "localhost"; #endereço onde está o banco de dados (aqui está no meu computador)
        $bancodedados = "clinica_salutare";  # nome do banco de dados
        $usuario = "root";
        $senha = "";

     //   $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->dbname);
        $this->conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

        if ($this->conexao->connect_error) {
            die("Conexão falhou: " . $this->conexao->connect_error);
        }
        
    }

    public function desconectar() {
        $this->conexao->close();
    }

    private function executar_query_sql($query) {
        $resultado = $this->conexao->query($query);
        

       if ($resultado->num_rows > 0){
          $linhas = array();
          while ($linha = $resultado->fetch_assoc()) {
                $linhas[] = $linha;
          }

           return json_encode($linhas);
        }
    
        

        return json_encode($resultado);
    }

    public function cadastrar_paciente($nome, $email, $cpf, $senha) {
        $query = "INSERT INTO pacientes (nome, email, cpf, senha) VALUES  ('"
        . $this->conexao->real_escape_string($nome) . "', '"
        . $this->conexao->real_escape_string($email) . "', '"
        . $this->conexao->real_escape_string($cpf) . "', '"
        . $this->conexao->real_escape_string($senha) . "')";
        
        return $this->executar_query_sql($query);
    }

    public function consultar_especialidades() {
        $query = "SELECT * FROM especialidades ORDER BY id";
        return $this->executar_query_sql($query);
    }

    public function agendar_consulta($id_pacientes, $id_especialidades, $dataehora) {
        $query = "INSERT INTO consultas_marcadas (id_pacientes, id_especialidades, dataehora) VALUES  ('"
        . $this->conexao->real_escape_string($id_pacientes) . "', '"
        . $this->conexao->real_escape_string($id_especialidades) . "', '"
        . $this->conexao->real_escape_string($dataehora) . "')";
        
        return $this->executar_query_sql($query);
    }

    public function login($email, $senha) {
        $query = "SELECT id, nome, email, cpf FROM pacientes WHERE email = '" . $email . "' and senha = '" . $senha . "' LIMIT 1";
        return $this->executar_query_sql($query);
    }

    public function atualizar($id, $nome, $matricula) {
        $query = "UPDATE alunos SET nome = '"
        . $this->conexao->real_escape_string($nome) . "', matricula = ". "'"
        . $this->conexao->real_escape_string($matricula) . "'" . "WHERE id = " .$id;

        return $this->executar_query_sql($query);
    }

    public function deletar($id) {
        $query = "DELETE FROM alunos WHERE id = ". $id;
        return $this->executar_query_sql($query);
    }

}

?>