<?php
include("cabecalho.php");
?>
<h1>Exercicio 4</h1>
<form method="post">
<div class="mb-3">
              <label for="preco" class="form-label">Informe o preço do produto</label>
              <input type="number" id="preco" name="preco" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $preco = $_POST['preco'];

    if ($preco > 100){
        $preco_descontado = $preco - ($preco * 0.15);     
        echo "O valor do produto com desconto é: R$ " . number_format($preco_descontado, 2, ',', '.');

        } else {
            echo "O valor do produto é: R$ " . number_format($preco, 2, ',', '.');
        }    
}

include("rodape.php")
?>