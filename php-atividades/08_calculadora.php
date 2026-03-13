<?php
$n1 = $n2 = $operacao = "";
$resultado = null;
$simbolo = "";
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $n1v = filter_var(str_replace(',', '.', trim($_POST['n1'] ?? '')), FILTER_VALIDATE_FLOAT);
  $n2v = filter_var(str_replace(',', '.', trim($_POST['n2'] ?? '')), FILTER_VALIDATE_FLOAT);
  $operacao = $_POST['operacao'] ?? '';
  if ($n1v === false) {
    $erros[] = "N1 inválido.";
    $n1 = htmlspecialchars($_POST['n1']);
  } else {
    $n1 = $n1v;
  }
  if ($n2v === false) {
    $erros[] = "N2 inválido.";
    $n2 = htmlspecialchars($_POST['n2']);
  } else {
    $n2 = $n2v;
  }
  if (!in_array($operacao, ['somar', 'subtrair', 'multiplicar', 'dividir']))
    $erros[] = "Selecione uma operação.";
  if (count($erros) == 0) {
    switch ($operacao) {
      case 'somar':
        $resultado = $n1 + $n2;
        $simbolo = '+';
        break;
      case 'subtrair':
        $resultado = $n1 - $n2;
        $simbolo = '-';
        break;
      case 'multiplicar':
        $resultado = $n1 * $n2;
        $simbolo = '×';
        break;
      case 'dividir':
        if ($n2 == 0)
          $erros[] = "Divisão por zero não permitida.";
        else {
          $resultado = $n1 / $n2;
          $simbolo = '÷';
        }
        break;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>08 - Calculadora Simples</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Calculadora Simples</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($resultado !== null): ?>
      <div class="resultado"><?= $n1 ?>   <?= $simbolo ?>   <?= $n2 ?> =
        <strong><?= number_format($resultado, 2, ',', '.') ?></strong></div><?php endif; ?>
    <form method="post">
      <div><label>N1:<br><input type="text" name="n1" value="<?= htmlspecialchars($n1) ?>"></label></div>
      <div><label>N2:<br><input type="text" name="n2" value="<?= htmlspecialchars($n2) ?>"></label></div>
      <div><label>Operação:<br>
          <select name="operacao">
            <option value="">-- Selecione --</option>
            <option value="somar" <?= $operacao == 'somar' ? 'selected' : '' ?>>Somar</option>
            <option value="subtrair" <?= $operacao == 'subtrair' ? 'selected' : '' ?>>Subtrair</option>
            <option value="multiplicar" <?= $operacao == 'multiplicar' ? 'selected' : '' ?>>Multiplicar</option>
            <option value="dividir" <?= $operacao == 'dividir' ? 'selected' : '' ?>>Dividir</option>
          </select>
        </label></div>
      <input type="submit" value="Calcular">
    </form>
  </div>
</body>

</html>