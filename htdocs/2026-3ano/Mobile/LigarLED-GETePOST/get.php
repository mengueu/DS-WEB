<?php
declare(strict_types=1);

function porta_valida(string $porta): bool {
    // Aceita apenas o padrão COM<numero>, ex.: COM3, COM17
    return (bool) preg_match('/^COM[0-9]{1,3}$/i', $porta);
}

$porta_padrao = "COM17";
$porta = $porta_padrao;

if (isset($_GET['porta']) && $_GET['porta'] !== '') {
    $porta_informada = trim((string) $_GET['porta']);
    if (porta_valida($porta_informada)) {
        $porta = strtoupper($porta_informada);
    }
}

$estado_texto = "Aguardando comando";

if (isset($_GET['comando'])) {
    $cmd = $_GET['comando'];

    if (in_array($cmd, ['l', 'd', 'p'], true)) {
        exec("mode {$porta} BAUD=9600 PARITY=N DATA=8 STOP=1");

        $serial = @fopen("\\\\.\\{$porta}", "w+");

        if ($serial) {
            // Aguarda 2 segundos para o Arduino concluir o Auto-Reset
            sleep(2);

            fwrite($serial, $cmd);
            fflush($serial);
            fclose($serial);

            $status_map = ['l' => 'LIGADO', 'd' => 'DESLIGADO', 'p' => 'PISCANDO'];
            $estado_texto = $status_map[$cmd];
        } else {
            $estado_texto = "Erro ao abrir a porta {$porta}.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle do Arduino (GET)</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            max-width: 480px;
            margin: 60px auto;
            color: #222;
        }
        a.voltar {
            font-size: 13px;
            color: #666;
            text-decoration: none;
        }
        .estado {
            margin: 20px 0;
            padding: 12px 16px;
            background: #f5f5f5;
            border-radius: 6px;
        }
        .estado div + div {
            margin-top: 4px;
        }
        label {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
            color: #444;
        }
        input[type="text"] {
            padding: 8px;
            font-size: 14px;
            width: 160px;
        }
        .botoes {
            margin-top: 20px;
        }
        button {
            padding: 10px 16px;
            font-size: 14px;
            margin-right: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <a class="voltar" href="index.php">&larr; Voltar</a>
    <h2>Painel de Controle - Arduino (GET)</h2>

    <div class="estado">
        <div>Porta em uso: <strong><?php echo htmlspecialchars($porta); ?></strong></div>
        <div>Estado enviado: <strong><?php echo htmlspecialchars($estado_texto); ?></strong></div>
    </div>

    <form method="GET" action="get.php">
        <label for="porta">Porta do Arduino</label>
        <input
            type="text"
            id="porta"
            name="porta"
            list="lista-portas"
            value="<?php echo htmlspecialchars($porta); ?>"
            pattern="COM[0-9]{1,3}"
            title="Formato esperado: COM seguido de um número, ex.: COM17"
            required
        >
        <datalist id="lista-portas">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <option value="COM<?php echo $i; ?>">
            <?php endfor; ?>
        </datalist>

        <div class="botoes">
            <button type="submit" name="comando" value="l">Ligar</button>
            <button type="submit" name="comando" value="d">Desligar</button>
            <button type="submit" name="comando" value="p">Piscar</button>
        </div>
    </form>
</body>
</html>