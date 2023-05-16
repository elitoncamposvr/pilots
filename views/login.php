<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>FKart- Entrar no Sistema</title>

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
  <div class="container">
    <div class="logo--field">
      <img src="<?php echo BASE_URL; ?>assets/images/fkart-logo.png" class="logo" alt="Logo Fkart">
    </div>
    <form id="login" method="POST">
      <h1>Entre com seus dados</h1>
      <?php if (isset($error) && !empty($error)) : ?>
        <div class="warning">
          <?php echo $error; ?>
          <a href="<?php echo BASE_URL; ?>login/register" class="link-login">Deseja registrar-se?</a>
        </div>
      <?php endif; ?>
      <input type="text" name="cpf" class="cpf" id="cpf" placeholder="CPF" autocomplete="off" required autofocus>
      <input type="date" name="birth_date" class="birth_date" id="birth_date" placeholder="Data de Nascimento" required>
      <p><button type="submit">Entrar</button></p><br>
      <p><a href="<?php echo BASE_URL; ?>login/register">Ainda não tem cadastro? Registre-se!</a></p><br>
    </form>
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