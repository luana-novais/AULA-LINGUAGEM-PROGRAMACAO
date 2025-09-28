<?php include("../cabecalho.php"); ?>

<h2>Exercicio 5</h2>
<form method="post">
    <div class="mb-3">
        <label for="numero" class="form-label">Digite um número</label>
        <input type="number" step="any" id="numero" name="numero" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
function raizQuadrada($numero) {
    return sqrt($numero); 
}

if(isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    $resultado = raizQuadrada($numero);
    echo "A raiz quadrada de $numero é " . number_format($resultado, 2, ',','');
}
include("../rodape.php");
?>

