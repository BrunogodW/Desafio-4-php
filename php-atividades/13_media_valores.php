<?php
$notas = array_fill(0, 5, "");
$media = null;
$erros = [];
$opcoes = ["options" => ["min_range" => 0, "max_range" => 10]];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $np = $_POST['notas'] ?? [];
  $validas = [];
  for ($i = 0; $i < 5; $i++) {
    $v = filter_var(str_replace(',', '.', trim($np[$i] ?? '')), FILTER_VALIDATE_FLOAT, $opcoes);
    if ($v === false) {
      $erros[] = "Nota " . ($i + 1) . " inválida (0–10).";
      $notas[$i] = htmlspecialchars($np[$i] ?? '');
    } else {
      $validas[] = $v;
      $notas[$i] = $v;
    }
  }
  if (count($erros) == 0)
    $media = array_sum($validas) / count($validas);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>13 - Média de Valores</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Média de 5 Notas</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($media !== null): ?>
      <div class="resultado">Média: <strong><?= number_format($media, 2, ',', '.') ?></strong></div><?php endif; ?>
    <form method="post">
      <?php for ($i = 0; $i < 5; $i++): ?>
        <div><label>Nota <?= $i + 1 ?>:<br><input type="text" name="notas[]"
              value="<?= htmlspecialchars($notas[$i]) ?>"></label></div>
      <?php endfor; ?>
      <input type="submit" value="Calcular Média">
    </form>
  </div>
</body>

</html>