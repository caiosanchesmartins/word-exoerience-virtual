<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="cadastro.css">
    <title>WEV</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="registro.php" method="post">
                <h1>Criar Conta</h1>
                <div class="social-icons">
                    <a href="https://accounts.google.com/o/oauth2/v2/auth?redirect_uri=YOUR_REDIRECT_URI&response_type=token&client_id=YOUR_CLIENT_ID&scope=email%20profile" class="icon" target="_blank">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="https://www.facebook.com/v15.0/dialog/oauth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&scope=email,public_profile" class="icon" target="_blank">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://github.com/login/oauth/authorize?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&scope=user:email" class="icon" target="_blank">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&scope=r_liteprofile%20r_emailaddress" class="icon" target="_blank">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
                <span>ou use seu e-mail para registro</span>
                <input type="text" name="username" placeholder="Nome" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="login.php" method="post">
                <h1>Entrar</h1>
                <div class="social-icons">
                    <a href="https://accounts.google.com/o/oauth2/v2/auth?redirect_uri=YOUR_REDIRECT_URI&response_type=token&client_id=YOUR_CLIENT_ID&scope=email%20profile" class="icon" target="_blank">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="https://www.facebook.com/v15.0/dialog/oauth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&scope=email,public_profile" class="icon" target="_blank">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://github.com/login/oauth/authorize?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&scope=user:email" class="icon" target="_blank">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&scope=r_liteprofile%20r_emailaddress" class="icon" target="_blank">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
                <span>ou use seu e-mail e senha</span>
                <input type="email" name="email" placeholder="E-mail">
                <input type="password" name="password" placeholder="Senha">
                <a href="#">Esqueceu sua senha?</a>
                <button type="submit">Entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem-vindo de volta!</h1>
                    <p>Digite seus dados pessoais para usar todas as funcionalidades do site</p>
                    <button class="hidden" id="login">Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Olá!</h1>
                    <p>Cadastre-se com seus dados pessoais para usar todas as funcionalidades do site</p>
                    <button class="hidden" id="register">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['msg']) && $_GET['msg'] === 'cadastro_sucesso') {
        echo "<p style='color: green;'>Cadastro efetuado com sucesso!</p>";
    }
    ?>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>
