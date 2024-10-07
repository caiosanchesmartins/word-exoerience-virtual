<?php
session_start(); // Inicie a sessão
include 'include/conexao.php'; // Certifique-se de que o caminho está correto

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; 

        // Gera o hash da senha
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        // Agora bind o hash da senha
        $stmt->bind_param("sss", $username, $email, $passwordHash);

        if ($stmt->execute()) {
            header("Location: paginainicio.php?msg=cadastro_sucesso");
            exit();
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }

    $conn->close();
}
?>
