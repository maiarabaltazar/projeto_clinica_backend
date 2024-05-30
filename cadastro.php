<?php

 #controle de acesso na api. O * é para dizer que qualquer um pode acessar
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  #a
    // The request is using the POST method
    require("config/db_context.php");


    $db_context = new DbContext();

    //inicia a conexão com o banco de dados
    $db_context->conectar();

    //forma usada para pegar os dados de requisição post (receber o json)
    $json = file_get_contents('php://input');

    $obj = json_decode($json); //função do php que converte o json porque ele nao entende igual acontece no js

    $resultado = $db_context->cadastrar_paciente($obj->nome, $obj->email, $obj->cpf, $obj->senha);
    echo $resultado;

    }



?>