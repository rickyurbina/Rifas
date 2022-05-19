<?php
$idSorteo = $_GET["idSorteo"];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Lista total de boletos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>No boletos</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th style="width: 150px;">Fecha Apartado</th>
                                    <th style="width: 150px;">Fecha Pago</th>
                                    <th>Tipo de venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $controllerSorteos = new BoletosController();
                                $controllerSorteos -> ctrListarTodosLosNumeros($idSorteo);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>