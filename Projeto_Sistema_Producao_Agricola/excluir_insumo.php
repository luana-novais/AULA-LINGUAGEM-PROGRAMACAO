<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: insumos.php?excluir=false');
        exit();
    }
    
    $id = $_GET['id'];
    
    try{
        $stmt = $pdo->prepare("DELETE FROM insumos WHERE id_insumo = ?");
        
        if($stmt->execute([$id])){
            header('location: insumos.php?excluir=true');
            exit();
        } else {
            header('location: insumos.php?excluir=false');
            exit();
        }
    } catch(\PDOException $e){
        echo "Erro ao excluir insumo: ".$e->getMessage();
    }
} else {
    header('location: insumos.php');
    exit();
}