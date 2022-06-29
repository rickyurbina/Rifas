<?php
  class SorteosController {

    public function ctrObtenerSorteoActivo() {
      $respuesta = ModelSorteos::mdlObtenerSorteoActivo();

      return $respuesta;
    }
    
    public function ctrCargarMenu(){
        $respuesta = ModelSorteos::mdlBuscarSorteoActual();
        $fecha = strtotime($respuesta[0]["fecha"]);
        $dia = date("d",$fecha);
        $mes = date("m",$fecha);
        $ano = date("Y",$fecha);
        echo'
            <div class="d-flex align-items-center justify-content-center flex-column flex-lg-row py-3 py-lg-0" style="color: rgb(255, 255, 255);">
                Compra tu oportunidad hoy, solo faltan: <div class="countdown countdown-inline mt-3 mt-lg-0 ml-lg-4 mb-0" data-year="'.$ano.'" data-month="'.$mes.'" data-day="'.$dia.'"></div>
            </div>
        ';
    }

    public function ctrBuscaFotoSorteo() {
        $respuesta = ModelSorteos::mdlBuscaFotoSorteo();
        //$respuesta = $respuesta[0];
        $fotos = json_decode($respuesta["fotos"],true);
        return $fotos[0];
    }

    public function ctrBuscarSorteoActivo() {
        $respuesta = ModelSorteos::mdlBuscarSorteoActual();
        $respuesta = $respuesta[0];
        $fotos = json_decode($respuesta["fotos"],true);
        $caracteristicas = explode("\n",$respuesta["descripcion"]);
        $adicionales = explode("\n",$respuesta["adicionales"]);
        echo'
        <!-- Slide 1 -->
        <section id="slider" class="slider-element swiper_wrapper min-vh-100" data-effect="fade">
            <div class="slider-inner">

                <div class="swiper-container swiper-parent">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide dark" style=" background: linear-gradient(to right, rgba(0,0,0,0), rgba(0,0,0, 0.1)), url(./backend/views/'.$fotos[0].') no-repeat center right / auto 125%; background-size:100% auto;">
                            <div class="container" style="z-index: 2;">
                                <div class="row h-100 align-items-center py-5">
                                    <div class="col-md-6">
                                        <div class="heading-block border-bottom-0 bottommargin-sm">
                                            <h5 class="text-uppercase ls4 font-weight-light mb-2 text-white-50" data-animate="fadeInUp" data-delay="100">Próximo Sorteo</h5>
                                            <h2 class="font-weight-bold nott ls0" data-animate="fadeInUp" data-delay="150" style="font-size: 46px;">'.$respuesta["titulo"].'<br>'.$respuesta["subtitulo"].'</h2>
                                        </div>
                                        <!-- <p class="mb-5 font-weight-normal lead" data-animate="fadeInUp" data-delay="400" style="line-height: 1.6;">Motor 460 automática 4x4</p> -->
                                        <a href="boletos.php" data-scrollto="#section-about" data-offset="70"  data-animate="fadeInUp" data-delay="200" class="btn rounded bg-white color text-uppercase font-weight-semibold ls1 py-3 px-4">Comprar Boleto <i class="icon-line-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="swiper-slide dark" style="background: linear-gradient(to right, rgba(0,0,0,0), rgba(0,0,0, 0.1)), url(./backend/views/'.$fotos[1].') no-repeat center right / auto 125%; background-size:100% auto;">
                            <div class="container" style="z-index: 2;">
                                <div class="row h-100 align-items-center py-5">
                                    <div class="col-md-6">
                                        <div class="heading-block border-bottom-0 bottommargin-sm">
                                            <h5 class="text-uppercase ls4 font-weight-light mb-2 text-white-50" data-animate="fadeInUp" data-delay="100">Proximo Sorteo</h5>
                                            <h2 class="font-weight-bold nott ls0" data-animate="fadeInUp" data-delay="200" style="font-size: 42px;">'.$respuesta["titulo"].'<br>'.$respuesta["subtitulo"].'</h2>
                                        </div>
                                        <!-- <p class="mb-5 font-weight-normal lead" data-animate="fadeInUp" data-delay="400" style="line-height: 1.6;">Motor 460 automática 4x4</p> -->
                                        <a href="boletos.php" data-scrollto="#section-about" data-offset="70"  data-animate="fadeInUp" data-delay="600" class="btn rounded bg-white color text-uppercase font-weight-semibold ls1 py-3 px-4">Comprar Boleto<i class="icon-line-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
                    <div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
                    <div class="slide-number"><div class="slide-number-current"></div><span>/</span><div class="slide-number-total"></div></div>
                </div>

            </div>
        </section>
        <section id="content" class="bg-white">
			<div class="content-wrap pt-0" style="overflow: visible">

				<div class="position-relative">
					<div class="container">
						<div class="row py-0 py-lg-5">
							<div class="col-lg-5 py-5">
								<div class="heading-block border-bottom-0 bottommargin-sm">
									<div class="fancy-title title-border mb-3"><h5 class="font-weight-normal color font-body">Sorteo</h5></div>
									<h3 class="font-weight-bold nott" style="font-size: 42px; letter-spacing: -1px;">'.$respuesta["titulo"].' '.$respuesta["subtitulo"].' <span></span></h3>
								</div>
								<!-- <p class="mb-5">Monotonectally pursue intuitive catalysts for change for extensible materials intrinsicly fabricate.</p> -->';

                                foreach ($caracteristicas as $row => $caracteristica) {
                                    echo'
                                    <div class="feature-box fbox-plain bottommargin-sm">
                                        <div class="fbox-icon">
                                            <i class="icon-line-circle-check text-info"></i>
                                        </div>
                                        <div class="fbox-content">
                                            <h3 class="font-weight-normal nott">'.$caracteristica.'</h3>
                                            <!-- <p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p> -->
                                        </div>
                                    </div>
                                    ';
                                }

                                echo '
							</div>
						</div>
					</div>
					<div class="section-img" style="background: url(./backend/views/'.$fotos[2].') no-repeat center center / cover">
						<img class="section-img-sm" src="./backend/views/'.$fotos[3].'" alt="Section Img">
					</div>
				</div>

				<div class="section section-price bg-transparent">
					<div class="container">
						<div class="d-flex justify-content-between align-items-center bottommargin-lg">
							<div class="heading-block border-bottom-0 mb-0" style="max-width: 700px">
								<div class="fancy-title title-border mb-3"><h5 class="font-weight-normal color font-body text-uppercase ls1"></h5></div>
								<h2 class="font-weight-bold mb-2 nott" style="font-size: 42px; letter-spacing: -1px"><span>Compra</span> ya tu boleto.</h2>
								<p class="lead mb-0"></p>
							</div>
							<!-- <img src="images/yoga-img.svg" alt="Yoga Image" class="d-none d-sm-flex" width="300"> -->
						</div>

						<div class="row">
							<div class="col-md-4 mb-5 mt-5">
                                <div class="card pricing border-0 shadow text-center">
                                    <div class="card-body rounded pt-5 pb-1">
                                        <h1 style="color: #80D35B; font-size: 3em; margin-bottom: 0px; line-height: normal;">2do</h1>
                                        <h2 style="color: #80D35B; font-size: 2em; line-height: normal;">Pre-sorteo</h2>
                                        <h3>'.$respuesta["segundoLugar"].'</h3>
                                    </div>
                                </div>                
							</div> 
							<div class="col-md-4 mb-5">
								<div class="card pricing border-0 shadow text-center">
									<div class="card-body rounded pb-0">
                                        <h1 style="color: #80D35B; font-size: 4em; margin-bottom: 0px; line-height: normal;">1er</h1>
                                        <h2 style="color: #80D35B; font-size: 3em; line-height: normal;">Premio</h2>
										<h3>'.$respuesta["titulo"].'</h3>
										<ul class="list-unstyled">';
                                            
                                            foreach ($adicionales as $row => $adicional) {
                                                echo'
                                                    <h3 style="line-height: normal; margin-bottom: 0px;"><li class="text-black-50 my-1"> <b> '.$adicional.'</b> </li></h3>
                                                ';  
                                            }
											echo'
										</ul>
										<h3 class="mb-3 h2 color">$ '.$respuesta["costoBoleto"].'</h3>
										<a href="boletos.php" class="btn rounded bg-color text-white text-uppercase font-weight-semibold ls1 py-2 px-4">Comprar Boleto</a>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-5 mt-5">
                <div class="card pricing border-0 shadow text-center">
                  <div class="card-body rounded pt-5 pb-1">
                  <h1 style="color: #80D35B; font-size: 3em; margin-bottom: 0px; line-height: normal;">3er</h1>
                  <h2 style="color: #80D35B; font-size: 2em; line-height: normal;">Pre-sorteo</h2>
                  <h3>'.$respuesta["tercerLugar"].'</h3>
                  </div>
                </div>
                </div>
              </div>
					</div>
				</div>
        ';
    }
  }
