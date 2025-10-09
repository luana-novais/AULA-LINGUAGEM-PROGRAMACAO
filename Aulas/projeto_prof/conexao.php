<?php

    $dominio = "mysql:host=localhost;dbname=projetophp"; 
    $usuario = "root";
    $senha = "";

    try {
        //sequencia de ações que a gente quer q aconteça
        $pdo = new PDO($dominio, $usuario, $senha); // PDO classe interna para manipular os dados do banco
    } catch (Exception $e){
        //tratar os erros, as exceções que pode ocorrer
        die("Erro ao conectar ao banco!".$e->getMessage()); //mata a aplicação    
    }
?>