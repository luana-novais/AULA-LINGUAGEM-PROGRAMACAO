<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: areas.php?excluir=false');
        exit();
    }
    
    $id = $_GET['id'];
    
    try{
        $stmt = $pdo->prepare("DELETE FROM areas WHERE id_area = ?");
        
        if($stmt->execute([$id])){
            header('location: areas.php?excluir=true');
            exit();
        } else {
            header('location: areas.php?excluir=false');
            exit();
        }
    } catch(\PDOException $e){
        echo "Erro ao excluir area: ".$e->getMessage();
    }
} else {
    header('location: areas.php');
    exit();
}