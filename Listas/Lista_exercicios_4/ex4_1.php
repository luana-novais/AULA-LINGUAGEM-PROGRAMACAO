<?php include("../cabecalho.php"); ?>

<h1>Exercício 1</h1>
<form method="post">
<div class="mb-3">
            <?php for($i=1;$i<=5;$i++):?>
              <label for="nome[]" class="form-label">Digite o <?= $i ?>º nome:</label>
              <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
            </div><div class="mb-3">
              <label for="telefone[]" class="form-label">Digite o <?= $i ?>º número de telefone:</label>
              <input type="number" id="telefone[]" name="telefone[]" class="form-control" required="">
            <?php endfor; ?>
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nomes = $_POST['nome'];
        $telefones = $_POST['telefone'];

        $contatos = [];      

        for($i = 0; $i < 5; $i++){
            $nome = ($nomes[$i]);
            $telefone = ($telefones[$i]);

            if(isset($contatos[$nome])){
                echo "<p>Contato duplicado ignorado (nome): $nome - $telefone</p>";
            } elseif(in_array($telefone, $contatos)){
                echo "<p>Contato duplicado ignorado (telefone): $nome - $telefone</p>";
            } else {
                $contatos[$nome] = $telefone;
            }
        }

        ksort($contatos);

        foreach($contatos as $nome => $telefone){
            echo "<p>$nome | $telefone</p>";
        }
    }

    include("../rodape.php");
?>
