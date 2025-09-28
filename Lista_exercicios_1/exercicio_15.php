<?php include("../cabecalho.php"); ?>
<h2>Exercicio 15</h2>
<form method="post">
  <div class="mb-3">
    <label for="altura" class="form-label">Informe sua altura (em m)</label>
    <input type="number" id="altura" name="altura" class="form-control" step="0.01" required>
  </div>
  <div class="mb-3">
    <label for="peso" class="form-label">Informe seu peso (em kg)</label>
    <input type="number" id="peso" name="peso" class="form-control" step="0.1" required>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $altura = (float) $_POST['altura'];
    $peso = (float) $_POST['peso'];

    if ($altura > 0) {
        $imc = $peso / ($altura ** 2);
        echo "<p>O seu IMC é: " . number_format($imc, 2, ',', '.') . "</p>";
    } else {
        echo "<p style='color:red;'>Altura inválida!</p>";
    }
}
?>    

<?php include("../rodape.php"); ?>
