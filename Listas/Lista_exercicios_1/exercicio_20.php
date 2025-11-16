<?php include("../cabecalho.php"); ?>
<h2>Exercicio 20</h2>
<form method="post">
<div class="mb-3">
              <label for="distancia" class="form-label">Informe uma distancia</label>
              <input type="number" id="distancia" name="distancia" class="form-control" required="">
            </div><div class="mb-3">
              <label for="tempo" class="form-label">Informe um tempo</label>
              <input type="number" id="tempo" name="tempo" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $distancia = $_POST['distancia'];
    $tempo = $_POST['tempo'];
    $velocidade = $distancia / $tempo;

    echo "<p>A velocidade média é de: " . number_format($velocidade, 2, ',', '.') . " km/h</p>";
}
?>
<?php include("../rodape.php"); ?>