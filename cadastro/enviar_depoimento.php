<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $comentario = $_POST['comentario'];

    $conn = new mysqli("localhost", "root", "", "wev");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Insere o depoimento com o usuario_id correspondente
    $sql = "INSERT INTO depoimentos (usuario_id, comentario, data_postagem) VALUES (?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $usuario_id, $comentario);

    if ($stmt->execute()) {
        echo "<script>document.getElementById('successMessage').style.display = 'block';</script>";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
