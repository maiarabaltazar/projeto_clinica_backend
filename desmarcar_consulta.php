<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    require("config/db_context.php");

    $db_context = new DbContext();

    // Inicia a conexão com o banco de dados
    $db_context->conectar();

    
    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    
    
    $resultado = $db_context->desmarcar_consulta($obj->id);
    echo $resultado;    
}
?>
