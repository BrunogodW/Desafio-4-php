<?php
$dia = "";
$resultado = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $v = filter_var($_POST['dia'] ?? '', FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 7]]);
  if ($v === false) {
    $erros[] = "Selecione um dia válido.";
  } else {
    $dia = $v;
    $dias = [1 => "Domingo", 2 => "Segunda-feira", 3 => "Terça-feira", 4 => "Quarta-feira", 5 => "Quinta-feira", 6 => "Sexta-feira", 7 => "Sábado"];
    $resultado = $dias[$dia];
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>07 - Dia da Semana</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Dia da Semana</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($resultado !== null): ?>
      <div class="resultado"><?= $dia ?> — <strong><?= $resultado ?></strong></div><?php endif; ?>
    <form method="post">
      <div><label>Número do dia:<br>
          <select name="dia">
            <option value="">-- Selecione --</option>
            <?php for ($i = 1; $i <= 7; $i++): ?>
              <option value="<?= $i ?>" <?= $dia == $i ? 'selected' : '' ?>><?= $i ?></option><?php endfor; ?>
          </select>
        </label></div>
      <input type="submit" value="Ver Dia">
    </form>
  </div>
</body>

</html>