<?php
echo "<h2>Diagnóstico de Ambiente Web - Detalhado</h2>";

// 1. PHP & Path Info
echo "<b>Versão do PHP:</b> " . PHP_VERSION . "<br>";
echo "<b>Script Absolute Path (__DIR__):</b> " . __DIR__ . "<br>";
echo "<b>Current Working Directory (CWD):</b> " . getcwd() . "<br>";
echo "<b>DOCUMENT_ROOT:</b> " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

// 2. Extensions Check
$exts = ['openssl', 'mbstring', 'sockets'];
foreach ($exts as $ext) {
    if (extension_loaded($ext)) {
        echo "<span style='color:green;'>✔️ Extensão $ext: CARREGADA</span><br>";
    } else {
        echo "<span style='color:red;'>❌ Extensão $ext: NÃO ENCONTRADA</span><br>";
    }
}

// 3. PHPMailer Check
$path = __DIR__ . '/PHPMailer/src/PHPMailer.php';
echo "<br><b>Tentando localizar PHPMailer em:</b> " . $path . "<br>";

if (file_exists($path)) {
    echo "<span style='color:green;'>✔️ PHPMailer encontrado!</span><br>";
    if (is_readable($path)) {
        echo "<span style='color:green;'>✔️ Permissão de leitura: OK</span><br>";
    } else {
        echo "<span style='color:red;'>❌ Sem permissão de leitura no arquivo!</span><br>";
    }
} else {
    echo "<span style='color:red;'>❌ PHPMailer NÃO encontrado neste caminho.</span><br>";
}

// Listar arquivos na pasta atual para ajudar
echo "<br><b>Arquivos na pasta atual:</b><br>";
$files = scandir(__DIR__);
foreach($files as $f) {
    echo "- $f " . (is_dir(__DIR__ . '/' . $f) ? '[DIR]' : '') . "<br>";
}
?>
