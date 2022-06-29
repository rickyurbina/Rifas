<div id="top-bar" style="background-color: #80D35B;">
  <div class="container">
    <?php
			$controllerSorteo = new SorteosController();
			$controllerSorteo -> ctrCargarMenu();
		?>
    
  </div>
</div>
<header id="header" class="border-full-header header-size-custom" data-sticky-shrink="false" data-sticky-offset="52">
  <div id="header-wrap">
    <div class="container">
      <div class="header-row justify-content-lg-between">
        <div id="logo" class="order-lg-2 col-auto px-0 mr-lg-0">
          <a href="#" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="images/logoSmall.png" alt="Logo"></a>
          <a href="#" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="images/logoRifas.png" alt="Logo"></a>
        </div>
        <div class="header-misc order-lg-3 col-auto col-lg-5 px-0 justify-content-end">
          <a href="https://www.facebook.com/RIFAS-Los-Primos-111440864368586" style="background-color: #3B5998; width: 3em; height: 3em; border-radius: 5px; text-align: center">
            <i class="icon-facebook" style="color: white; line-height: 3em; font-size: 1em"></i>
          </a>
        </div>

        <div id="primary-menu-trigger">
          <svg class="svg-trigger" viewBox="0 0 100 100">
            <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
            <path d="m 30,50 h 40"></path>
            <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
          </svg>
        </div>

        <nav class="primary-menu order-lg-1 col-lg-5 px-0">

          <!-- Menu Left -->
          <ul class="menu-container">
            <li class="current menu-item"><a class="menu-link" href="index.php">
                <div>Inicio</div>
              </a></li>
            <li class="menu-item"><a class="menu-link" href="boletos.php">
                <div>Comprar</div>
              </a>
            </li>
            <li class="menu-item"><a class="menu-link" href="index.php#acerca">
                <div>Nosotros</div>
              </a></li>
              <li class="menu-item"><a class="menu-link" href="verificador.php">
                <div>Verifica tu boleto</div>
              </a></li>
          </ul>

        </nav><!-- #primary-menu end -->

      </div>
    </div>
  </div>
  <div class="header-wrap-clone"></div>
</header>