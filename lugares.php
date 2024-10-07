<?php
include('include/lugarescon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $placeId = $_POST['placeId'];
    $placeName = $_POST['placeName'];

    if (!empty($placeId) && !empty($placeName)) {
        recordVisit($placeId, $placeName);
    }
}

function recordVisit($placeId, $placeName) 
    global $conn;

    // Verifica se o lugar já existe na tabela
    $sql = "SELECT id FROM places WHERE place_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $placeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o lugar já existe, atualiza o contador de visitas
        $sql = "UPDATE places SET visits = visits + 1 WHERE place_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $placeId);
    } else {
        // Se o lugar não existe, insere um novo registro
        $sql = "INSERT INTO places (place_id, name, visits) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $placeId, $placeName);
    }

$sql = "SELECT name, visits FROM places ORDER BY visits DESC LIMIT 10";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . $row["visits"] . "</td>
                                <td><button class='visit-btn' onclick=\"searchPlaceByName('" . htmlspecialchars($row["name"]) . "')\">Visitar Novamente</button></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum dado disponível</td></tr>";
                }

                $conn->close();
                ?>