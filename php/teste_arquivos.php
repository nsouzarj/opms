<?php
echo "<h2>Teste de Leitura de Arquivos PHPMailer</h2>";

$baseDir = __DIR__ . '/PHPMailer/src/';
$files = ['Exception.php', 'PHPMailer.php', 'SMTP.php'];

echo "<b>Diretório base:</b> $baseDir <br><br>";

foreach ($files as $file) {
    $fullPath = $baseDir . $file;
    echo "Pesquisando por: $file ... ";
    
    if (file_exists($fullPath)) {
        echo "<span style='color:green;'>ENCONTRADO ✔️</span>";
        if (is_readable($fullPath)) {
            echo " | <span style='color:green;'>LEITURA OK! ✔️</span><br>";
            
            // Tenta incluir (require) para ver se dá erro fatal
            try {
                include_once $fullPath;
                echo " -- <span style='color:blue;'>Arquivado carregado com sucesso!</span><br>";
            } catch (Throwable $e) {
                echo " -- <span style='color:red;'>ERRO AO CARREGAR: " . $e->getMessage() . "</span><br>";
            }
            
        } else {
            echo " | <span style='color:red;'>SEM PERMISSÃO DE LEITURA! ❌</span><br>";
        }
    } else {
        echo "<span style='color:red;'>NÃO ENCONTRADO! ❌</span><br>";
        
        // Listar o que tem na pasta src para ver se o nome está estranho
        if (is_dir($baseDir)) {
            echo " -- Arquivos na pasta /src/ : " . implode(', ', scandir($baseDir)) . "<br>";
        } else {
             echo " -- A pasta " . dirname($baseDir) . " existe? " . (is_dir(dirname($baseDir)) ? 'SIM' : 'NÃO') . "<br>";
        }
    }
}

echo "<br><b>Teste final de instanciação:</b><br>";
if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    echo "<span style='color:green;'>A CLASSE PHPMailer EXISTE NO SISTEMA! ✔️</span>";
} else {
    echo "<span style='color:red;'>A CLASSE PHPMailer AINDA NÃO EXISTE. ❌</span>";
}
?>
