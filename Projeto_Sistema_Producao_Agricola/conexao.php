<?php

    $dominio = "mysql:host=localhost;dbname=sistema_agricola";
    $usuario = "root";
    $senha = "123456";

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e) {
        die("Erro ao conectar ao banco!".$e->getMessage());
    }