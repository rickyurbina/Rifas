<header class="main-nav">
  <div class="logo-wrapper"><a href="inicio.php"><img class="img-fluid for-light" src="./assets/images/logo/logo.png" alt="" style = "width: 70px; height:70px;"><img class="img-fluid for-dark" style = "width: 70px; height:70px;" src="./assets/images/logo/logo.png" alt=""></a>
    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
  </div>
  <div class="logo-icon-wrapper"><a href="inicio.php"><img class="img-fluid" style = "width: 45px; height:45px;" src="./assets/images/logo/logo.png" alt=""></a></div>
  <nav>
    <div class="main-navbar">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="mainnav">
        <ul class="nav-menu custom-scrollbar">
          <li class="dropdown"><a class="nav-link menu-title link-nav" href=""><span></span></a></li>
          <li><a class="nav-link" href="inicio.php?action=lstBoletosVendidos&idSorteo=<?php echo $idSorteo; ?>"><i class="fas fa-check mr-2"></i><span>Boletos Vendidos</span></a></li>
          <li><a class="nav-link" href="inicio.php?action=lstBoletosPendientes&idSorteo=<?php echo $idSorteo; ?>"><i class="fas fa-dollar-sign mr-2"></i><span>Boletos Apartados</span></a></li>
          <li><a class="nav-link" href="inicio.php?action=ventaBoleto"><i class="fas fa-ticket-alt mr-2"></i><span>Vender boletos</span></a></li>
          <li><a class="nav-link" href="inicio.php?action=uptBoleto"><i class="fa-solid fa-pencil mr-2"></i><span>Editar boleto</span></a></li>
          
          <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="calendar"></i><span>Sorteos</span></a>
            <ul class="nav-submenu menu-content">
              <li><a href="inicio.php?action=agregarSorteo">Crear Nuevo</a></li>

              <li><a href="inicio.php?action=lstSorteos">Lista</a></li>
            </ul>
          </li>
          <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="user"></i><span>Usuarios</span></a>
            <ul class="nav-submenu menu-content">
              <li><a href="inicio.php?action=agregarUsuario">Nuevo</a></li>
              <li><a href="inicio.php?action=lstUsuarios">Lista</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</header>

<i class="fas fa-cloud"></i>