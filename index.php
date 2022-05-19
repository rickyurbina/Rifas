<!DOCTYPE html>
<html dir="ltr">
<?php 

include "./components/head.php";

require_once "./controllers/controllerSorteos.php";
require "./models/conexion.php";
require_once "./models/modelSorteos.php";
?>

<body class="stretched sticky-footer">
	<div id="wrapper" class="clearfix">

    <?php
      include "./components/menu.php";
    ?>
    
		
		<?php
			$controllerSorteo = new SorteosController();
			$controllerSorteo -> ctrBuscarSorteoActivo();
		?>
		
		<!-- <p><img style="height: 14px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/BBVA_2019.svg/1920px-BBVA_2019.svg.png" alt="">hola</p> -->

		<!-- Content
		============================================= -->
		


				<!-- Acerca de -->
				<p id="acerca"></p>

				<div class="section section-schedule" style="background: linear-gradient(to top, rgba(126, 150, 128, 0) 0%, rgba(151, 247, 159, 0.8) 100%) left top; padding: 100px 0; background-size: 100% 100%">
					<div class="container">
						
						<div class="center text-title"><br><br><br><br><h2>Acerca de Nosotros</h2></div>
						<div class="price-features">
							<div classs = "row" style="padding: 10px;">
								<div class="col-12 center">
									<h3 style="line-height: normal; margin-bottom: 0px;">Aclaraciones y dudas</h3>
									
								</div>
							</div>
							<div class="row" style="padding: 10px">
								<!-- <div class="col-md-1"></div> -->
								<div class="col-md-6 center">
									<h3>Efrén Olivas - <a href="tel:6251500653">625 150 0653</a></h3>
									<a href="https://wa.me/+526251500653"><button class="btn btn-success"><i class="fab fa-whatsapp"></i>&nbsp; 625-150-0653</button></a>
									
									<h4>eolivas@rifaslosprimos.com</h4>
									
									<!-- <ul class="iconlist mb-0">
										<li><i class="icon-line-circle-check color"></i> 24x7 Available</li>
										<li><i class="icon-line-circle-check color"></i> Free Lunch Per Day</li>
										<li><i class="icon-line-circle-check color"></i> All Classes in One Price</li>
										<li><i class="icon-line-circle-check color"></i> Special Event Access</li>
									</ul> -->
								</div>
								<div class="col-md-6 center">
									<h3>Serbando Miranda - <a href="tel:6591057115">659 105 7115</a></h3>
									<a href="https://wa.me/+526591057115"><button class="btn btn-success"><i class="fab fa-whatsapp"></i>&nbsp; 659-105-7115</button></a>
									<h4>smiranda@rifaslosprimos.com</h4>
									<!-- <ul class="iconlist mb-0">
										<li><i class="icon-line-circle-check color"></i> Free Towel Provide</li>
										<li><i class="icon-line-circle-check color"></i> Free Lockers</li>
										<li><i class="icon-line-circle-check color"></i> Free Lockers</li>
										<li><i class="icon-line-circle-check color"></i> Free Yoga Mat*</li>
									</ul> -->
								</div>
								<div class="col-md-12 center text-title"><p>Empezamos este nuevo proyecto y traemos para ustedes los mejores y más accesibles sorteos de autos ,clásicas , Rzr, todoterreno.
									<br>Los invitamos a participar en nuestros sorteos.	</p>
								</div>
							</div>							
						
						</div>

					</div>
				 </div><!-- fin -->

			</div>

		</section><!-- #content end -->
    
    <?php 
      include "./components/footer.php";
    ?>

	</div>

  <?php
    include "./components/foot.php";
  ?>

	<script>
		// Owl Carousel Scripts
		jQuery(window).on( 'pluginCarouselReady', function(){
			$('#oc-teachers').owlCarousel({
				items: 1,
				margin: 30,
				nav: true,
				navText: ['<i class="icon-line-arrow-left"></i>','<i class="icon-line-arrow-right"></i>'],
				dots: false,
				smartSpeed: 300,
				stagePadding: 60,
				responsive:{
					768: { stagePadding: 100, margin: 30, items: 1 },
					991: { stagePadding: 100, margin: 40, smartSpeed: 400, items: 2 },
					1200: { stagePadding: 100, margin: 40, smartSpeed: 400, items: 2}
				},
			});
		});

		//Current Week
		Date.prototype.getWeek = function(start) {
			//Calcing the starting point
			start = start || 0;
			var today = new Date(this.setHours(0, 0, 0, 0));
			var day = today.getDay() - start;
			var date = today.getDate() - day;

			// Grabbing Start/End Dates
			var StartDate = new Date(today.setDate(date));
			var EndDate = new Date(today.setDate(date + 6));
			return [StartDate, EndDate];
		}
		var Dates = new Date().getWeek();
		$("#week-details").text(Dates[0].toLocaleDateString() + ' - '+ Dates[1].toLocaleDateString());
	</script>

</body>
</html>