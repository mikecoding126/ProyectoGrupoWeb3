
<?php
  
  require '../../includes/funciones.php';
  incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión para Empleados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/PASTELERIA/build/css/custom-style.css"> <!-- Asegúrate de que esta ruta es correcta -->
  <style>
      body {
          background-color: #faf3e0;
          font-family: 'Arial', sans-serif;
      }
      .login-container {
          max-width: 400px;
          margin: 50px auto;
          padding: 40px;
          background: white;
          border-radius: 15px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          text-align: center;
      }
      .login-header {
          text-align: center;
          margin-bottom: 30px;
      }
      .login-header .logo {
          font-size: 50px;
          color: #d35400;
          margin-bottom: 20px;
      }
      .form-control {
          border-radius: 20px;
          padding: 15px;
          margin-bottom: 15px;
          border: 1px solid #ddd;
      }
      .login-button {
          background-color: #d35400;
          border-color: #d35400;
          color: white;
          border-radius: 20px;
          padding: 10px;
          font-size: 16px;
      }
      .login-button:hover {
          background-color: #e67e22;
          border-color: #e67e22;
      }
      .back-link {
          display: flex;
          align-items: center;
          justify-content: center;
          text-decoration: none;
          color: #d35400;
          margin-top: 15px;
      }
      .back-link i {
          margin-right: 5px;
      }
      .forgot-password {
          color: #999;
          font-size: 14px;
      }
      .forgot-password:hover {
          color: #d35400;
      }
      .footer-text {
          color: #999;
          font-size: 12px;
          margin-top: 20px;
      }
  </style>
</head>
<body>
<div class="container">
  <div class="login-container">
      <div class="login-header">
          <span class="logo">🍰 Registrarse</span>
      </div>
  
  <form action="../controlador/nuevo.php" method="post" class = "formulario">
  
      <fieldset>
          <div>
              <input type="email" class="form-control" name="ema" placeholder="Email" required id="ema">
          </div>
          <div>
              <input type="password" class="form-control" name="pas1" placeholder="Password" required id="pas1">
          </div>
          <div>
              <input type="password" class="form-control" name="pas2" placeholder="Confirmar Password" required id="pas2">
          </div>
          <div>
              <button type="submit" class="btn login-button" value="Registrar Usuario" name="registrar" id="">Registrarse</button>
          
           
          </div>
          <a href="../../login.php" class="boton boton-verde">Volver</a>
  </form>
</main>
<p class="footer-text">© 2024 PasteleriaEsencia.com - Todos los derechos reservados</p>
  </div>
</div>

      


<?php incluirTemplate('footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>