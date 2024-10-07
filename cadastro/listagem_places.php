<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="World Experience Virtual é um site de experiências de realidade virtual. Explore o mundo no conforto de sua casa.">
    <meta name="keywords" content="realidade virtual, viagens, exploração, experiências virtuais">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="agr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlrPK4yuUg9aA7I5v_LMQtU79dFP8_ywg&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Locais Mais Visitados - Sul</title>
    


</head>
<body>
<header>
    <nav id="navbar">
        <div id="nav_logo">
        <i class="fa-solid fa-earth-americas">WEV</i>
        </div>
        <ul id="nav_list">
            <li class="nav-item"><a href="cadastro123.php">Cadastro</a></li>
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
            <li class="nav-item"><a href="paginainicio.php#contact">Contato</a></li>
        </ul>
        <button id="mobile_btn">&#9776;</button> <!-- Botão de menu -->
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
            <h2> Regiao <?php echo $_GET['place']; ?></h2>
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

                    
                    $sql = "SELECT name, lat, lng, visits, foto, regiao, descricao FROM places 
                    WHERE regiao = '" . $_GET['place'] ."' ORDER BY visits DESC LIMIT 3";
                    //echo $sql;
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

document.getElementById('nav_logo').addEventListener('click', function() {
      window.location.href = 'paginainicio.php'; /* Redireciona para a página desejada */
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

        document.getElementById('explore-btn').addEventListener('click', function() {
    document.getElementById('sobre').scrollIntoView({ behavior: 'smooth' });
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

    window.location.href = `inicio.php?lat=${lat}&lng=${lng}`;
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
