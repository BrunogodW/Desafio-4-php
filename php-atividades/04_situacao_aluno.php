<?php
$n1 = $n2 = "";
$media = null;
$situacao = "";
$erros = [];
$opcoes = ["options" => ["min_range" => 0, "max_range" => 10]];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach (['n1', 'n2'] as $c) {
        $v = filter_var(str_replace(',', '.', trim($_POST[$c] ?? '')), FILTER_VALIDATE_FLOAT, $opcoes);
        if ($v === false) {
            $erros[] = strtoupper($c) . " inválida (0–10).";
            $$c = htmlspecialchars($_POST[$c]);
        } else {
            $$c = $v;
        }
    }
    if (count($erros) == 0) {
        $media = ($n1 + $n2) / 2;
        $situacao = $media >= 7 ? "Aprovado" : ($media >= 4 ? "Em Recuperação" : "Reprovado");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>04 - Situação do Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <a class="back" href="index.html">&larr; Voltar ao índice</a>
        <h2>Situação do Aluno</h2>
        <?php if ($erros): ?>
            <div class="erro">
                <ul><?php foreach ($erros as $e)
                    echo "<li>$e</li>"; ?></ul>
            </div><?php endif; ?>
        <?php if ($media !== null): ?>
            <div class="resultado">Média: <?= number_format($media, 2, ',', '.') ?> — <strong><?= $situacao ?></strong></div>
        <?php endif; ?>
        <form method="post">
            <div><label>Nota 1:<br><input type="text" name="n1" value="<?= htmlspecialchars($n1) ?>"></label></div>
            <div><label>Nota 2:<br><input type="text" name="n2" value="<?= htmlspecialchars($n2) ?>"></label></div>
            <input type="submit" value="Calcular">
        </form>
    </div>
</body>

</html>