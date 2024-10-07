<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wev";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['places_name'])) {
    $place_name = $conn->real_escape_string($_POST['places_name']);

    $update_sql = "UPDATE places SET visits = visits + 1 WHERE name = '$place_name'";
    if ($conn->query($update_sql) === TRUE) {
        // Retorna a nova contagem de visitas
        $result = $conn->query("SELECT visits FROM places WHERE name = '$place_name'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['visits'];
        }
    } else {
        echo "Erro ao atualizar visitas: " . $conn->error;
    }
}

$conn->close();
?>
