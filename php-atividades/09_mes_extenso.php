<?php
$mes = "";
$resultado = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $v = filter_var($_POST['mes'] ?? '', FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 12]]);
  if ($v === false) {
    $erros[] = "Selecione um mês válido.";
  } else {
    $mes = $v;
    $meses = [
      1 => "Janeiro",
      2 => "Fevereiro",
      3 => "Março",
      4 => "Abril",
      5 => "Maio",
      6 => "Junho",
      7 => "Julho",
      8 => "Agosto",
      9 => "Setembro",
      10 => "Outubro",
      11 => "Novembro",
      12 => "Dezembro"
    ];
    $resultado = $meses[$mes];
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>09 - Mês por Extenso</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Mês por Extenso</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($resultado !== null): ?>
      <div class="resultado"><?= $mes ?> — <strong><?= $resultado ?></strong></div><?php endif; ?>
    <form method="post">
      <div><label>Número do mês:<br>
          <select name="mes">
            <option value="">-- Selecione --</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
              <option value="<?= $i ?>" <?= $mes == $i ? 'selected' : '' ?>><?= $i ?></option><?php endfor; ?>
          </select>
        </label></div>
      <input type="submit" value="Ver Mês">
    </form>
  </div>
</body>

</html>