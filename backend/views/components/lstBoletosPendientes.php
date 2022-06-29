<?php
$idSorteo = $_GET["idSorteo"];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Boletos Pendientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No boletos</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Apartado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $controllerBoletos = new BoletosController();
                                $controllerBoletos -> ctrListarBoletosPendientes($idSorteo);
                                ?>
                            </tbody>
                        </table>
                        <?php
                            $controllerBoletos -> ctrPagarBoleto($idSorteo);
                            $controllerBoletos -> ctrBorrarBoleto();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function borrarBoleto(idBoleto,idSorteo) {
    console.log(idBoleto);
    Swal.fire({
      title: '¿Está seguro de querer borrar este boleto?',
      text: 'Esta acción no se puede deshacer',
      icon: 'warning',
      showDenyButton: true,
      denyButtonText: 'Cancelar',
      denyButtonColor: '#F73164',
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#7366FF',
      reverseButtons: true
    }).then((value) => {
      if (value.isConfirmed) {
        window.location.href = `inicio.php?action=lstBoletosPendientes&idSorteo=${idSorteo}&idBoletoBorrar=${idBoleto}`;
      }
    });
  }
</script>