<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>FKart- Cadastrar no Sistema</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="<?php echo BASE_URL; ?>assets/plugins/fontawesome/js/all.js"></script>

    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css" />

    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript">
        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>

</head>

<body>

    <div class="container-register">
        <div class="logo--field">
            <img src="<?php echo BASE_URL; ?>assets/images/fkart-logo.png" class="logo" alt="Logo Fkart">
        </div>
        <form id="form-register" method="POST">
            <?php if (isset($success) && !empty($success)) : ?>
                <div class="success">
                    <?php echo $success; ?>
                    <a class="link-login" href="<?php echo BASE_URL; ?>login">Acessar o sistema</a>
                </div>
            <?php endif; ?>
            <?php if (isset($error) && !empty($error)) : ?>
                <div class="warning">
                    <?php echo $error; ?>
                    <a class="link-login" href="<?php echo BASE_URL; ?>login">Acessar o sistema</a>
                </div>
            <?php endif; ?>
            <div class="table-line">
                <label for="fullname_pilot">Nome do Piloto</label>
                <input type="text" name="fullname_pilot" id="fullname_pilot" required autofocus>
            </div>
            <div class="table-line">
                <label for="nickname_pilot">Nome (Tabela de Pontuação)</label>
                <input type="text" name="nickname_pilot" id="nickname_pilot" required>
            </div>
            <div class="table-line">
                <label for="cpf">CPF do Piloto</label>
                <input type="text" name="cpf" id="cpf" required>
            </div>
            <div class="table-line">
                <label for="birth_date">Data de Nascimento</label>
                <input type="text" name="birth_date" id="birth_date" required>
            </div>
            <div class="table-line">
                <label for="cellphone">Celular</label>
                <input type="text" name="cellphone" id="cellphone" required>
            </div>
            <div class="table-line">
                <button type="submit">Enviar Registro</button>
            </div>
        </form>
        <div class="table-line"><a href="<?php echo BASE_URL; ?>login">Deseja fazer login?</a></div>
        <div class="logo--field">
            <img src="<?php echo BASE_URL; ?>assets/images/force-kart.png" class="logo-sponsor" alt="Logo Force Kart">
            <img src="<?php echo BASE_URL; ?>assets/images/acka.png" class="logo-sponsor" alt="Logo ACKA">
        </div>
    </div>

    <!-- SCRIPTS JS -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/general_mask.js"></script>

</body>

</html>