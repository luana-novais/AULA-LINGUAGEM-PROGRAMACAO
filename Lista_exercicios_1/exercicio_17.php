<?php include("../cabecalho.php"); ?>
<h2>Exercicio 17</h2>
<form method="post">
<div class="mb-3">
              <label for="capital" class="form-label">Informe o capital</label>
              <input type="number" id="capital" name="capital" class="form-control" required="">
            </div><div class="mb-3">
              <label for="juros" class="form-label">Informe a taxa de juros</label>
              <input type="number" id="juros" name="juros" class="form-control" required="">
            </div><div class="mb-3">
              <label for="periodo" class="form-label">Informe o período </label>
              <input type="number" id="periodo" name="periodo" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $capital = $_POST['capital'];
        $juros = $_POST['juros'];
        $periodo = $_POST['periodo'];

        $juros_simples = $capital * ($juros / 100) * $periodo;
        $montante = $capital + $juros_simples;
        
        echo "<p>O juros simples será de: R$ " . number_format($juros_simples, 2, ',', '.') . "</p>";
        echo "<p>O montante final será de: R$ " . number_format($montante, 2, ',', '.') . "</p>";

    }
?>    
<?php include("../rodape.php"); ?>