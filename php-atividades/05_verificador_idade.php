<?php
$ano_nasc = "";
$idade = null;
$situacao = "";
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ano_atual = (int) date('Y');
    $v = filter_var(trim($_POST['ano_nasc'] ?? ''), FILTER_VALIDATE_INT);
    if ($v === false || $v < 1900 || $v > $ano_atual) {
        $erros[] = "Ano de nascimento inválido.";
        $ano_nasc = htmlspecialchars($_POST['ano_nasc']);
    } else {
        $ano_nasc = $v;
        $idade = $ano_atual - $v;
        if ($idade < 16)
            $situacao = "Não pode votar";
        elseif ($idade < 18)
            $situacao = "Voto Facultativo";
        elseif ($idade < 70)
            $situacao = "Voto Obrigatório";
        else
            $situacao = "Voto Facultativo";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>05 - Verificador de Idade</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <a class="back" href="index.html">&larr; Voltar ao índice</a>
        <h2>Verificador de Idade (Votação)</h2>
        <?php if ($erros): ?>
            <div class="erro">
                <ul><?php foreach ($erros as $e)
                    echo "<li>$e</li>"; ?></ul>
            </div><?php endif; ?>
        <?php if ($idade !== null): ?>
            <div class="resultado">Idade: <?= $idade ?> anos — <strong><?= $situacao ?></strong></div><?php endif; ?>
        <form method="post">
            <div><label>Ano de nascimento:<br><input type="text" name="ano_nasc"
                        value="<?= htmlspecialchars($ano_nasc) ?>"></label></div>
            <input type="submit" value="Verificar">
        </form>
    </div>
</body>

</html>