<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleinicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Locais Mais Visitados - Nordeste</title>
    <style>
        .ranking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .ranking-item {
            background: #2a2a2a;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 400px; /* Altura fixa para todos os itens */
            max-width: 280px; /* Largura máxima para manter o layout consistente */
            overflow: hidden; /* Evita que conteúdo extra apareça fora da caixa */
        }

        .ranking-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #6A1B9A;
            border-radius: 15px 15px 0 0;
        }

        .ranking-item h3 {
            color: #fff;
            padding: 20px;
            text-align: center;
            transition: color 0.3s;
            cursor: pointer;
        }

        .ranking-item h3:hover {
            color: #6A1B9A;
        }

        .ranking-item p {
            color: #d3d3d3;
            margin: 10px 0;
        }

        .ranking-item .visit-btn {
            background-color: #6A1B9A;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            margin-top: 15px;
        }

        .ranking-item .visit-btn:hover {
            background: #6A1B9A;
            transform: scale(1.1);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #222;
            color: #fff;
            margin: 15% auto;
            padding: 25px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
        }

        .close {
            color: #fff;
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #6A1B9A;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header>
    <nav id="navbar">
        <a href="paginainicio.php" id="nav_logo" class="nav-logo">
            <i class="fa-solid fa-earth-americas">WEV</i>
        </a>
        <ul id="nav_list">
            <li class="nav-item"><a href="cadastro123.php">Cadastro</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle">Regiões</a>
                <ul class="dropdown-menu">
                    <li><a href="sudeste.php">Sudeste</a></li>
                    <li><a href="nordeste.php">Nordeste</a></li>
                    <li><a href="norte.php">Norte</a></li>
                    <li><a href="centro-oeste.php">Centro-Oeste</a></li>
                    <li><a href="sul.php">Sul</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="paginainicio.php#contact">Contato</a></li>
        </ul>
        <button id="mobile_btn">&#9776;</button>
        <div id="mobile_menu">
            <ul id="mobile_nav_list">
                <li><a href="sudeste.php">Sudeste</a></li>
                <li><a href="nordeste.php">Nordeste</a></li>
                <li><a href="norte.php">Norte</a></li>
                <li><a href="centro-oeste.php">Centro-Oeste</a></li>
                <li><a href="sul.php">Sul</a></li>
            </ul>
        </div>
    </nav>
</header>

<section id="ranking">
    <div class="container">
        <h2>Ranking dos Locais Mais Visitados - Nordeste</h2>
        <div class="ranking-grid">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wev";

            // Conectar ao banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Atualizar o número de visitas
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['places_name'])) {
                $place_name = $conn->real_escape_string($_POST['places_name']);
                $update_sql = "UPDATE places SET visits = visits + 1 WHERE name = '$place_name'";
                $conn->query($update_sql);
            }

            // Consultar os locais
            $sql = "SELECT name, lat, lng, visits, foto, regiao, descricao FROM places WHERE regiao = 'nordeste' ORDER BY visits DESC LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Codifica a imagem como base64
                    $imageSrc = "data:image/jpeg;base64," . base64_encode($row["foto"]);
                    echo "<div class='ranking-item'>
                            <img src='/imagens/" . htmlspecialchars($imageSrc) . "' alt='" . htmlspecialchars($row["name"]) . "'>
                            <h3 onclick=\"showModal('" . htmlspecialchars($row["name"]) . "', '" . htmlspecialchars($row["descricao"]) . "')\">" . htmlspecialchars($row["name"]) . "</h3>
                            <p>Visitas: " . $row["visits"] . "</p>
                            <button class='visit-btn' onclick=\"visitPlace('" . htmlspecialchars($row["name"]) . "', " . htmlspecialchars($row["lat"]) . ", " . htmlspecialchars($row["lng"]) . ")\">Visitar Novamente</button>
                          </div>";
                }
            } else {
                // Caso não haja locais, exibe uma mensagem
                echo "<div class='ranking-item' style='height: 400px; display: flex; align-items: center; justify-content: center;'><p>Nenhum dado disponível</p></div>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</section>

<div id="placeModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle"></h2>
        <p id="modalDescription"></p>
    </div>
</div>

<script>
    function visitPlace(placeName, lat, lng) {
        var visitButton = document.querySelector(`.visit-btn[onclick*="'${placeName}'"]`);
        visitButton.disabled = true;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", window.location.href, true); // Enviar para o mesmo arquivo
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error("Erro ao enviar a solicitação: " + xhr.status);
                }
                visitButton.disabled = false;
            }
        };
        xhr.send("places_name=" + encodeURIComponent(placeName));

        window.location.href = `inicio.html?lat=${lat}&lng=${lng}`;
    }

    function showModal(placeName, description) {
        document.getElementById('modalTitle').innerText = placeName;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('placeModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('placeModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('placeModal')) {
            closeModal();
        }
    }

    document.getElementById('nav_logo').addEventListener('click', function() {
        window.location.href = 'paginainicio.php';
    });
</script>
<footer></footer>
</body>
</html>
