<?php
$idSorteo = $_GET["idSorteo"];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Boletos Vendidos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No boletos</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>apartado</th>
                                    <th>pagado</th>
                                    <th>Tipo de venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $controllerSorteos = new BoletosController();
                                $controllerSorteos -> ctrListarBoletosVendidos($idSorteo);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>