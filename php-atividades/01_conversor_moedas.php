<?php
$reais = $cotacao = "";
$resultado = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $reais_val = filter_var(str_replace(',', '.', trim($_POST['reais'] ?? '')), FILTER_VALIDATE_FLOAT);
  $cotacao_val = filter_var(str_replace(',', '.', trim($_POST['cotacao'] ?? '')), FILTER_VALIDATE_FLOAT);
  if ($reais_val === false || $reais_val <= 0) {
    $erros[] = "Valor em Reais inválido.";
    $reais = htmlspecialchars($_POST['reais']);
  } else {
    $reais = $reais_val;
  }
  if ($cotacao_val === false || $cotacao_val <= 0) {
    $erros[] = "Cotação inválida.";
    $cotacao = htmlspecialchars($_POST['cotacao']);
  } else {
    $cotacao = $cotacao_val;
  }
  if (count($erros) == 0)
    $resultado = $reais / $cotacao;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>01 - Conversor de Moedas</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Conversor de Moedas</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($resultado !== null): ?>
      <div class="resultado">R$ <?= number_format($reais, 2, ',', '.') ?> equivalem a US$
        <?= number_format($resultado, 2, ',', '.') ?></div><?php endif; ?>
    <form method="post">
      <div><label>Valor em R$:<br><input type="text" name="reais" value="<?= htmlspecialchars($reais) ?>"></label></div>
      <div><label>Cotação do Dólar:<br><input type="text" name="cotacao"
            value="<?= htmlspecialchars($cotacao) ?>"></label></div>
      <input type="submit" value="Converter">
    </form>
  </div>
</body>

</html>