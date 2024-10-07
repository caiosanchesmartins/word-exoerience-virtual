<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleinicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Locais Mais Visitados - Sul</title>
    <style>

#nav_logo {
    font-size: 36px; /* Ajuste o tamanho do ícone */
    color: #6A1B9A;
    margin-right: auto; /* Adiciona margem automática para empurrar o logo para a esquerda */
    text-decoration: none; /* Remove o sublinhado padrão do link */
    cursor: pointer; /* Torna o cursor um ponteiro para indicar que é clicável */
}
  
  #nav_logo span {
    display: inline-block; /* Se necessário para garantir que o conteúdo se comporte como esperado */
}

.destinations-grid, .ranking-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 15px;
}

.destination, .ranking-item {
    
    background: #2a2a2a; /* Fundo dos cartões suavemente escurecido */
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); /* Sombras mais suaves */
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.destination img, .ranking-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 3px solid #6A1B9A;
    border-radius: 15px 15px 0 0;

}

.destination h3, .ranking-item h3 {
    color: #fff; /* Título branco para contraste */
    padding: 20px;
    text-align: center;
    transition: color 0.3s;
    cursor: pointer;
}

.destination h3:hover, .ranking-item h3:hover {
    color: #6A1B9A;
    
}

.ranking-item h3 a {
    color: inherit; /* Mantém a cor do elemento pai */
    text-decoration: none;
}

.destination:hover, .ranking-item:hover {
    
    transform: translateY(-12px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6); /* Sombra mais forte ao passar o mouse */
}

.ranking-item p {
    color: #d3d3d3; /* Texto mais claro para contraste */
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
    display: none; /* Inicialmente escondido */
    position: fixed; /* Fica fixo na tela */
    z-index: 1000; /* Fica acima de outros conteúdos */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Adiciona rolagem se necessário */
    background-color: rgba(0, 0, 0, 0.7); /* Fundo preto semi-transparente */
}

.modal-content {
    background-color: #222; /* Fundo preto */
    color: #fff; /* Texto branco */
    margin: 15% auto; /* Centraliza o modal */
    padding: 25px;
    border-radius: 10px;
    width: 80%; /* Largura do modal */
    max-width: 600px; /* Largura máxima do modal */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
}

.close {
    color: #fff; /* Cor do botão de fechar */
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
#mobile_menu {
            display: none;
            background-color: #333;
            padding: 10px;
            position: absolute;
            top: 60px;
            right: 10px;
            width: 200px;
            border-radius: 5px;
        }

        #mobile_menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #mobile_menu li {
            margin-bottom: 10px;
        }

        #mobile_menu li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        #mobile_menu li a:hover {
            color: #6A1B9A;
        }

        #mobile_btn {
            font-size: 24px;
            cursor: pointer;
            color: #6A1B9A;
            background: none;
            border: none;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            #nav_list {
                display: none;
            }

            #mobile_btn {
                display: block;
            }
        }

        .success-message {
    background-color: #4CAF50; /* Verde para sucesso */
    color: white;
    padding: 15px;
    border-radius: 5px;
    margin: 20px 0;
    text-align: center;
}

    </style>

    </style>
</head>

<body>
<header>
    <nav id="navbar">
    <a href="paginainicio.php" id="nav_logo" class="nav-logo">
    <i class="fa-solid fa-earth-americas"></i> WEV
</a>

        <ul id="nav_list">
            <li class="nav-item"><a href="cadastro123.php">Cadastro</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle">Regiões</a>
                <ul class="dropdown-menu">
                    <li><a href="listagem_places.php?place=Sudeste">Sudeste</a></li>
                    <li><a href="listagem_places.php?place=Nordeste">Nordeste</a></li>
                    <li><a href="listagem_places.php?place=Norte">Norte</a></li>
                    <li><a href="listagem_places.php?place=Centro-Oeste">Centro-Oeste</a></li>
                    <li><a href="listagem_places.php?place=Sul">Sul</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#contact">Contato</a></li>
        </ul>
        <button id="mobile_btn">&#9776;</button>
    </nav>
    <div id="mobile_menu">
        <ul id="mobile_nav_list">
            <li><a href="cadastro123.php">Cadastro</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle">Regiões</a>
                <ul class="dropdown-menu">
                    <li><a href="listagem_places.php?place=Sudeste">Sudeste</a></li>
                    <li><a href="listagem_places.php?place=Nordeste">Nordeste</a></li>
                    <li><a href="listagem_places.php?place=Norte">Norte</a></li>
                    <li><a href="listagem_places.php?place=Centro-Oeste">Centro-Oeste</a></li>
                    <li><a href="listagem_places.php?place=Sul">Sul</a></li>
                </ul>
            </li>
            <li><a href="#contact">Contato</a></li>
        </ul>
    </div>
</header>

    <section id="ranking">
        <div class="container">
            <h2>Ranking dos Locais Mais Visitados - Sul</h2>
            <div class="ranking-grid">
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
                        $conn->query($update_sql);
                    }

                    
                    $sql = "SELECT name, lat, lng, visits, foto, regiao, descricao FROM places WHERE regiao = 'sul' ORDER BY visits DESC LIMIT 3";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='ranking-item'>
                                    <img src='imagens/" . htmlspecialchars($row["foto"]) . "' alt='" . htmlspecialchars($row["name"]) . "'>
                                    <h3 onclick=\"showModal('" . htmlspecialchars($row["name"]) . "', '" . htmlspecialchars($row["descricao"]) . "')\">" . htmlspecialchars($row["name"]) . "</h3>
                                    <p>Visitas: " . $row["visits"] . "</p>
                                    <button class='visit-btn' onclick=\"visitPlace('" . htmlspecialchars($row["name"]) . "', " . htmlspecialchars($row["lat"]) . ", " . htmlspecialchars($row["lng"]) . ")\">Visitar Novamente</button>
                                  </div>";
                        }
                    } else {
                        echo "<p>Nenhum dado disponível</p>";
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

    <footer>
    
    </footer>

    <script>
    document.getElementById('nav_logo').addEventListener('click', function() {
        window.location.href = 'paginainicio.php';
    });

    document.getElementById('mobile_btn').addEventListener('click', function() {
        var mobileMenu = document.getElementById('mobile_menu');
        mobileMenu.classList.toggle('active');
    });

    document.querySelectorAll('#mobile_menu .dropdown-toggle').forEach(function(dropdownToggle) {
        dropdownToggle.addEventListener('click', function(event) {
            event.preventDefault();
            var dropdown = this.parentNode;
            dropdown.classList.toggle('active');
        });
    });

    function visitPlace(placeName, lat, lng) {
        var visitButton = document.querySelector(`.visit-btn[onclick*="'${placeName}'"]`);
        visitButton.disabled = true;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "updatevisits.php", true);
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
</script>
    
</body>
</html>
