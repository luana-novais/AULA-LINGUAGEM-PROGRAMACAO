<?php include("../cabecalho.php"); ?>

<h1>Exercício 2</h1>
<form method="post">
<?php for($i=1; $i<=5; $i++): ?>
    <div class="mb-3">
        <label for="nome[]" class="form-label">Insira o nome do <?= $i ?>º aluno:</label>
        <input type="text" id="nome[]" name="nome[]" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="nota1[]" class="form-label">Insira a primeira nota do <?= $i ?>º aluno:</label>
        <input type="number" step="any" id="nota1[]" name="nota1[]" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="nota2[]" class="form-label">Insira a segunda nota do <?= $i ?>º aluno:</label>
        <input type="number" step="any" id="nota2[]" name="nota2[]" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="nota3[]" class="form-label">Insira a terceira nota do <?= $i ?>º aluno:</label>
        <input type="number" step="any" id="nota3[]" name="nota3[]" class="form-control" required>
    </div>
<?php endfor; ?>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomes = $_POST['nome'];
    $notas1 = $_POST['nota1'];
    $notas2 = $_POST['nota2'];
    $notas3 = $_POST['nota3'];

    $alunos = [];

    for($i = 0; $i < 5; $i++){
        $media = ($notas1[$i] + $notas2[$i] + $notas3[$i]) / 3;
        $alunos[$nomes[$i]] = $media;
    }

    arsort($alunos);

    echo "<h3>Lista de Alunos e Médias</h3>";
    foreach($alunos as $nome => $media){
        echo "<p>$nome | Média: ".number_format($media,2,",",".")."</p>";
    }
}

include("../rodape.php");
?>
