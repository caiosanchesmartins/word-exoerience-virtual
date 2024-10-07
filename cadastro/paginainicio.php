<?php
session_start();
include 'include/conexao.php';

// Inicializa a variável $is_logged_in
$is_logged_in = isset($_SESSION['user_id']);

// Se o usuário não estiver logado, redirecione ou exiba uma mensagem

// Verifique se o usuário está logado
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Visitante"; // Nome padrão para visitantes não logados
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Tags Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="World Experience Virtual é um site de experiências de realidade virtual. Explore o mundo no conforto de sua casa.">
    <meta name="keywords" content="realidade virtual, viagens, exploração, experiências virtuais">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>World Experience Virtual</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="inicioagr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlrPK4yuUg9aA7I5v_LMQtU79dFP8_ywg&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    
</head>

<body>
<header>
    <nav id="navbar">
        <div id="nav_logo">
        <i class="fa-solid fa-earth-americas">WEV</i>
        </div>
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
            
</ul>
            <div class="profile-container">
    <button id="profile-button" class="profile-button" onclick="toggleProfileMenu()">
    <i class="bi bi-person-circle"></i>
    </button>
    <?php
// Verifica se a sessão já foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não estiver ativa
}

// Conexão ao banco de dados
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "wev";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    exit;
}

// Verifica se o usuário está logado
$is_logged_in = false;
$row = null;

if (isset($_SESSION['user_id'])) {
    $is_logged_in = true;
    $userId = $_SESSION['user_id'];

    // Consulta ao banco de dados
    $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div id="profile-menu" class="profile-menu" style="display: none;">
    <?php if ($is_logged_in && $row): ?>
        <p class="username"><?php echo htmlspecialchars($row["nome"]); ?></p>
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-button">Desconectar</button>
        </form>
    <?php else: ?>
        <p>Você não está logado.</p>
        <a href="cadastro123.php" class="cadastro-button">Login</a>
    <?php endif; ?>
</div>


</div>

        </ul>
        <button id="mobile_btn">&#9776;</button> <!-- Botão de menu -->
    </nav>
    <div id="mobile_menu">
        <ul id="mobile_nav_list">
            <li><a href="cadastro123.php">Cadastro</a></li>
            <li class="dropdown">
    <a href="#" class="dropdown-toggle">Regiões</a>
    <ul class="dropdown-menu">
        <li><a href="listagem_places.php?place=Sudeste">Sudeste</a></li>
        <li><a href="listagem_places.php?place=Nordeste">Nordeste</a></li>
        <li><a href="listagem_places.php?place=Norte">Norte</a></li>
        <li><a href="listagem_places.php?place=Centro-Oeste">Centro-Oeste</a></li>
        <li><a href="listagem_places.php?place=Sul">Sul</a></li>
    </ul>
</li>

            
            
      
    </div>
</header>

    <section id="inicio" class="hero">
        <video autoplay muted loop id="bg-video">
            <source src="video.mp4" type="video/mp4">
            <source src="video.webm" type="video/webm">
            Seu navegador não suporta o elemento de vídeo.
        </video>
        <div class="hero-content">
            <h1>Explore o Mundo em Realidade Virtual</h1>
            <p>Experimente as maravilhas do mundo no conforto de sua casa.</p>
            <button id="explore-btn" onclick="exploreRandomLocation()">Explore Agora</button>


        </div>
    </section>
    <section id="search">
    <div class="container">
        <h2>Buscar Local</h2>
        <div class="search-bar">
            <input type="text" id="pac-input" placeholder="Digite o nome do local...">
            <button id="search-button">Pesquisar</button>
        </div>
    </div>
</section>

    <section id="ranking">
        
        <div class="container">
            <h2>locais mais visitados</h2>
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

                    
                    $sql = "SELECT name, lat, lng, visits, foto, regiao, descricao FROM places GROUP BY name ORDER BY visits DESC LIMIT 3";
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

    <section id="depoimentos">
    <div class="container">
        <h2>comentarios de outros usuarios</h2>
        <div class="testimonial">
            
            <?php
                // Iniciar a sessão se não estiver ativa
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // Conexão ao banco de dados
                $conn = new mysqli("localhost", "root", "", "wev");

                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                // Verifica se o usuário está logado e obtém o ID do usuário
                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

                // Consulta para obter o nome do usuário logado
                $nome_usuario = null;
                if ($user_id) {
                    $sql_usuario = "SELECT nome FROM usuarios WHERE id = ?";
                    $stmt = $conn->prepare($sql_usuario);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result_usuario = $stmt->get_result();
                    if ($result_usuario->num_rows > 0) {
                        $row_usuario = $result_usuario->fetch_assoc();
                        $nome_usuario = $row_usuario['nome'];
                    }
                    $stmt->close();
                }

                // Consulta aos depoimentos
                $sql_depoimentos = "SELECT comentario, DATE_FORMAT(data_postagem, '%d/%m/%Y') as data FROM depoimentos ORDER BY data_postagem DESC LIMIT 5";
                $result_depoimentos = $conn->query($sql_depoimentos);

                if ($result_depoimentos->num_rows > 0) {
                    while ($row = $result_depoimentos->fetch_assoc()) {
                        // Exibe o depoimento
                        echo "<div class='testimonial'>
                                <p>\"" . htmlspecialchars($row['comentario']) . "\"</p>
                                <p>- " . htmlspecialchars($nome_usuario) . " em " . $row['data'] . "</p>
                              </div>";
                    }
                } else {
                    echo "<p>Não há depoimentos disponíveis.</p>";
                }

                $conn->close();
            ?>
        </div>

        <div class="form-container">
            <h3>deixe seu comentario</h3>
            <form action="enviar_depoimento.php" method="post">
                <input type="hidden" name="nome" value="<?php echo htmlspecialchars($nome_usuario); ?>">
                <div class="form-group">
                    <label for="comentario">Seu Comentário</label>
                    <textarea id="comentario" name="comentario" required></textarea>
                </div>
                <button type="submit">enviar comentario</button>
            </form>
            <div id="successMessage" class="success-message" style="display: none;">
                Depoimento enviado com sucesso! Agradecemos por nos ajudar a melhorar o nosso site!
            </div>
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

$(document).ready(function() {
    console.log("Document ready"); // Para verificar se o document ready está sendo chamado

    $('#contact').submit(function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        console.log("Formulário enviado"); // Para depuração

        var formData = new FormData(this); // Obtém os dados do formulário

        // Cria uma solicitação AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'app.py', true); // Mude para o caminho do seu script Python
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("Mensagem enviada com sucesso!");
                $('#contact')[0].reset(); // Limpa o formulário
            } else {
                alert("Erro ao enviar a mensagem: " + xhr.status);
            }
        };
        xhr.onerror = function() {
            alert("Erro de rede. Tente novamente.");
        };
        xhr.send(formData); // Envia os dados do formulário
    });
});



    $(document).ready(function(){
    $('.dropdown-toggle').click(function(e){
        e.preventDefault(); // Previne o comportamento padrão do link
        $('.dropdown-menu').toggleClass('show'); // Adiciona ou remove a classe "show"
    });

    // Adicionando hover para mostrar e esconder
    $('.dropdown').hover(
        function() {
            $(this).find('.dropdown-menu').addClass('show');
        }, 
        function() {
            $(this).find('.dropdown-menu').removeClass('show');
        }
    );
});
$('.dropdown').hover(function() {
    $(this).find('.dropdown-menu').addClass('show');
}, function() {
    $(this).find('.dropdown-menu').removeClass('show');
});



    function toggleProfileMenu() {
    const dropdown = document.getElementById("profile-menu");

    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Para fechar o menu quando clicar fora dele
window.onclick = function(event) {
    if (!event.target.matches('#profile-button')) {
        const dropdowns = document.getElementsByClassName("profile-menu");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
};

    // Função para rolar suavemente até a seção "sobre"
    document.getElementById('explore-btn').addEventListener('click', function() {
        document.getElementById('sobre').scrollIntoView({ behavior: 'smooth' });
    });

    // Função para registrar a visita a um local e redirecionar
    function visitPlace(placeName, lat, lng) {
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
            }
        };
        xhr.send("places_name=" + encodeURIComponent(placeName));

        window.location.href = `inicio.php?lat=${lat}&lng=${lng}`;
    }

    // Função para exibir o modal
    function showModal(placeName, description) {
        document.getElementById('modalTitle').innerText = placeName;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('placeModal').style.display = 'block'; // Exibe o modal
    }

    // Função para fechar o modal
    function closeModal() {
        document.getElementById('placeModal').style.display = 'none'; // Oculta o modal
    }

    // Fecha o modal quando clicar fora dele
    window.onclick = function(event) {
        if (event.target == document.getElementById('placeModal')) {
            closeModal();
        }
    }

    // Inicializa o autocomplete do Google Maps
    function initAutocomplete() {
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);

        document.getElementById('search-button').addEventListener('click', function() {
            var places = searchBox.getPlaces();

            if (!places || places.length == 0) {
                console.log("No places found");
                return;
            }

            var place = places[0];

            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }

            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            window.location.href = `inicio.php?lat=${lat}&lng=${lng}`;
        });

        // Adiciona um listener ao campo de pesquisa para funcionar quando pressionar Enter
        input.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Impede o envio do formulário
                var places = searchBox.getPlaces();

                if (!places || places.length == 0) {
                    console.log("No places found");
                    return;
                }

                var place = places[0];

                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
                window.location.href = `inicio.php?lat=${lat}&lng=${lng}`;
            }
        });
    }

    // Espera a API do Google Maps carregar antes de chamar initAutocomplete
    window.addEventListener('load', function() {
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            initAutocomplete();
        }
    });

    // Alternar visibilidade do menu mobile
document.getElementById('mobile_btn').addEventListener('click', function() {
    var mobileMenu = document.getElementById('mobile_menu');
    mobileMenu.classList.toggle('active');
});

// Alternar visibilidade do dropdown no mobile
document.querySelectorAll('#mobile_menu .dropdown-toggle').forEach(function(dropdownToggle) {
    dropdownToggle.addEventListener('click', function(event) {
        event.preventDefault();
        var dropdown = this.parentNode;
        dropdown.classList.toggle('active');
    });
});

document.querySelector('form[action="enviar_depoimento.php"]').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var formData = new FormData(this); // Obtém os dados do formulário

    // Cria uma solicitação AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'enviar_depoimento.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Exibe a mensagem de sucesso
            var successMessage = document.getElementById("successMessage");
            successMessage.style.display = "block";
            
            // Opcional: esconde a mensagem após 5 segundos
            setTimeout(function() {
                successMessage.style.display = "none";
            }, 5000);

            // Limpa o formulário
            document.querySelector('form[action="enviar_depoimento.php"]').reset();
        } else {
            console.error("Erro ao enviar o depoimento: " + xhr.status);
        }
    };
    xhr.send(formData); // Envia os dados do formulário
});

function exploreRandomLocation() {
    const locations = [
        { lat: 40.6892, lng: -74.0445 }, // Estátua da Liberdade, EUA
        { lat: 48.8584, lng: 2.2941 },   // Torre Eiffel, França
        { lat: 27.1751, lng: 78.0421 },   // Taj Mahal, Índia
        { lat: 37.7749, lng: -122.4194 }, // São Francisco, EUA (Golden Gate Park)
        { lat: 51.5014, lng: -0.1419 },   // Big Ben, Londres, Reino Unido
        { lat: -33.8568, lng: 151.2153 }, // Sydney Opera House, Austrália
        { lat: 35.6586, lng: 139.7454 },   // Tóquio Tower, Japão
        { lat: 55.7558, lng: 37.6173 },   // Praça Vermelha, Moscovo, Rússia
        { lat: 39.9042, lng: 116.4074 },   // Cidade Proibida, Pequim, China
        { lat: 34.0522, lng: -118.2437 }, // Los Angeles, EUA (Griffith Park)
        { lat: -22.9068, lng: -43.1729 }, // Rio de Janeiro, Brasil (Cristo Redentor)
        { lat: 52.5200, lng: 13.4050 },   // Berlim, Alemanha (Portão de Brandemburgo)
        { lat: 37.3382, lng: -121.8863 }, // San Jose, EUA (Parque Estadual de Alum Rock)
        { lat: 19.4326, lng: -99.1332 },  // Cidade do México (Chapultepec)
        { lat: 1.3521, lng: 103.8198 },   // Cingapura (Marina Bay Sands)
        { lat: 39.7392, lng: -104.9903 }, // Denver, EUA (Parque Nacional das Montanhas Rochosas)
        { lat: -37.8136, lng: 144.9631 }, // Melbourne, Austrália (Jardim Botânico Real)
        { lat: 60.1695, lng: 24.9354 },   // Helsinque, Finlândia (Catedral de Helsinque)
        { lat: 36.7783, lng: -119.4179 }, // Califórnia, EUA (Parque Nacional de Yosemite)
        { lat: 55.6761, lng: 12.5683 },   // Copenhague, Dinamarca (Jardim de Tivoli)
        { lat: -13.1631, lng: -72.5449 }  // Machu Picchu, Peru
    ];

    // Escolher uma localização aleatória
    const randomLocation = locations[Math.floor(Math.random() * locations.length)];

    // Redirecionar para a página de início com as coordenadas
    window.location.href = `inicio.php?lat=${randomLocation.lat}&lng=${randomLocation.lng}`;

   


}




</script>
</body>
</html>
