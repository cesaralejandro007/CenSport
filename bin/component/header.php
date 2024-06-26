<?php
use config\componentes\configSistema as configSistema;
?>        
<nav style="background:#991B27;" class="sb-topnav navbar navbar-expand navbar-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="?pagina=<?php configSistema::_PRINCIPAL_();?>">CenSport</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  <!-- Navbar-->
  <div class="text-white"><?php echo $_SESSION['usuario']['nombres'] . " ". $_SESSION['usuario']['apellidos'] ?></div>

  <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0 d-none d-md-inline-block">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="?pagina=<?php configSistema::_PERFIL_();?>">Configuración</a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" href="?pagina=<?php configSistema::_MLOGIN_();?>">Salir</a></li>
      </ul>
    </li>
  </ul>
</nav>