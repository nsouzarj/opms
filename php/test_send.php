<?php
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST['nome'] = 'Teste';
$_POST['email'] = 'test@example.com';
$_POST['mensagem'] = 'Mensagem de teste';
$_POST['assunto'] = 'Assunto teste';

include 'send_email.php';
?>
