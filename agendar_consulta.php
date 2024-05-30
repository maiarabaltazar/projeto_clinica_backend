<?php

header("Acess-Control-Allow-Origin: *");

require("config/db_context.php");


$db_context = new DbContext();

//inicia a conexão com o banco de dados
$db_context->conectar();

$json = file_get_contents('php://input');

$obj = json_decode($json); //função do php que converte o json porque ele nao entende igual acontece no js

$resultado = $db_context->agendar_consulta($obj->id_pacientes, $obj->id_especialidades, $obj->dataehora);
echo $resultado;