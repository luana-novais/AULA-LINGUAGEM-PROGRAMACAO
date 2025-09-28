<?php include("../cabecalho.php"); ?>
<h2>Exercicio 16</h2>
<form method="post">
<div class="mb-3">
              <label for="valor" class="form-label">Informe o valor do produto</label>
              <input type="number" id="valor" name="valor" class="form-control" required="">
            </div><div class="mb-3">
              <label for="desconto" class="form-label">Informe o desconto </label>
              <input type="text" id="desconto" name="desconto" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $valor = $_POST['valor'];
        $desconto = $_POST['desconto'];
        $valor_desconto = $valor * ($desconto/100);
        $preco_final = $valor - $valor_desconto;

        echo "Preço original: R$ " . number_format($valor, 2, ',', '.') . "<br>";
        echo "Desconto: $desconto%<br>";
        echo "Preço com desconto: R$ " . number_format($preco_final, 2, ',', '.');
    }
?>
<?php include("../rodape.php"); ?>