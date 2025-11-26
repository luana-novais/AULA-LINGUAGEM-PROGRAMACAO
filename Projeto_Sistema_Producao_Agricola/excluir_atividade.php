<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: atividades.php?excluir=false');
        exit();
    }
    
    $id = $_GET['id'];
    
    try{
        $stmt = $pdo->prepare("DELETE FROM atividades WHERE id_atividade = ?");
        
        if($stmt->execute([$id])){
            header('location: atividades.php?excluir=true');
            exit();
        } else {
            header('location: atividades.php?excluir=false');
            exit();
        }
    } catch(\PDOException $e){
        echo "Erro ao excluir atividade: ".$e->getMessage();
    }
} else {
    header('location: atividades.php');
    exit();
}