<?php include("../cabecalho.php"); ?>

<h2>Exercicio 2</h2>
<form method="post">
    <div class="mb-3">
        <label for="palavra" class="form-label">Digite uma palavra:</label>
        <input type="text" id="palavra" name="palavra" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
<?php
function maiusculoMinusculo($palavra) {
    return [
        'maiusculo' => strtoupper($palavra), 
        'minusculo' => strtolower($palavra)  
    ];
}

if(isset($_POST['palavra'])) {
    $palavra = $_POST['palavra'];
    $resultado = maiusculoMinusculo($palavra);
    echo "<p> Maiúsculo: " . $resultado['maiusculo'] . "</p>";
    echo "<p> Minúsculo: " . $resultado['minusculo'] . "</p>"; 
}
include("../rodape.php");
?>
