<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: culturas.php?excluir=false');
        exit();
    }
    
    $id = $_GET['id'];
    
    try{
        $stmt = $pdo->prepare("DELETE FROM culturas WHERE id_cultura = ?");
        
        if($stmt->execute([$id])){
            header('location: culturas.php?excluir=true');
            exit();
        } else {
            header('location: culturas.php?excluir=false');
            exit();
        }
    } catch(\PDOException $e){
        echo "Erro ao excluir cultura: ".$e->getMessage();
    }
} else {
    header('location: culturas.php');
    exit();
}