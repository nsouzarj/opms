<?php
/**
 * PHP Script to send email via SMTP (PHPMailer)
 * Multi-recipient and Auto-reply version
 */

// 1. Relatório de erros desativado para produção
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json');

// Importar classes do PHPMailer para o namespace global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 2. Data collection
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

$nome = $_POST['nome'] ?? '';
$email_cliente = $_POST['email'] ?? '';
$assunto = $_POST['assunto'] ?? 'Contato via Site';
$mensagem = $_POST['mensagem'] ?? '';

// Basic validation
if (empty($nome) || empty($email_cliente) || empty($mensagem)) {
    echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos obrigatórios.']);
    exit;
}

// 3. Incluir arquivos do PHPMailer
$baseDir = __DIR__ . '/PHPMailer/src/';

if (file_exists($baseDir . 'PHPMailer.php')) {
    require_once $baseDir . 'Exception.php';
    require_once $baseDir . 'PHPMailer.php';
    require_once $baseDir . 'SMTP.php';

    $mail = new PHPMailer(true);

    try {
        // --- 1. CONFIGURAÇÃO DO SERVIDOR SMTP ---
        $mail->isSMTP();
       // $mail->Host = 'email-ssl.com.br';
        $mail->SMTPAuth = true;
       // $mail->Username = 'contato@opmadvogados.com.br';
       // $mail->Password = 'Sucesso2018';
       // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
       // $mail->Port = 465;
       // $mail->CharSet = 'UTF-8';

        // --- 2. ENVIO PARA OS SÓCIOS (Vários destinatários) ---
        //$mail->setFrom('contato@opmadvogados.com.br', 'Site OPM Advogados');
        
        $destinatarios = [
            'gabriela.bastos@opmadvogados.com.br',
            'gabrielabastos@opmadvogados.com.br',
            'victorhugo@opmadvogados.com.br',
            'victor.hugo@opmadvogados.com.br',
            'demetrio.pimentel@opmadvogados.com.br',
            'demetriopimentel@opmadvogados.com.br'
        ];

        foreach ($destinatarios as $dest) {
            $mail->addAddress($dest);
        }

        $mail->addReplyTo($email_cliente, $nome);

        // Conteúdo do E-mail para os Sócios
        $mail->isHTML(true);
        $mail->Subject = "NOVO CONTATO SITE: " . $assunto;
        $mail->Body = "<h3>Nova mensagem do formulário de contato</h3>
                          <p><b>Nome:</b> {$nome}</p>
                          <p><b>Email:</b> {$email_cliente}</p>
                          <p><b>Assunto:</b> {$assunto}</p>
                          <p><b>Mensagem:</b><br>" . nl2br($mensagem) . "</p>";

        $mail->send();

        // --- 3. ENVIO DA AUTO-RESPOSTA PARA O CLIENTE ---
        $mail->clearAddresses(); // Limpa os destinatários anteriores (sócios)
        $mail->addAddress($email_cliente); // Envia para o cliente agora
        
        $mail->Subject = "Confirmamos o recebimento da sua mensagem - OPM Advogados";
        $mail->Body = "<h3>Olá, {$nome}!</h3>
                          <p>Recebemos o seu contato através do nosso site e agradecemos o seu interesse.</p>
                          <p>Nossa equipe jurídica já foi notificada e entraremos em contato com você o mais breve possível.</p>
                          <br>
                          <p>Atenciosamente,<br><b>Oliveira Pimentel & Melo Advogados Associados</b></p>";
        
        $mail->send();

        echo json_encode(['success' => true, 'message' => 'Mensagem entregue com sucesso!']);

    } catch (Exception $e) {
        // Se falhou o envio para os sócios, avisamos ao front-end
        echo json_encode(['success' => false, 'message' => "Erro no envio do e-mail. " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Erro interno de configuração da biblioteca.']);
}
