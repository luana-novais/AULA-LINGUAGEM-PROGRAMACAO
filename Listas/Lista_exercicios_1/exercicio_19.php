<?php include("../cabecalho.php"); ?>
<h2>Exercicio 19</h2>
<form method="post">
<div class="mb-3">
              <label for="dias" class="form-label">Informar a quantidade de dias</label>
              <input type="text" id="dias" name="dias" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $dias = $_POST['dias'];
        $horas = $dias * 24;
        $minutos = $horas * 60;
        $segundos = $minutos * 60;
        echo "<p>A quantidade de dias é equivalente a:</p>";
        echo"<ul>";
        echo"<li>Horas: $horas</li>";
        echo"<li>Minutos: $minutos</li>";
        echo"<li>Segundos: $segundos</li>";
        echo"</ul>";
    }
?>
<?php include("../rodape.php"); ?>