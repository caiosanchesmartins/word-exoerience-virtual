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
<meta name="googlevr" content="nosdk">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="drop.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>World Experience Virtual</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlrPK4yuUg9aA7I5v_LMQtU79dFP8_ywg&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="street.js"></script>  
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
            <li class="nav-item"><a href="#contact">Contato</a></li>
</ul>
            <div class="profile-container">
    <button id="profile-button" class="profile-button" onclick="toggleProfileMenu()">
    <i class="bi bi-person-circle"></i>
    </button>
    <div id="profile-menu" class="profile-menu" style="display: none;">
        <?php if ($is_logged_in): ?>
            <p class="username"><?php echo htmlspecialchars($username); ?></p>
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

            <li><a href="#contact">Contato</a></li>
            
        </ul>
    </div>
</header>

  <div id="street-view">
    <button id="toggle-vr">Ligar Modo VR</button>
  </div>

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
  </script>
  
</body>
</html>
