<div class="container-fluid">
  <div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Sorteos</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>Sorteo</th>
                  <th>Fecha</th>
                  <th>Costo Boleto</th>
                  <th>Boletos Restantes</th>
                  <th style="width: 150px;">Reportes</th>
                  <th style="width: 100px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $controllerSorteos = new SorteosController();
                $controllerSorteos -> ctrListarSorteos();
                $controllerSorteos -> ctrBorrarSorteo();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function borrarSorteo(idSorteo) {
    Swal.fire({
      title: '¿Está seguro de querer borrar este sorteo?',
      text: 'Esta acción no podrá ser borrada',
      icon: 'warning',
      showDenyButton: true,
      denyButtonText: 'Cancelar',
      denyButtonColor: '#F73164',
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#7366FF',
      reverseButtons: true
    }).then((value) => {
      if (value.isConfirmed) {
        window.location.href = `inicio.php?action=lstSorteos&idBorrar=${idSorteo}`;
      }
    });
  }
</script>