<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require("config/db_context.php");


$db_context = new DbContext();

//inicia a conexão com o banco de dados
$db_context->conectar();

$resultado = $db_context->minhas_consultas($_GET['id_pacientes']);
echo $resultado;

