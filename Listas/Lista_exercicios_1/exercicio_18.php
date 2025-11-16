<?php include("../cabecalho.php"); ?>
<h2>Exercicio 18</h2>
<form method="post">
<div class="mb-3">
              <label for="capital" class="form-label">Informe um capital</label>
              <input type="number" id="capital" name="capital" class="form-control" required="">
            </div><div class="mb-3">
              <label for="taxa" class="form-label">Informe a taxa</label>
              <input type="number" id="taxa" name="taxa" class="form-control" required="">
            </div><div class="mb-3">
              <label for="periodo" class="form-label">Informe o período</label>
              <input type="number" id="periodo" name="periodo" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $capital = $_POST['capital'];
        $taxa = $_POST['taxa'];
        $periodo = $_POST['periodo'];

        $juros = $capital *(1+ $taxa) ** $periodo;
        echo "O valor do juros é: $juros";
    }

?>

<?php include("../rodape.php"); ?>