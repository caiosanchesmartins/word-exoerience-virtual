<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa com Ranking de Visitas</title>
    <style>
        body {
            background-color: rgb(34, 34, 34);
            color: white;
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px;
            font-family: Arial Narrow;
        }
        #street-view {
            height: 70vh;
            width: 100%;
            position: relative;
            display: none; /* Esconde o Street View inicialmente */
        }
        #toggle-vr {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: rgb(132, 14, 201);
            color: white;
            cursor: pointer;
            border: none;
            z-index: 10; /* Garante que o botão está acima da imagem do Street View */
        }
        html, body {
            height: 100%;
            margin: 0 auto;
        }
        header {
            height: 10%;
            background-color: rgb(34, 34, 34);
            display: flex;
            align-items: center;
            padding: 0 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            flex-direction: row;
            justify-content: space-between;
        }
        #pac-input {
            width: 300px;
            padding: 10px;
            font-size: 14px;
        }
        input {
            border: none;
            border-radius: 15px;
            height: 26px;
            transition: 0.4s all;
        }
        input:hover {
            border: none;
            border-radius: 15px;
            height: 40px;
            transition: 0.4s all;
        }
        #title {
            flex-direction: column;
            line-height: 10px;
        } 
        li {
            display: inline-block;
            margin: 20px;
            font-size: 20px;
        }
        a {
            color: white;
            transition: 0.3s all;
        }
        a:hover {
            color: rgb(132, 14, 201);
            transition: 0.3s all;
        }
        h1 {
            font-weight: 200;
        }
        #inscreva-se-btn {
            border: 2px solid rgb(132, 14, 201);
            padding: 10px;
            border-radius: 20px;
        }
        #search-button {
            padding: 10px;
            border-radius: 50%;
            background-color: rgb(132, 14, 201);
            border: none;
            cursor: pointer;
        }
        #ranking {
            margin-top: 20px;
        }
        #ranking table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        #ranking th, #ranking td {
            border: 1px solid white;
            padding: 10px;
            text-align: left;
        }
        #ranking th {
            background-color: rgb(132, 14, 201);
        }
        .visit-btn {
            background-color: rgb(132, 14, 201);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        function initMap() {
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);

            var panorama = new google.maps.StreetViewPanorama(
                document.getElementById('street-view'), {
                    pov: {
                        heading: 165,
                        pitch: 0
                    },
                    zoom: 1,
                    enableCloseButton: false
                });

            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                var place = places[0];

                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                // Atualiza a posição do panorama
                panorama.setPosition(place.geometry.location);
                panorama.setVisible(true);
                document.getElementById('street-view').style.display = 'block';

                // Registra a visita no banco de dados via AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("placeName=" + encodeURIComponent(place.name));
            });
        }

        function searchPlaceByName(name) {
            var input = document.getElementById('pac-input');
            input.value = name; // Definindo o valor do input para simular a pesquisa
            google.maps.event.trigger(input, 'focus');
            google.maps.event.trigger(input, 'keydown', {
                keyCode: 13
            });
        }
    </script>
</head>
<body>
    <header>
        <h1 id="title">Mapa de Visitas</h1>
        <input id="pac-input" class="controls" type="text" placeholder="Pesquisar lugar">
        <button id="search-button" onclick="searchPlaceByName(document.getElementById('pac-input').value)">
            🔍
        </button>
    </header>
    <div id="street-view"></div>

    <div id="ranking">
        <h2>Ranking dos Locais Mais Visitados</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome do Lugar</th>
                    <th>Visitas</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexão com o banco de dados
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "places";

                // Cria conexão
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verifica a conexão
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT id FROM places WHERE place_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $placeId);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if ($result->num_rows > 0) 
                    // Se o lugar já existe, atualiza o contador de visitas
                    $sql = "UPDATE places SET visits = visits + 1 WHERE place_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $placeId);
                // Atualiza o número de visitas
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $placeName = isset($_POST['placeName']) ? $_POST['placeName'] : '';

                    $sql = "INSERT INTO places (name, visits) VALUES (?, 1)
                            ON DUPLICATE KEY UPDATE visits = visits + 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $placeName);
                    $stmt->execute();
                    $stmt->close();
                }

                // Consulta os lugares mais visitados
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
            </tbody>
        </table>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlrPK4yuUg9aA7I5v_LMQtU79dFP8_ywg&libraries=places&callback=initMap" async defer></script>
</body>
</html>
