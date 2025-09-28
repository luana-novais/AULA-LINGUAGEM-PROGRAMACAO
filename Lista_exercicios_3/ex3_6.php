<?php include("../cabecalho.php"); ?>

<h2>Exercicio 6</h2>
<form method="post">
    <div class="mb-3">
        <label for="numero" class="form-label">Digite um número</label>
        <input type="number" step="any" id="numero" name="numero" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
function arredondarNumero($numero) {
    return round($numero); 
}

if(isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    $resultado = arredondarNumero($numero);
    echo "O número $numero arredondado é $resultado";
}
include("../rodape.php");
?>
