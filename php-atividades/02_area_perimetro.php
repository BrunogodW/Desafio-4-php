<?php
$base = $altura = "";
$area = $perimetro = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bv = filter_var(str_replace(',', '.', trim($_POST['base'] ?? '')), FILTER_VALIDATE_FLOAT);
  $av = filter_var(str_replace(',', '.', trim($_POST['altura'] ?? '')), FILTER_VALIDATE_FLOAT);
  if ($bv === false || $bv <= 0) {
    $erros[] = "Base inválida.";
    $base = htmlspecialchars($_POST['base']);
  } else {
    $base = $bv;
  }
  if ($av === false || $av <= 0) {
    $erros[] = "Altura inválida.";
    $altura = htmlspecialchars($_POST['altura']);
  } else {
    $altura = $av;
  }
  if (count($erros) == 0) {
    $area = $base * $altura;
    $perimetro = 2 * ($base + $altura);
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>02 - Área e Perímetro</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Área e Perímetro do Retângulo</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($area !== null): ?>
      <div class="resultado">Área: <?= number_format($area, 2, ',', '.') ?> m² &nbsp;|&nbsp; Perímetro:
        <?= number_format($perimetro, 2, ',', '.') ?> m</div><?php endif; ?>
    <form method="post">
      <div><label>Base (m):<br><input type="text" name="base" value="<?= htmlspecialchars($base) ?>"></label></div>
      <div><label>Altura (m):<br><input type="text" name="altura" value="<?= htmlspecialchars($altura) ?>"></label>
      </div>
      <input type="submit" value="Calcular">
    </form>
  </div>
</body>

</html>