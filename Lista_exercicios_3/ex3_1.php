<?php
include("../Lista_exercicios_2/cabecalho.php");
?>

<h2>Exercício 1</h2>

<form method="post">
    <div class="mb-3">
        <label for="palavra" class="form-label">Digite uma palavra:</label>
        <input type="text" class="form-control" id="palavra" name="palavra" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
function contarCaracteres($palavra) {
    return strlen($palavra);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $palavra = $_POST['palavra'];
    $resultado = contarCaracteres($palavra);
    echo "<div class='alert alert-info'>A palavra '$palavra' tem $resultado caracteres.</div>";
}
?>
