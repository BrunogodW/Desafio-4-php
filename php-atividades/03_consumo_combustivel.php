<?php
$distancia = $combustivel = "";
$consumo = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $dv = filter_var(str_replace(',', '.', trim($_POST['distancia'] ?? '')), FILTER_VALIDATE_FLOAT);
  $cv = filter_var(str_replace(',', '.', trim($_POST['combustivel'] ?? '')), FILTER_VALIDATE_FLOAT);
  if ($dv === false || $dv <= 0) {
    $erros[] = "Distância inválida.";
    $distancia = htmlspecialchars($_POST['distancia']);
  } else {
    $distancia = $dv;
  }
  if ($cv === false || $cv <= 0) {
    $erros[] = "Combustível inválido.";
    $combustivel = htmlspecialchars($_POST['combustivel']);
  } else {
    $combustivel = $cv;
  }
  if (count($erros) == 0)
    $consumo = $distancia / $combustivel;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>03 - Consumo de Combustível</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Consumo de Combustível</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($consumo !== null): ?>
      <div class="resultado">Consumo médio: <?= number_format($consumo, 2, ',', '.') ?> Km/L</div><?php endif; ?>
    <form method="post">
      <div><label>Distância (Km):<br><input type="text" name="distancia"
            value="<?= htmlspecialchars($distancia) ?>"></label></div>
      <div><label>Combustível gasto (L):<br><input type="text" name="combustivel"
            value="<?= htmlspecialchars($combustivel) ?>"></label></div>
      <input type="submit" value="Calcular">
    </form>
  </div>
</body>

</html>