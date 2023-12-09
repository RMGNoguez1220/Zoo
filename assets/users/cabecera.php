<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- CSS File --> 
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/headerNav.css">
  <link rel="stylesheet" href="../css/jquery-confirm.css">

   <!-- Logo -->
  <link href="../img/crash-bandicoot-disguised-as-a-zoo-guide.png" rel="icon">

  <!-- Libreria de iconos -->
  <!-- https://boxicons.com/ -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'rel='stylesheet'>

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <title>ZooBrothers</title>

  <?php 
    include "../class/classBD.php";
    $consultaFoto = "SELECT foto FROM usuario WHERE IdUsuario = " . $_SESSION['Id'];
    $objBD = new BaseDate();
    $result = $objBD -> getTupla($consultaFoto);
    $fotoData = $result -> foto;
  ?>
</head>
<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <i class='bx bx-menu' style="font-size: 36px; color: #0e0d0d;"></i> 
    <div class="d-flex align-items-center justify-content-between">
        <div class="center"><span class = "Titulo">ZooBrothers</span></div>
    </div><!-- FIN Logo -->
  </header><!-- End Header -->

  <!-- ======= Nav ======= -->
  <div class="sidebar close">
    <ul class="nav-links">

      <!-- ======= link Menu ======= -->
      <li>
        <a href="home.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Inico</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Inico</a></li>
        </ul>
      </li>

      <!-- ======= Link Animales ======= -->
      <li>
        <a href="animales.php">
          <i class='bx bxs-dog' ></i>
          <span class="link_name">Animales</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Animales</a></li>
        </ul>
      </li>
      
      <!-- ======= Link Recorridos ======= -->
      <li>
        <a href="#">
          <i class='bx bx-bus'></i>
          <span class="link_name">Recorridos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Recorridos</a></li>
        </ul>
      </li>

      <!-- ======= Link Habitats ======= -->
      <li>
        <a href="#">
          <i class='bx bx-leaf'></i>
          <span class="link_name">Habitats</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Habitats</a></li>
        </ul>
      </li>

      <!-- ======= Perfil ======= -->
      <li>
        <a href="javascript:usuario('Perfil')">
          <i class='bx bx-id-card'></i>
          <span class="link_name">Perfil</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="javascript:usuario('Perfil')"><?php echo $_SESSION['Nombre']; ?> </a></li>
        </ul>
      </li>

      <!-- ======= Cerrar Sesion ======= -->
      <li>
        <a href="login.php">
          <i class='bx bx-exit'></i>
          <span class="link_name">Cerrar Sesión</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="login.php">Cerrar Sesión</a></li>
        </ul>
      </li>
      <?php echo '<img src="data:image/jpg;base64,' . base64_encode($fotoData) . '" alt="foto" class="miniPerfil" >';?>
    </ul>
  </div>

  <!-- ======= Script ======= -->
  <script src="../js/main.js"></script>
  <script src = "../js/jquery-3.7.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/jquery-confirm.js"></script>
  <script src="../controlador/usuario.js"></script>
  <script src="../js/canvasjs.min.js"></script>
