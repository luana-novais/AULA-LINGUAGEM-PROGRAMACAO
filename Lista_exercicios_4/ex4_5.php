<?php include("../cabecalho.php"); ?>


<h1>Exercício 5</h1>
<form method="post">
        <?php for($i=1;$i<=5;$i++):?>
        <div class="mb-3">
                <label for="titulo[]" class="form-label">Insira o título do <?= $i ?>º livro:</label>
                <input type="text" id="titulo[]" name="titulo[]" class="form-control" required="">
        </div>
        <div class="mb-3">
                <label for="quantidade[]" class="form-label">Insira a quantidade do <?= $i ?>º livro:</label>
                <input type="number" id="quantidade[]" name="quantidade[]" class="form-control" required="">
        </div>
        <?php endfor; ?>
        <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulos = $_POST['titulo'];
    $quantidades = $_POST['quantidade'];

    $livros = [];

    for($i=0; $i<5; $i++){
        $livros[$titulos[$i]] = (int)$quantidades[$i];
    }

    ksort($livros);

    echo "<h3>Livros em Estoque</h3>";
    foreach($livros as $titulo => $quantidade){
        echo "$titulo | Estoque: $quantidade";
        if($quantidade < 5){
            echo " <strong style='color:red;'>(Estoque baixo!)</strong>";
        }
        echo "<br>";
    }
}

    include("../rodape.php");
?>